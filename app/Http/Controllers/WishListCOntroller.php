<?php

namespace App\Http\Controllers;

use App\Models\Wedding;
use App\Models\WishList;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WishListCOntroller extends Controller
{


    public function store($id, Request $request)
    {
        $request->validate([
            "name" => "required",
            "amount" => "numeric|required",
            "type" => "required"
        ]);

        $wedding = Wedding::where("user_id", auth()->id())->where("id", $id)->first();

        if (!$wedding) {

            return failed_response([
                "message" => "The wedding cannot be found",
                "errors" => [

                    "error" => ["The wedding cannot be found"]
                ]], 422, 'The wedding cannot be found');

        }


        $nameExist = WishList::where("wedding_id", $id)->where("name", $request->name)->exists();

        if ($nameExist) {

            $error = [
                "message" => "You have already added " . $request->name . " to your wishlist",
                "errors" => [
                    $request->name => ["You have already added " . $request->name . " to your wishlist"]
                ]
            ];
            return response($error, 422);

        }


        $item = new WishList([
            "user_id" => auth()->id(),
            "wedding_id" => $id,
            "name" => $request->name,
            "description" => $request->description,
            "img_url" => $request->hasFile("photo") ? Storage::url($request->file("photo")->store("/public/wedding/wishlist/photos")) : null,
            "target_amount" => $request->amount,
            "amount_contributed" => 0,
            "type" => $request->type
        ]);

        $item->save();

        return success_response($item, "Wishlist item created");


    }

    public function items($id)
    {

        $wedding = Wedding::where("user_id", auth()->id())->where("id", $id)->first();


        if (!$wedding) {

            return failed_response([
                "message" => "The wedding cannot be found",
                "errors" => [
                    "error" => ["The wedding cannot be found"]
                ]], 422, 'The wedding cannot be found');


        }

        $items = WishList::where("wedding_id", $wedding->id)->orderBy("name", "asc")->get();

        return success_response($items);

    }


}
