<?php

use Illuminate\Http\JsonResponse;

if (!function_exists("failed_response")) {

    function failed_response($data = [], int $code = 400, string $message = "Something went wrong, could not process the request"): JsonResponse
    {

        return response()->json([
            "status" => false,
            "data" => $data,
            "message" => $message
        ], $code);

    }

}

if (!function_exists("success_response")) {


    function success_response($data = [], string $message = "Request processed successfully")
    {

        return response()->json([
            "status" => true,
            "data" => $data,
            "message" => $message
        ]);

    }


}
