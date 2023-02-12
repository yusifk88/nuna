<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AIController extends Controller
{
    public function loveStory()
    {
        $token = config("app.open_ai_key");
        $res = Http::withHeaders([
            "authorization" => "Bearer " . $token
        ])->post('https://api.openai.com/v1/completions', [
            "model" => "text-davinci-003",
            "prompt" => "suggest a short love poem for my engagement",
            "max_tokens" => 100,
            "stop"=> ["<br>"]
        ]);

        $answer = $res->json()['choices'][0];

        $answer['text']=str_replace("\n","<br>",$answer['text']);
        return success_response($answer);


    }
}
