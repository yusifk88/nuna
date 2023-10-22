<?php

namespace App\Http\Controllers;

use App\Models\AppUser;
use App\Models\VerificationRequest;
use App\Models\Wedding;
use App\Models\WeddingContribution;
use App\Services\Payswitch;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class DashboardsControler extends Controller
{


    public function VerificationRequest()
    {

        $verifiedCount = VerificationRequest::whereIn("user_id",AppUser::select("id")->where("approved",true))->count();
        $unverifiedCount = VerificationRequest::whereIn("user_id",AppUser::select("id")->where("approved",false))->count();
        $allCount = VerificationRequest::all()->count();

        $items = VerificationRequest::with("user")->orderBy("id", "desc")->paginate(50);

        return view("users.verifications", [
            "verifications" => $items,
            "verifiedCount"=>$verifiedCount,
            "unverifiedCount"=>$unverifiedCount,
            "allCount"=>$allCount
            ]);

    }


    public function index(): Factory|\Illuminate\Foundation\Application|View|Application
    {

        $payswitchReq = Payswitch::getBalance();


        $payswitchBalance = $payswitchReq['code'] === '000' ? (int)$payswitchReq['reason'] : 0;
        $convertedBalance = $payswitchBalance > 0 ? $payswitchBalance / 100 : 0;


        $totalUsers = DB::table("users")->count();

        $totalCollections = DB::table("wedding_contributions")
            ->where("success", 1)->sum('amount');
        $totalCharges = round(0.08 * $totalCollections, 2);

        $recentTransactions = WeddingContribution::with("wedding")
            ->orderBy("id", 'desc')->limit(10)->get();

        $recentWeddings = Wedding::with("user")->limit(10)->get();

        $data = [
            "totalUsers" => $totalUsers,
            "totalCollections" => $totalCollections,
            "totalCharges" => $totalCharges,
            "recentTransactions" => $recentTransactions,
            "recentWeddings" => $recentWeddings,
            "balance" => $convertedBalance
        ];

        return view('dashboard', $data);


    }


    /**
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */

    public function users()
    {

        $allUsers = AppUser::orderBy("id", "desc")->paginate(100);


        return \view("users.index", ["users" => $allUsers]);


    }


    public function show(int $id): Factory|\Illuminate\Foundation\Application|View|Application
    {

        $user = AppUser::find($id);

        if (!$user) {
            abort(Response::HTTP_NOT_FOUND);
        }


        $identity = DB::table("verifications")->where("user_id", $id)->first();

        $weddings = DB::table("wedding")->where("user_id", $id)->orderBy("id", 'desc')->get();

        return \view("users.show", [
            "user" => $user,
            "identity" => $identity,
            "weddings" => $weddings
        ]);


    }


    /**
     * @return Factory|\Illuminate\Foundation\Application|View|Application
     */
    public function weddings(): Factory|\Illuminate\Foundation\Application|View|Application
    {
        $weddings = Wedding::with("user")->withSum("totalAmount", "amount")->orderBy("id", "desc")->paginate(100);


        return \view("weddings.index", [
            "weddings" => $weddings
        ]);
    }


    public function transactions()
    {

        $transactions = WeddingContribution::with("wedding")->orderBy("id", "desc")->paginate(100);

        return \view("transactions.index", ['transactions' => $transactions]);


    }

}
