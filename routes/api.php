<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardControler;
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


Route::middleware('auth:sanctum')->group(function () {

    Route::get("user", function (Request $request) {
        return $request->user();
    });



    Route::post("set-user-push-id",[AuthController::class,"SetPushUserID"]);
    /**
     * wedding routes
     */
    Route::post("wedding", [WeddingsController::class, "store"]);
    Route::get("weddings/{id}", [WeddingsController::class, "show"]);
    Route::get("weddings", [WeddingsController::class, "index"]);
    Route::get("activities", [WeddingsController::class, "weddingActivities"]);
    Route::get("guests-list", [WeddingsController::class, "guests"]);
    Route::get("dashboard", [DashboardControler::class, "show"]);


    /**
     * wishlist item
     */

    Route::post("wishlist/{id}", [WishListCOntroller::class, "store"]);
    Route::get("wishlist/{id}", [WishListCOntroller::class, "items"]);


});
