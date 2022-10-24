<?php

namespace App\Http\Controllers;

use App\Models\Wedding;

class DashboardControler extends Controller
{

    public function show()
    {
        $user = request()->user();

        $weddings = Wedding::withSum("items", "target_amount")
            ->withSum("items", "amount_contributed")
            ->where("user_id", $user->id)->orderBy("id", "desc")->get();

        return success_response([
            "weddings" => $weddings
        ]);


    }

}
