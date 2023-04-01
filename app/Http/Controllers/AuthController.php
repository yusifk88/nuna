<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserPin;
use App\Models\Verification;
use App\Repositories\pushNotificationRepository;
use App\Repositories\SMSRepository;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
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
            "first_name" => "required",
            "last_name" => "required",
            "phone_number" => "required",
            "birth_date" => "required|date"
        ]);

        $user = $request->user();

        if (!$user->approved) {

            User::where("id", $user->id)->update([
                "first_name" => $request->first_name,
                "last_name" => $request->last_name,
                "phone_number" => $request->phone_number,
                "birth_date" => $request->birth_date
            ]);


        }

        return success_response($user);


    }


    /**
     * @throws ValidationException
     */
    function resetPassword(Request $request)
    {

        $request->validate([
            "code" => "required|exists:user_pin,code",
            "password" => "required|min:6|required_with:password_confirmation|same:password_confirmation",
            "password_confirmation" => "required|min:6"
        ]);

        $foundCode = UserPin::where("code", $request->code)->first();

        if (!$foundCode) {
            throw ValidationException::withMessages([
                'code' => ['Code not found'],
            ]);
        }

        $user = User::where("phone_number", $foundCode->phone_number)->first();

        if (!$user) {

            throw ValidationException::withMessages([
                'account' => ['we could not find your account'],
            ]);

        }

        User::where("id", $user->id)->update([
            "password" => Hash::make($request->password)]);

        $foundCode->used = true;

        $foundCode->update();

        return success_response([], "Password reset successfully");


    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
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


    public function sendVerificationCode(Request $request)
    {
        $request->validate([
            "phone_number" => "required|min:10|max:10|exists:users,phone_number"
        ]);

        UserPin::where("phone_number", $request->phone_number)->delete();


        $code = substr(Carbon::now()->timestamp, -4);

        UserPin::create([
            "phone_number" => $request->phone_number,
            "code" => $code
        ]);

        $text = "Your verification code is " . $code;

        SMSRepository::sendSMS($request->phone_number, $text);


    }


    public function submitVerification(Request $request)
    {
        $request->validate([
            "first_name" => "required",
            "last_name" => "required",
            "birth_date" => "required",
            "id_type" => "required",
            "id_number" => "required",
            "card_photo" => "required|file"
        ]);


        $user = $request->user();

        User::where("id", $user->id)->update([
            "first_name" => $request->first_name,
            "last_name" => $request->last_name,
            "birth_date" => $request->birth_date
        ]);

        $card_photo_url = Storage::url($request->file("card_photo")->store("nuna/public/user/id_photos"));


        $verification = Verification::where("user_id", $user->id)->first();

        if ($verification) {

            Verification::where("id", $verification->id)
                ->update([
                    "id_number" => $request->id_number,
                    "id_type" => $request->id_type,
                    "uuid" => Str::uuid(),
                    "card_image_url" => $card_photo_url
                ]);


        } else {

            $verification = new Verification([
                "id_number" => $request->id_number,
                "id_type" => $request->id_type,
                "uuid" => Str::uuid(),
                "card_image_url" => $card_photo_url,
                "user_id" => $user->id,
            ]);

            $verification->save();


        }


        $phone_number = "233" . substr($user->phone_number, -9);
        $message = "We have received your request to verify your account, your request is under review";

        SMSRepository::sendSMS($phone_number, $message);

        pushNotificationRepository::sendNotification($user, $message);


    }


}
