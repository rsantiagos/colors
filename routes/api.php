<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ColorController;

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

Route::get('/color', [ColorController::class, 'index'])->name('color.index');
Route::get('/color/{color}', [ColorController::class, 'show'])->name('color.show');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth','admin'])->group(function () {
    Route::apiResource('color', ColorController::class)->except('index', 'show');
});
