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



