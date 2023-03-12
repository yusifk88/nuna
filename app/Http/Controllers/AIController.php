<?php

namespace App\Http\Controllers;

use App\Models\StoryHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AIController extends Controller
{
    public function loveStory()
    {
        $token = config("app.open_ai_key");
        $token = config("app.open_ai_key");
        $res = Http::withHeaders([
            "authorization" => "Bearer " . $token
        ])->post('https://api.openai.com/v1/chat/completions', [
            "model" => "gpt-3.5-turbo",
            "messages" => [["role" => "user", "content" => "suggest a short love poem for my engagement"]],
            "max_tokens" => 100,
            "stop" => ["<br>"]
        ]);
        $response = $res->json();
        if (isset($response['choices'])) {

            $text = $response['choices'][0]['message']['content'];

            StoryHistory::create([
                "story" => $text
            ]);

        } else {


            $localStory = StoryHistory::inRandomOrder()->first();

            if ($localStory) {

                $text = $localStory->story;

            } else {

                $text = "Sorry i could not make up something for you";
            }

        }

        $answer = str_replace("\n", "<br>", $text);

        return success_response($answer);


    }
}
