<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Wedding;

class DashboardControler extends Controller
{

    public function show()
    {
        $user = request()->user();

        $weddings = Wedding::withSum("items", "target_amount")
            ->withSum("items", "amount_contributed")
            ->where("user_id", $user->id)->orderBy("id", "desc")->get();

        $rsvCount = Reservation::whereIn("wedding_id",Wedding::select('id')->where("user_id",request()->user()->id))->count();

        return success_response([
            "weddings" => $weddings,
            "guest"=>$rsvCount
        ]);


    }

}
