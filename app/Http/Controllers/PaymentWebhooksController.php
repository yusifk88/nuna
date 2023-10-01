<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use App\Models\Wedding;
use App\Models\WeddingContribution;
use App\Repositories\Flutterwave;
use App\Repositories\Paystack;
use App\Repositories\pushNotificationRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaymentWebhooksController extends Controller
{


    public function handleFlutterwaveWebhook(Request $request)
    {

        $data = $request->all();


        if (isset($data['event']) && $data['event']==='charge.completed'){


        if (isset($data['data']['status']) && $data['data']['status'] == 'successful') {


            $ref = isset($data['data']['txRef']) ? $data['data']['txRef'] : null;

            if ($ref) {


                $redID = isset($data['data']['id']) ? $data['data']['id'] : null;
                $verifyPayment = Flutterwave::verifyTransaction($redID);

                if ($verifyPayment && $verifyPayment->status === 'success') {

                    $record = WeddingContribution::where("transaction_id", $ref)->where('success', false)->first();

                    if ($record) {

                        $wedding = Wedding::find($record->wedding_id);

                        $wedding_event = new Event([
                            "wedding_id" => $record->wedding_id,
                            "title" => $record->name . "'s contribution",
                            "description" => $record->name . " contributed GHS" . number_format($record->amount, 2),
                            "type" => "gift"
                        ]);

                        $wedding_event->save();


                        $user = User::find($wedding->user_id);
                        $message = "🎁 You have received GHS" . number_format($record->amount, 2) . " from " . $record->name . " as a gift for your wedding(" . $wedding->tag . ")!";
                        pushNotificationRepository::sendNotification($user, $message);

                        $data = [
                            "wedding" => $wedding,
                            "amount" => $record->amount,
                        ];

                        $record->success = true;
                        $record->message = "success";
                        $record->update();

                        return success_response($data);


                    }

                }


            }
        }

        }


    }


    public function handleWebHook(Request $request)
    {


        $data = $request->all();

        if ($data['event'] === 'charge.success') {

            if ($data['data']['status'] === 'success') {

                $reference = $data['data']['reference'];

                $verifyInfo = Paystack::verify($reference);

                if ($verifyInfo->status) {

                    $record = WeddingContribution::where("transaction_id", $reference)->where('success', false)->first();

                    if ($record) {

                        $wedding = Wedding::find($record->wedding_id);

                        $wedding_event = new Event([
                            "wedding_id" => $record->wedding_id,
                            "title" => $record->name . "'s contribution",
                            "description" => $record->name . " contributed GHS" . number_format($record->amount, 2),
                            "type" => "gift"
                        ]);

                        $wedding_event->save();


                        $user = User::find($wedding->user_id);
                        $message = "🎁 You have received GHS" . number_format($record->amount, 2) . " from " . $record->name . " as a gift for your wedding(" . $wedding->tag . ")!";
                        pushNotificationRepository::sendNotification($user, $message);

                        $data = [
                            "wedding" => $wedding,
                            "amount" => $record->amount,
                        ];

                        $record->success = true;
                        $record->message = "success";
                        $record->update();

                        return success_response($data);


                    }


                }


            }


        }


    }

}
