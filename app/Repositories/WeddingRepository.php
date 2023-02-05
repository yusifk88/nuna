<?php

namespace App\Repositories;

use App\Models\Event;
use App\Models\Reservation;
use App\Models\User;
use App\Models\Wedding;
use Ladumor\OneSignal\OneSignal;

class WeddingRepository
{

    public static function createAttendant($name, $phone_number, $wedding_id, $email = "")
    {


        $existingRSVP = Reservation::where("phone_number", $phone_number)
            ->where("wedding_id", $wedding_id)->first();

        if ($existingRSVP) {
            $existingRSVP->update([
                "name" => $name,
                "email" => $email
            ]);

        } else {

            $rsvp = new Reservation([
                "wedding_id" => $wedding_id,
                "name" => $name,
                "phone_number" => $phone_number,
                "email" => $email
            ]);
            $rsvp->save();

            $wedding_event = new Event([
                "wedding_id" => $wedding_id,
                "title" => $name . " would be attending",
                "description" => $name . " has indicated that they would be attending",
                "type" => "attendance"
            ]);

            $wedding_event->save();

            $wedding = Wedding::find($wedding_id);

            if ($wedding) {
                $user = User::find($wedding->user_id);

                $message = $name . " would be attending your wedding (" . $wedding->tag . "🎉)";
                pushNotificationRepository::sendNotification($user, $message);

            }

        }

    }
}
