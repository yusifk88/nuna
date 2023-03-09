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

        User::where("id", $request->user()->id)->update(["notification_token" => $request->user_id]);


    }


    public function updateProfile(Request $request)
    {

        $request->validate([
            "first_name"=>"required",
            "last_name"=>"required",
            "phone_number"=>"required",
            "birth_date"=>"required|date"
        ]);

        $user = $request->user();

        if (!$user->approved){

            User::where("id",$user->id)->update([
                "first_name"=>$request->first_name,
                "last_name"=>$request->last_name,
                "phone_number"=>$request->phone_number,
                "birth_date"=>$request->birth_date
            ]);


        }

        return success_response($user);


    }

    public function signUp(Request $request)
    {

        $request->validate([
            "first_name" => "required",
            "last_name" => "required",
            "phone_number" => "required|unique:users,phone_number|min:10",
            "email" => "required|unique:users,email",
            "birth_date" => "required|date",
            "country_code" => "required",
            'password' => 'required|min:6|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'required|min:6'
        ]);


        $currencies = [
            "gh" => "GHS",
            "ke" => "KSH",
            "ng" => "NGN"
        ];


        $currency = $currencies[strtolower($request->country_code)] ?? "GHS";

        $allData = $request->all();
        $allData['currency'] = $currency;

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
