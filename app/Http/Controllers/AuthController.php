<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{


    public function SetPushUserID(Request $request)
    {
        $request->validate(["user_id" => "required"]);


    }

    public function signUp(Request $request)
    {

        $request->validate([
            "first_name" => "required",
            "last_name" => "required",
            "phone_number" => "required|unique:users,phone_number",
            "email" => "required|unique:users,email",
            "birth_date" => "required|date",
            "country_code" => "required",
            "id_number" => "required|unique:users,email",
            'password' => 'required|min:6|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'required|min:6'
        ]);

        $allData = $request->all();
        $allData['password'] = Hash::make($request->password);


        $user = new User($allData);

        $user->save();

        $authData = [
            "user" => $user
        ];


        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $token = $user->createToken($request->device_name ?? "access token")->plainTextToken;

        $authData['token'] = $token;

        return success_response($authData, "Signup successful");


    }


    public function login(Request $request)
    {
        $request->validate([
            "email" => "required",
            "password" => "required"
        ]);

        $user = User::where("email", $request->email)->first();

        if (!$user) {

            $user = User::where("phone_number", $request->email)->first();
        }

        if (!$user || !Hash::check($request->password, $user->password)) {

            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);

        }

        return success_response([
            "token" => $user->createToken($request->device_name ?? "access token")->plainTextToken,
            "user" => $user
        ]);

    }


}
