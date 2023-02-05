<?php

namespace App\Repositories;


use App\Models\WeddingContribution;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use PhpParser\Node\Expr\Cast\Double;

class Payswitch
{


    public static function initialize_collection(float $amount, string $email, $transaction_id, string $url)
    {

        $payload = [
            "merchant_id" => self::merchant_id(),
            "desc" => "test payment",
            "email" => $email,
            "transaction_id" => $transaction_id,
            "redirect_url" => $url,
            "amount" => self::floatToMinor($amount),
            "apiuser" => self::username()
        ];

        $req = Http::withHeaders([
            "Content-Type" => "application/json",
            "Cache-Control" => "no-cache",
            "Authorization" => " Basic " . base64_encode(self::username() . ":" . self::api_key())
        ])->post(self::url() . "/initiate", $payload);

        return json_decode($req->body());

    }

    public static function merchant_id()
    {
        return config("payswitch.merchant_id");
    }

    public static function floatToMinor(float $amount)
    {
        $minor = "The number should be of type float";
        $amount = number_format($amount, 2, '.', '');
        $number = $amount * 100;
        $zeros = 12 - strlen($number);
        $padding = str_repeat('0', $zeros);
        return $padding . $number;
    }

    public static function username()
    {
        return config("payswitch.username");
    }

    public static function api_key()
    {
        return config("payswitch.api_key");
    }

    public static function url()
    {
        return config("payswitch.url");
    }

    public static function getMaxID()
    {
        $maxID = 8;
        $lastRecord = WeddingContribution::get()->last();

        if ($lastRecord) {
            $maxID += $lastRecord->id + 1;
        }

        return self::floatToMinor($maxID);


    }


    public static function verifyTransaction($transaction_id)
    {


        $res = Http::withHeaders(
            [
                "Content-Type" => "application/json",
                "Cache-Control" => "no-cache",
                "Merchant-Id" => self::merchant_id()
            ]
        )
            ->get("https://test.theteller.net//v1.1/users/transactions/" . $transaction_id . "/status");


        return json_decode($res->body());

    }

}
