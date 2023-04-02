<?php

namespace App\Repositories;

use App\Models\Wedding;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use JetBrains\PhpStorm\ArrayShape;

class UtilityRepository
{


    public const CHARGE = 8.5;


    #[ArrayShape(["rate" => "float", "total" => "mixed", "charge" => "float|int", "amount_due" => "float|int|mixed"])]

    public static function getAmountDue(Wedding $wedding): array
    {

        $totalAmount = $wedding->contributions_sum_amount;
        $subTotal = $totalAmount - $wedding->withdraw_amount;

        $charge = (self::CHARGE / 100) * $subTotal;

        $amountDue = $subTotal - $charge;


        return [
            "rate" => self::CHARGE,
            "total" => $subTotal,
            "charge" => $charge,
            "amount_due" => $amountDue
        ];


    }


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
