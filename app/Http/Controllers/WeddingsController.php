<?php

namespace App\Http\Controllers;

use App\Http\Resources\WeddingEventResource;
use App\Models\Event;
use App\Models\Reservation;
use App\Models\User;
use App\Models\Wedding;
use App\Models\WeddingContribution;
use App\Repositories\Flutterwave;
use App\Repositories\Paystack;
use App\Repositories\UtilityRepository;
use App\Repositories\WeddingRepository;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class WeddingsController extends Controller
{


    public function contributions(): JsonResponse
    {

        $wedding_id = \request()->get("wedding_id");
        if ($wedding_id) {

            $list = WeddingContribution::where("wedding_id", $wedding_id)->where("success", true)->orderBy("id", "desc")->get();
        } else {
            $user = auth()->user();
            $list = WeddingContribution::whereIn("wedding_id", Wedding::select("id")->where("user_id", $user->id))->where("success", true)->orderBy("id", "desc")->get();

        }
        $contributions = WeddingEventResource::collection($list);
        return success_response($contributions);


    }

    public function confirmPayment()
    {
        $ref = \request()->get("tx_ref",null);
        $txID = \request()->get("transaction_id",null);

        if ($txID && $txID) {

            $record = WeddingContribution::where("transaction_id", $ref)->first();

            $wedding = null;

            if ($record) {

                $wedding = Wedding::find($record->wedding_id);

                if ($wedding) {

                    return view("wedding.payment_success", [
                        "wedding" => $wedding,
                        "amount" => $record->amount
                    ]);

                }


            }


            return view("wedding.payment_failed", [
                "wedding" => $wedding,
                "reason" => "Sorry, we could not verify your transaction please try again"
            ]);

        }


    }


    public function initCheckout(Request $request, int $wedding_id)
    {

        $request->validate([
            "name" => "required",
            "email" => "required|email",
            "phone_number" => "required",
            "amount" => "required|numeric"
        ]);

        if ($request->attending) {

            WeddingRepository::createAttendant($request->name, $request->phone_number, $wedding_id, $request->email);

        }

        $url = "https://mynunaa.com/w/confirm";

        $wedding = Wedding::find($wedding_id);

        if (!$wedding) {

            abort(Response::HTTP_NOT_FOUND, "Event not found");

        }


        $ref = Str::random(4) . "_" . Carbon::now()->timestamp;

        $checkout = Flutterwave::initializePayment($request->amount, $request->email, $ref, $url, $request->name);

//        $amountInCents = ceil($request->amount * 100);
//
//        $checkout = Paystack::initializePayment($amountInCents, $request->email, $request->name, $url);

        if ($checkout && strtolower($checkout->status) === 'success') {


            WeddingContribution::create([
                "name" => $request->name,
                "email" => $request->email,
                "amount" => $request->amount,
                "phone_number" => $request->phone_number,
                "checkout_token" => $ref,
                "message" => $checkout->message,
                "wedding_id" => $wedding_id,
                "transaction_id" => $ref
            ]);

            return redirect($checkout->data->link);
        }

        echo "Sorry, we could not initialize the checkout reason: " . $checkout->message;

    }


    public function paymentPage(string $tag)
    {

        $wedding = Wedding::where("tag", $tag)->first();

        if (!$wedding) {

            abort(Response::HTTP_NOT_FOUND, "Wedding not found");
        }


        $user = User::find($wedding->user_id);

        $weddingDate = Carbon::parse($wedding->date_time);
        $todayDate = Carbon::now();


        if ($todayDate->greaterThan($weddingDate)) {

            $error = "Sorry, this wedding has expired.";
            return view("wedding.payment_failed", ['wedding' => $wedding, "reason" => $error]);

        }


        if ($wedding->withdraw_amount > 0) {

            $error = "Sorry, this wedding cannot accept payments at the moment.";
            return view("wedding.payment_failed", ['wedding' => $wedding, "reason" => $error]);

        }


        if (strtolower($user->country_code) !== "gh") {

            $error = "Sorry, payment is not available in " . $user->country_code . " yet";
            return view("wedding.payment_failed", ['wedding' => $wedding, "reason" => $error]);

        }


        return view("wedding.pay_page", ['wedding' => $wedding]);


    }

    public function guests()
    {

        $weddingID = $_GET['wedding_id'] ?? null;

        if ($weddingID) {

            $guests = Reservation::where("wedding_id", $weddingID)->orderBy("id", "desc")->get();

        } else {


            $guests = Reservation::whereIn("wedding_id", Wedding::select("id")->where("user_id", \request()->user()->id))->orderBy("id", "desc")->get();
        }

        // $guests->data = WeddingEventResource::collection($guests->data());


        return success_response(WeddingEventResource::collection($guests));

    }

    public function weddingActivities()
    {


        $today = Event::whereIn("wedding_id", Wedding::select("id")->where("user_id", \request()->user()->id))
            ->whereDate("created_at", Carbon::now()->toDateString())->take(5)->orderBy("id", "desc")->get();

        if (count($today)) {
            return success_response(WeddingEventResource::collection($today));

        } else {
            $recent = Event::whereIn("wedding_id", Wedding::select("id")->where("user_id", \request()->user()->id))->take(5)->orderBy("id", "desc")->get();

            return success_response(WeddingEventResource::collection($recent));

        }


    }


    public function SaveRSV(int $id, Request $request)
    {
        $request->validate([
            "name" => "required",
            "phone_number" => "required"
        ]);


        WeddingRepository::createAttendant($request->name, $request->phone_number, $id, $request->email);


        $wedding = Wedding::find($id);


        return view("wedding.success_message", [
            "wedding" => $wedding,
            "name" => $request->name
        ]);

    }


    public function index(): JsonResponse
    {

        $user = \request()->user();

        $weddings = Wedding::withSum("items", "target_amount")
            ->withSum("contributions", "amount")
            ->where("user_id", $user->id)->orderBy("id", "desc")->get();

        return success_response($weddings);


    }


    public function publicPage($tag)
    {

        $wedding = Wedding::where("tag", $tag)->first();

        //dd($wedding);

        if (!$wedding) {
            abort(404);

        }


        $year = Carbon::parse($wedding->date_time)->year;
        $month = Carbon::parse($wedding->date_time)->month;
        $day = Carbon::parse($wedding->date_time)->day;


        return view("wedding.index", ["wedding" => $wedding, "year" => $year, "month" => $month, "day" => $day]);


    }


    public function getAmountDue($id): JsonResponse
    {
        $wedding = Wedding::withSum("items", "target_amount")
            ->withSum("contributions", "amount")
            ->where("id", $id)
            ->where("user_id", \request()->user()->id)
            ->first();

        if (!$wedding) {

            return failed_response([], Response::HTTP_NOT_FOUND, "Wedding not found");
        }


        $amountDUe = UtilityRepository::getAmountDue($wedding);


        return success_response($amountDUe);

    }


    public function show($id)
    {

        $wedding = Wedding::withSum("items", "target_amount")
            ->withSum("contributions", "amount")
            ->where("id", $id)
            ->where("user_id", \request()->user()->id)
            ->first();


        if ($wedding) {

            return success_response($wedding);
        }


        return failed_response(null, 422, "Wedding event not found");


    }


    public function store(Request $request): JsonResponse
    {

        $request->validate([
            "bride_name" => "required",
            "groom_name" => "required",
            "date_time" => "required",
            "tag" => "unique:wedding,tag"
        ]);


        $wedding = new Wedding([
            "bride_name" => $request->bride_name,
            "bride_phone_number" => $request->bride_phone_number,
            "bride_email" => $request->bride_email,
            "groom_name" => $request->groom_name,
            "groom_email" => $request->groom_email,
            "groom_phone_number" => $request->groom_phone_number,
            "tag" => str_replace("#", "", UtilityRepository::makeTag($request->tag, $request->bride_name, $request->groom_name)),
            "rsv_phone_number" => $request->rsv_phone_number,
            "rsv_person" => $request->rsv_person,
            "location" => $request->location,
            "story" => $request->story,
            "coordinates" => $request->coordinates,
            "date_time" => Carbon::parse($request->date_time)->toDateTimeString(),
            "user_id" => $request->user()->id,
            "photo_one" => $request->photo_one,
            "photo_two" => $request->photo_two,
            "photo_three" => $request->photo_three,
            "photo_four" => $request->photo_four
        ]);

        $wedding->save();


        if ($wedding) {

            return success_response($wedding);
        }

        return failed_response([], Response::HTTP_INTERNAL_SERVER_ERROR, "Something went wrong, could not create wedding registry");

    }


    /**
     * @param int $wedding_id
     * @return JsonResponse
     */
    public function destroy(int $wedding_id): JsonResponse
    {
        $user = \request()->user();
        $wedding = Wedding::where("user_id", $user->id)->where("id", $wedding_id)->first();

        if ($wedding) {
            $wedding->delete();
            return success_response([], "Wedding registery deleted");
        }

        return failed_response([], Response::HTTP_NOT_FOUND, "Wedding not cound");

    }


}
