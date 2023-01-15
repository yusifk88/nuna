<?php

namespace App\Http\Controllers;

use App\Http\Resources\WeddingEventResource;
use App\Models\Event;
use App\Models\Reservation;
use App\Models\User;
use App\Models\Wedding;
use App\Repositories\UtilityRepository;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Ladumor\OneSignal\OneSignal;
use Symfony\Component\HttpFoundation\Response;

class WeddingsController extends Controller
{


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


        $existingRSVP = Reservation::where("phone_number", $request->phone_number)->where("wedding_id", $id)->first();

        if ($existingRSVP) {
            $existingRSVP->update([
                "name" => $request->name,
                "email" => $request->email
            ]);

        } else {


            $rsvp = new Reservation([
                "wedding_id" => $id,
                "name" => $request->name,
                "phone_number" => $request->phone_number,
                "email" => $request->email
            ]);
            $rsvp->save();


            $wedding_event = new Event([
                "wedding_id" => $id,
                "title" => $request->name . " would be attending",
                "description" => $request->name . " has indicated that they would be attending",
                "type" => "attendance"
            ]);

            $wedding_event->save();


            $wedding = Wedding::find($id);
            if ($wedding) {
                $user = User::find($wedding->user_id);

                if ($user && $user->notification_token) {

                    $player_ids=[
                        "include_player_ids"=>[$user->notification_token],
                    ];
                    OneSignal::sendPush($player_ids, $request->name . " would be attending 🎉");

                }
            }

        }
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
            ->withSum("items", "amount_contributed")
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
            ->withSum("items", "amount_contributed")
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
