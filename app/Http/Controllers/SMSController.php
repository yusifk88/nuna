<?php

namespace App\Http\Controllers;

use App\Repositories\PaymentRepository;
use App\Repositories\SMSRepository;
use Illuminate\Http\Request;

class SMSController extends Controller
{
    public function sendSMS(Request $request)
    {
        $request->validate([
            "phone_number" => "required",
            "message" => "required"
        ]);

        $res = SMSRepository::sendSMS($request->phone_number, $request->message);
        return response()->json(success_response($res));

    }

    public function getName(Request $request)
    {
        $request->validate([
            "phone_number" => "required",
        ]);

        $res = SMSRepository::resolveName($request->phone_number);
        return response()->json(success_response($res));

    }


    public function textDebit(Request $request)
    {
        $request->validate([
            "phone_number" => "required",
            "amount" => "required",
            "network" => "required"
        ]);


        $res = PaymentRepository::DebitMomo($request->phone_number, $request->amount, $request->network);
        return success_response($res);

    }

}
