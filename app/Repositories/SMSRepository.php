<?php

namespace App\Repositories;

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class SMSRepository
{

    public static function sendSMS(string $phone_number, string $message, string $senderID = "Nuna")
    {

        $token = self::token();
        $secrete = self::secrete();
        $url = self::url();
        $userID = self::userID();

        $data = [

            "recipient_number" => $phone_number,
            "unique_id" => Carbon::now()->timestamp,
            "sender_id" => $senderID,
            "trans_type" => "SMS",
            "service_id" => $userID,
            "msg_body" => $message
        ];

        $signature = hash_hmac('sha256', json_encode($data), $secrete);

        $access_token = $token . ":" . $signature;


        $res = Http::withHeaders([
            "Authorization" => $access_token
        ])->post($url.'sendSms', $data);

        return $res->json();


    }

    public static function token()
    {
        return config("sms.token");
    }

    public static function secrete()
    {
        return config("sms.secrete");
    }

    public static function url()
    {
        return config("sms.base_url");
    }

    public static function userID()
    {
        return config("sms.user_id");
    }

    public static function resolveName(string $phone_number)
    {

        $token = self::token();
        $secrete = self::secrete();
        $url = self::url();
        $userID = self::userID();

        $data =[
            "customer_number"=>$phone_number,
            "service_id"=>$userID,
            "trans_type"=>"AII",
            "nw"=>"VOD",
            "ts"=>\Illuminate\Support\Carbon::now()->toDateTimeString(),
            "exttrid"=>Carbon::now()->timestamp
        ];

        $signature = hash_hmac('sha256', json_encode($data), $secrete);

        $access_token = $token . ":" . $signature;


       $res= Http::withToken($access_token,'')
            ->post($url.'sendRequest',$data);

       return $res->json();

    }


}
