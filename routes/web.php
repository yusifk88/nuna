<?php

use App\Http\Controllers\WeddingsController;
use App\Repositories\Payswitch;
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
Route::get("w/{tag}/contribute", [WeddingsController::class, "paymentPage"])->name("initPayment");
Route::post("w/{id}/attending", [WeddingsController::class, "SaveRSV"])->name("reserve");
Route::post("w/{id}/checkout", [WeddingsController::class, "initCheckout"])->name("initCheckout");

//$checkout = Payswitch::initialize_collection(100, "ykatulie@gmail.com", Payswitch::getMaxID(), "https://mynunaa.com");
//dd($checkout);
//
//