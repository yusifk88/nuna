<?php

namespace App\Repositories;

use App\Models\Wedding;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class UtilityRepository
{

    public static function makeTag($tag, string $brideName, string $groomName)
    {
        if ($tag) {

            return $tag;
        }

        $brideNameArray = explode(" ", $brideName);
        $groomNameArray = explode(" ", $groomName);
        $newTag = $groomNameArray[0] . "&" . $brideNameArray[0] . Carbon::now()->year;


        $tagExists = Wedding::where("tag", $newTag)->exists();

        if ($tagExists) {

            return Str::random(6) . "_" . Carbon::now()->year;

        } else {

            return $newTag;


        }


    }


}
