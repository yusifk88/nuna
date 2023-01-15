<?php

use App\Http\Controllers\WeddingsController;
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


Route::get("w/{tag}", [WeddingsController::class, "publicPage"]);
Route::post("w/{id}/attending", [WeddingsController::class, "SaveRSV"])->name("reserve");

$notification=[
    "include_player_ids"=>['ad3ccedf-6cfe-454b-9239-a295fd0b2e8a'],
];

\Ladumor\OneSignal\OneSignal::sendPush($notification,"Hi, Yusif, this is another testing message from the backend","Testing");
