<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Reservation;
use App\Models\Wedding;
use App\Models\WeddingContribution;
use function request;

class DashboardControler extends Controller
{

    public function show()
    {
        $user = request()->user();

        $weddings = Wedding::withSum("items", "target_amount")
            ->withSum("contributions", "amount")
            ->where("user_id", $user->id)->orderBy("id", "desc")->get();
        $contributions = WeddingContribution::whereIn("wedding_id", Wedding::select("id")->where("user_id", $user->id))->where("success", true)->count();

        $rsvCount = Reservation::whereIn("wedding_id", Wedding::select('id')->where("user_id", $user->id))->count();

        return success_response([
            "contributions" => $contributions,
            "weddings" => $weddings,
            "guest" => $rsvCount
        ]);


    }


    public function notifications()
    {


        $recent = Event::whereIn("wedding_id", Wedding::select("id")->where("user_id", request()->user()->id))->orderBy("id", "desc")->cursorPaginate(50);


        return success_response(["notifications" => $recent]);

    }

}
