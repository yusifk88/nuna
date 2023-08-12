<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use App\Models\Wedding;
use App\Models\WeddingContribution;
use App\Repositories\Paystack;
use App\Repositories\pushNotificationRepository;
use Illuminate\Http\Request;

class PaymentWebhooksController extends Controller
{


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
