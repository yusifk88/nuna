<?php

namespace App\Http\Controllers;

use App\Http\Resources\WeddingEventResource;
use App\Models\Event;
use App\Models\Reservation;
use App\Models\User;
use App\Models\Wedding;
use App\Models\WeddingContribution;
use App\Repositories\Payswitch;
use App\Repositories\pushNotificationRepository;
use App\Repositories\UtilityRepository;
use App\Repositories\WeddingRepository;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Ladumor\OneSignal\OneSignal;
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
        $status = \request()->get("status");
        $code = \request()->get("code");
        $reason = \request()->get("reason");
        $transaction_id = \request()->get("transaction_id");
        $record = WeddingContribution::where("transaction_id", $transaction_id)->first();
        $wedding = Wedding::find($record->wedding_id);


        if ($status == 'approved' && $code == '000' && $transaction_id) {


            if ($record) {

                $res = Payswitch::verifyTransaction($transaction_id);
                if ($res && $res->code == '00') {

                    $record->success = true;
                    $record->message = $record->reason;
                    $record->update();

                    $wedding = Wedding::find($record->wedding_id);

                    $wedding_event = new Event([
                        "wedding_id" => $record->wedding_id,
                        "title" => $record->name . "'s contribution",
                        "description" => $record->name . " contributed GHS" . number_format($record->amount, 2),
                        "type" => "gift"
                    ]);

                    $wedding_event->save();


                    $user = User::find($wedding->user_id);
                    $message = "🎁 You have received GHS" . number_format($record->amount, 2) . " from " . $record->name . " as a gift for your wedding(" . $wedding->tag . ")!";


                    pushNotificationRepository::sendNotification($user, $message);


                    $data = [
                        "wedding" => $wedding,
                        "amount" => $record->amount,
                    ];

                    return view("wedding.payment_success", $data);

                }

            }

        } else {

            return view("wedding.payment_failed", ["reason" => $reason, "wedding" => $wedding]);
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

        $url = config("app.url") . "/w/confirm";

        $transaction_id = Payswitch::getMaxID();

        $checkout = Payswitch::initialize_collection($request->amount, $request->email, $transaction_id, $url);


        if ($checkout && $checkout->status === 'success') {


            WeddingContribution::create([
                "name" => $request->name,
                "email" => $request->email,
                "amount" => $request->amount,
                "phone_number" => $request->phone_number,
                "checkout_token" => $checkout->token,
                "message" => $checkout->reason,
                "wedding_id" => $wedding_id,
                "transaction_id" => $transaction_id
            ]);

            return redirect($checkout->checkout_url);
        }
        echo "Sorry, we could not initialize the checkout";

    }


    public function paymentPage(string $tag)
    {

        $wedding = Wedding::where("tag", $tag)->first();

        if (!$wedding) {
            abort(Response::HTTP_NOT_FOUND, "Wedding not found");
        }

        $user = User::find($wedding->user_id);
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
            "photo_one" => $request->hasFile("photo_one") ? Storage::url($request->file("photo_one")->store("/public/wedding/photos")) : null,
            "photo_two" => $request->hasFile("photo_two") ? Storage::url($request->file("photo_two")->store("/public/wedding/photos")) : null,
            "photo_three" => $request->hasFile("photo_three") ? Storage::url($request->file("photo_three")->store("/public/wedding/photos")) : null,
            "photo_four" => $request->hasFile("photo_four") ? Storage::url($request->file("photo_four")->store("/public/wedding/photos")) : null
        ]);

        $wedding->save();

        if ($wedding) {

            return success_response($wedding);
        }

        return failed_response([], Response::HTTP_INTERNAL_SERVER_ERROR, "Something went wrong, could not create wedding registry");

    }
}
