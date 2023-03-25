<?php

use App\Http\Controllers\AIController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardControler;
use App\Http\Controllers\SMSController;
use App\Http\Controllers\WeddingsController;
use App\Http\Controllers\WishListCOntroller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post("signup", [AuthController::class, "signUp"]);
Route::post("login", [AuthController::class, "login"]);
Route::post("sendVerification", [AuthController::class, "sendVerificationCode"]);


Route::middleware('auth:sanctum')->group(function () {

    Route::get("user", function (Request $request) {
        return $request->user();
    });


    Route::post("test-sms", [SMSController::class, 'sendSMS']);
    Route::post("test-name-resolution", [SMSController::class, 'getName']);

    Route::post("update-profile", [AuthController::class, "updateProfile"]);

    Route::post("set-user-push-id", [AuthController::class, "SetPushUserID"]);

    /**
     * wedding routes
     */

    Route::post("wedding", [WeddingsController::class, "store"]);
    Route::get("weddings/{id}", [WeddingsController::class, "show"]);
    Route::get("weddings", [WeddingsController::class, "index"]);
    Route::get("activities", [WeddingsController::class, "weddingActivities"]);
    Route::get("guests-list", [WeddingsController::class, "guests"]);
    Route::get("dashboard", [DashboardControler::class, "show"]);
    Route::get("contributions", [WeddingsController::class, "contributions"]);
    Route::get("get-love-story", [AIController::class, "loveStory"]);


    /**
     * wishlist item
     */

    Route::post("wishlist/{id}", [WishListCOntroller::class, "store"]);
    Route::get("wishlist/{id}", [WishListCOntroller::class, "items"]);

    /**
     * notifications Routes
     */

    Route::get("notifications", [DashboardControler::class, "notifications"]);


});
