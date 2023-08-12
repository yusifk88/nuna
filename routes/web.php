<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\WeddingsController;
use App\Repositories\Paystack;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::get('/privacy-policy', function () {
    return view('terms');
})->name("privacy");


Route::get("w/confirm", [WeddingsController::class, "confirmPayment"]);
Route::get("w/{tag}", [WeddingsController::class, "publicPage"]);

Route::get("verify/{uuid}", [AuthController::class, "previewAccount"])->name("confirmAccount");
Route::get("verify-confirm/{uuid}", [AuthController::class, "confirmAccount"])->name("verifyAccount");
Route::get("unverify-confirm/{uuid}", [AuthController::class, "unverifyAccount"])->name("unverifyAccount");

Route::get("w/{tag}/contribute", [WeddingsController::class, "paymentPage"])->name("initPayment");
Route::post("w/{id}/attending", [WeddingsController::class, "SaveRSV"])->name("reserve");
Route::post("w/{id}/checkout", [WeddingsController::class, "initCheckout"])->name("initCheckout");

