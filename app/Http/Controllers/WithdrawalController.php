<?php

namespace App\Http\Controllers;

use App\Repositories\Payswitch;
use Illuminate\Http\Request;

class WithdrawalController extends Controller
{

    public function sendMOMO(Request $request)
    {

        $request->validate([
            "phone_number" => "required|min:10|max:10",
            "otp" => "required|min:4|max:4",
            "network" => "required"
        ]);




    }


}
