<?php

namespace App\Repositories;

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class Flutterwave
{


    public static function initializePayment(float $amount, string $email, string $ref, string $callback = null, string $name = "",string $title="")
    {


        $res = Http::withToken(self::secret_key())->post(self::url() . "payments", [
            "amount" => $amount,
            "currency" => "GHS",
            "redirect_url" => $callback,
            "tx_ref" => $ref,
            "customer" => [
                "email" => $email,
                "name" => $name
            ],
            "customizations" => [
                "title" => $title ?? "Nuna Technologies",
                "logo" => "https://objectstorage.uk-london-1.oraclecloud.com/n/lrj6a9vl4is6/b/MyBucket/o/logo.png"
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

    public static function verifyTransaction($transaction_id)
    {

        $res = Http::withToken(self::secret_key())->get(self::url() . "/transactions/" . $transaction_id . "/verify");
        return json_decode($res->body());

    }

    private static function public_key()
    {
        return config("flutterwave.public_key");
    }


}
