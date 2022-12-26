<?php

namespace App\Http\Controllers;

use App\Models\Wedding;
use App\Repositories\UtilityRepository;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WeddingsController extends Controller
{


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


        return view("wedding.index", ["wedding" => $wedding]);


    }


    public function show($id)
    {

        $wedding = Wedding::where("id", $id)
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
            "tag" => UtilityRepository::makeTag($request->tag, $request->bride_name, $request->groom_name),
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

        return success_response($wedding);


    }
}
