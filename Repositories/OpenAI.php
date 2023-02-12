<?php
namespace Repositories;

use Illuminate\Support\Facades\Http;

class OpenAI
{

    public static function generate(string $question)
    {

        $token = env('OPEN_AI_KEY');
        $res = Http::withToken($token)->post('https://api.openai.com/v1/completions ', [
            "model" => "text-davinci-003",
            "prompt" => $question
        ]);

        return $res->json();

    }


}
