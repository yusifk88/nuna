<?php

use App\Http\Controllers\DashboardsControler;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::middleware('auth')->group(function () {


    Route::get('/', [DashboardsControler::class, "index"]);

    Route::get('/dashboard', [DashboardsControler::class, "index"])->name("dashboard");

    Route::get("/users", [DashboardsControler::class, "users"])->name("users.index");
    Route::get("/users/{id}", [DashboardsControler::class, "show"])->name("users.show");
    Route::get("/weddings", [DashboardsControler::class, "weddings"])->name("weddings.index");
    Route::get("/transactions", [DashboardsControler::class, "transactions"])->name("transactions.index");


});

require __DIR__ . '/auth.php';
