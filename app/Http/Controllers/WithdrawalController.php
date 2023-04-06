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

        $wedding = Wedding::find($wedding_id);
        if (!$wedding) {

            return failed_response([], Response::HTTP_NOT_FOUND, "Wedding not found");

        }

        $balance = Payswitch::balance();

        $amountDue = (object)UtilityRepository::getAmountDue($wedding);
        Log::info((array)$amountDue);


        if ($amountDue->amount_due > $balance) {

            if (config("app.env") === 'production') {


                $message = "Withdrawal failed\n
                            from:" . auth()->user()->first_name . " " . auth()->user()->last_name . "\n
                            Account number:" . $request->phone_number . "\n
                            Amount:" . number_format($request->amount, 2) . "\n
                            Current float balance:" . $balance;

                SMSRepository::sendSMS('0592489135', $message);

                SMSRepository::sendSMS('0503712979', $message);


            }


            return failed_response(["error" => "This service is currently unavailable"], Response::HTTP_UNPROCESSABLE_ENTITY);

        }

        $res = Payswitch::transfer($amountDue->amount_due, $request->network, $request->phone_number);

        $response = (object)$res;

        Log::info($res);

        if ($response && $response->code == '000') {

            $wedding->withdraw_amount = $amountDue->total;
            $wedding->update();

            $user = auth()->user();

            $message = "Congratulations " . $user->first_name . "\n
            You have successfully withdrawn your gift. \n
            Thank you for choosing Nuna";

            SMSRepository::sendSMS(auth()->user()->phone_number, $message);
            pushNotificationRepository::sendNotification($user, $message);

        } else {


            return failed_response(["error" => "Something went wrong, please try again"], Response::HTTP_UNPROCESSABLE_ENTITY);

        }


    }


}
