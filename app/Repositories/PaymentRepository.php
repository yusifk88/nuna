<?php

namespace App\Repositories;

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class PaymentRepository extends SMSRepository
{

    public static function DebitMomo($phone_number, $amount, $network)
    {
        $data =  [
            "customer_number" => $phone_number,
            "amount" => $amount,
            "exttrid" => Carbon::now()->timestamp,
            "reference" => "Nuna Technologies",
            "nw" => $network,
            "trans_type" => "CTM",
            "callback_url" => "https://webhook.site/ae5a592d-3532-4f2c-925c-037029aa73a2",
            "service_id" => self::userID(),
            "ts" => Carbon::now()->toDateTimeString(),
            "nickname" => "Nuna Technologies"
        ];

        $token = self::token();
        $secrete = self::secrete();


        $signature = hash_hmac('sha256', json_encode($data), $secrete);

        $access_token = $token . ":" . $signature;



        $res = Http::withHeaders([
            "Authorization" => $access_token
        ])->post(self::url() . "sendRequest",$data);

        return $res->json();

    }


}
