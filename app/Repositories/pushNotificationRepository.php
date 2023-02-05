<?php

namespace App\Repositories;

use Ladumor\OneSignal\OneSignal;

class pushNotificationRepository
{

    public static function sendNotification($user, string $message)
    {

        if ($user && $user->notification_token) {

            $player_ids = [
                "include_player_ids" => [$user->notification_token],
            ];

            OneSignal::sendPush($player_ids, $message);

        }

    }

}
