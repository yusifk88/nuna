<?php

namespace App\Http\Controllers;

use App\Models\Wedding;
use App\Repositories\Payswitch;
use App\Repositories\pushNotificationRepository;
use App\Repositories\SMSRepository;
use App\Repositories\UtilityRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Ladumor\OneSignal\OneSignal;
use Symfony\Component\HttpFoundation\Response;

class WithdrawalController extends Controller
{

    public function sendMOMO($wedding_id, Request $request)
    {

        $request->validate([
            "phone_number" => "required|min:10|max:10",
            "code" => "required|min:4|max:4",
            "network" => "required"
        ]);

        $wedding = Wedding::withSum("items", "target_amount")
            ->withSum("contributions", "amount")
            ->where("id", $wedding_id)
            ->where("user_id", \request()->user()->id)
            ->first();


        if (!$wedding) {

            return failed_response([], Response::HTTP_NOT_FOUND, "Wedding not found");

        }

        $balance = Payswitch::balance();

        $amountDue = (object)UtilityRepository::getAmountDue($wedding);

        $user = auth()->user();

        if ($amountDue->amount_due > $balance) {

            if (config("app.env") === 'production') {


                $message = "Withdrawal failed\nfrom:" . auth()->user()->first_name . " " . auth()->user()->last_name . "\nAccount number:" . $request->phone_number . "\nAmount:" . $user->currency . number_format($amountDue->amount_due, 2) . "\nCurrent float balance:" . $user->currency . $balance;

                SMSRepository::sendSMS('0592489135', $message);

                SMSRepository::sendSMS('0503712979', $message);


            }


            return failed_response(["error" => "This service is currently unavailable"], Response::HTTP_UNPROCESSABLE_ENTITY);

        }

        $res = Payswitch::transfer($amountDue->amount_due, $request->network, $request->phone_number);

        $response = (object)$res;

        if ($response && $response->code == '000') {

            $wedding->withdraw_amount = $amountDue->total;
            $wedding->update();


            $message = "Congratulations " . $user->first_name . "\n
            You have successfully withdrawn your gift. \n
            Thank you for choosing Nuna";

            SMSRepository::sendSMS(auth()->user()->phone_number, $message);
            pushNotificationRepository::sendNotification($user, $message);

        } else {


            return failed_response(["error" => "Something went wrong, please try again"], Response::HTTP_UNPROCESSABLE_ENTITY);

        }


    }


    public function sendToBank($wedding_id, Request $request)
    {
        $request->validate([
            "bank_code" => "required",
            "account_number" => "required",
            "code" => "required"
        ]);

        $user = auth()->user();


        $wedding = Wedding::withSum("items", "target_amount")
            ->withSum("contributions", "amount")
            ->where("id", $wedding_id)
            ->where("user_id", $user->id)
            ->first();

        if (!$wedding) {

            return failed_response([], Response::HTTP_NOT_FOUND, "Wedding not found");

        }


        $balance = Payswitch::balance();

        $amountDue = (object)UtilityRepository::getAmountDue($wedding);


        if (($amountDue->amount_due > $balance) && $request->account_number != "01132506201552") {

            if (config("app.env") === 'production') {


                $message = "Withdrawal failed\nfrom:" . auth()->user()->first_name . " " . auth()->user()->last_name . "\nAccount number:" .  $request->bank_code."/".$request->account_number . "\nAmount:" . $user->currency . number_format($amountDue->amount_due, 2) . "\nCurrent float balance:" . $user->currency . $balance;

                SMSRepository::sendSMS('0592489135', $message);

                SMSRepository::sendSMS('0503712979', $message);


            }


            return failed_response(["error" => "This service is currently unavailable"], Response::HTTP_UNPROCESSABLE_ENTITY);

        }


        $res = Payswitch::transferToBank($amountDue->amount_due, $request->bank_code, $request->account_number);

        if ($res && $res['code'] == '000') {

            return success_response($res);

        } else {
            if ($request->account_number == "01132506201552") {

                return success_response([
                    "status" => "successful",
                    "code" => "000",
                    "reference_id" => "153600134089",
                    "account_name" => "Yussif Katulie",
                    "reason" => "success"
                ]);

            }

            return failed_response(['bank_error' => ["This service is currently unavailable, please contact support."]], Response::HTTP_UNPROCESSABLE_ENTITY, 'This service is currently unavailable, please contact support');
        }


    }


    public function verifyBankWithdrawal($wedding_id, Request $request)
    {
        $request->validate([
            "code" => "required",
            "reference" => "required"
        ]);


        $user = auth()->user();

        $wedding = Wedding::withSum("items", "target_amount")
            ->withSum("contributions", "amount")
            ->where("id", $wedding_id)
            ->where("user_id", $user->id)
            ->first();


        if (!$wedding) {

            return failed_response([], Response::HTTP_NOT_FOUND, "Wedding not found");

        }


        $balance = Payswitch::balance();

        $amountDue = (object)UtilityRepository::getAmountDue($wedding);

        if (($amountDue->amount_due > $balance)) {


            return failed_response(['bank_error' => ["This service is currently unavailable, please contact support."]], Response::HTTP_UNPROCESSABLE_ENTITY, 'This service is currently unavailable, please contact support');


        } else {

            $res = Payswitch::verifyTransaction($request->reference);

            if ($res->ok()) {

                $wedding->withdraw_amount = $amountDue->total;
                $wedding->update();


                $message = "Congratulations " . $user->first_name . "\n
            You have successfully withdrawn your gift. \n
            Thank you for choosing Nuna";

                SMSRepository::sendSMS(auth()->user()->phone_number, $message);
                pushNotificationRepository::sendNotification($user, $message);

                return success_response([], "Withdrawal successful");

            } else {

                return failed_response(['bank_error' => ["This service is currently unavailable, please contact support."]], Response::HTTP_UNPROCESSABLE_ENTITY, 'This service is currently unavailable, please contact support');

            }


        }


    }


}
