<?php

namespace App\Http\Controllers;

use App\Models\Wedding;
use App\Models\WeddingContribution;
use App\Services\Payswitch;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardsControler extends Controller
{
    public function index(): Factory|\Illuminate\Foundation\Application|View|Application
    {

        $payswitchReq = Payswitch::getBalance();


        $payswitchBalance = $payswitchReq['code']==='000' ? (int)$payswitchReq['reason'] : 0;
        $convertedBalance =$payswitchBalance>0 ?  $payswitchBalance/100 : 0;


        $totalUsers = DB::table("users")->count();

        $totalCollections = DB::table("wedding_contributions")
            ->where("success", 1)->sum('amount');
        $totalCharges = round(0.08 * $totalCollections, 2);

        $recentTransactions = WeddingContribution::with("wedding")
            ->orderBy("id",'desc')->limit(10)->get();

        $recentWeddings = Wedding::with("user")->limit(10)->get();

        $data = [
            "totalUsers" => $totalUsers,
            "totalCollections" => $totalCollections,
            "totalCharges" => $totalCharges,
            "recentTransactions"=>$recentTransactions,
            "recentWeddings"=>$recentWeddings,
            "balance"=>$convertedBalance
        ];

        return view('dashboard', $data);


    }
}
