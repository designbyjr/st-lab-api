<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductsController;

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

Route::middleware(['auth:sanctum'])->group(function () {
    Route::resource('/products', ProductsController::class,['only' => ['index', 'update', 'store','show','destroy']]);
    Route::post("/logout",[AuthController::class, 'logout']);
});

// PUBLIC ROUTES
Route::post("/login",[AuthController::class, 'login'])->name('login');
Route::post("/register",[AuthController::class, 'register']);


