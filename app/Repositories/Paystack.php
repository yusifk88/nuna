<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Http;

class Paystack
{
    public static function publicKey()
    {

        return config("paystack.public_key");

    }


    public static function verify(string $reference)
    {

        $res = Http::withToken(self::secreteKey())->get(self::URL()."/transaction/verify/".$reference);

        $data = $res->body();

        return json_decode($data);


    }

    public static function initializePayment(int $amount, string $email, string $name = null, string $url = null)
    {

        $data = [
            "email" => $email,
            "amount" => $amount
        ];

        if ($name) {
            $data["name"] = $name;
        }

        if ($url) {
            $data["callback_url"] = $url;
        }


        $res = Http::withToken(self::secreteKey())->post(self::URL() . "/transaction/initialize", $data);


        $link = $res->body();

        return json_decode($link);

    }

    public static function secreteKey()
    {

        return config("paystack.secrete_key");

    }

    public static function URL()
    {

        return config("paystack.url");

    }


}
