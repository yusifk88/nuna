<?php

namespace App\Repositories;


use App\Models\WeddingContribution;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use PhpParser\Node\Expr\Cast\Double;

class Payswitch
{

    public static function initialize_collection(float $amount, string $email, $transaction_id, string $url, $desc = "Wedding gift")
    {


        $payload = [
            "merchant_id" => self::merchant_id(),
            "desc" => $desc,
            "email" => $email,
            "transaction_id" => $transaction_id,
            "redirect_url" => $url,
            "amount" => self::floatToMinor($amount),
        ];

        $req = Http::withHeaders([
            "Content-Type" => "Application/json",
            "Accept" => "Application/json",
            "Authorization" => "Basic " . base64_encode(self::username() . ":" . self::api_key())
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

    public static function verifyTransaction($transaction_id)
    {


        $res = Http::withHeaders(
            [
                "Content-Type" => "application/json",
                "Cache-Control" => "no-cache",
                "Merchant-Id" => self::merchant_id()
            ]
        )
            ->get("https://prod.theteller.net/v1.1/users/transactions/" . $transaction_id . "/status");


        return json_decode($res->body());

    }


    public static function balance()
    {


        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://prod.theteller.net/merchants/" . self::merchant_id() . "/balance",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",

        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return $err;
        }

        $res = json_decode($response, true);

        if ($res['code'] === '000') {

            return (double)ltrim($res['reason']) / 100;
        }

        return 00;


    }


    public static function transfer(float $amount, string $network, string $account_number)
    {

        $res = Http::withHeaders([
            "Content-Type" => "application/json",
            "Cache-Control" => "no-cache",
            "Authorization" => "Basic " . base64_encode(self::username() . ":" . self::api_key()),
        ])
            ->post("https://prod.theteller.net/v1.1/transaction/process", [
                "account_number" => $account_number,
                "account_issuer" => $network,
                "merchant_id" => self::merchant_id(),
                "transaction_id" => self::getMaxID(),
                "processing_code" => "404000",
                "amount" => self::floatToMinor($amount),
                "r-switch" => "FLT",
                "desc" => "Nuna gift withdrawal",
                "pass_code" => self::passcode()
            ]);


        return $res->json();


    }

    public static function getMaxID()
    {


        $maxID = Carbon::now()->timestamp;

        if (strlen($maxID) < 12) {

            return self::floatToMinor($maxID);

        } else {

            return substr($maxID, -12);
        }


    }

    public static function passcode()
    {
        return config("payswitch.passcode");
    }

}
