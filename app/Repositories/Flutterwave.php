<?php

namespace App\Repositories;

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class Flutterwave
{


    public static function initializePayment(float $amount, string $email, string $ref, string $callback = null, string $name = "")
    {


        $res = Http::withToken(self::secret_key())->post(self::url() . "payments", [
            "amount" => $amount,
            "currency" => "GHS",
            "redirect_url" => $callback,
            "tx_ref" => $ref,
            "customer" => [
                "email" => $email,
                "name" => $name
            ]
        ]);

        return json_decode($res->body());


    }

    private static function secret_key()
    {
        return config("flutterwave.secret_key");
    }

    private static function url()
    {
        return config("flutterwave.url");
    }

    private static function public_key()
    {
        return config("flutterwave.public_key");
    }

    public static function verifyTransaction($transaction_id)
    {

        $res = Http::withToken(self::secret_key())->get(self::url()."/transactions/".$transaction_id."/verify");
        return json_decode($res->body());

    }


}
