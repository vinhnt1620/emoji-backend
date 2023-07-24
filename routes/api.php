<?php

use App\Http\Controllers\TitleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/title', [TitleController::class, 'index']);
Route::post('/title', [TitleController::class, 'store']);
Route::put('/title/{id}', [TitleController::class, 'edit']);
Route::delete('/title/{id}', [TitleController::class, 'destroy']);
