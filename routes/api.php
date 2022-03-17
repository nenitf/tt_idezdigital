<?php

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

Route::post('/issue-token', [\App\Http\Controllers\AuthController::class, 'issueToken']);

Route::middleware('auth:sanctum')->group(function(){
    Route::get('/me', function (Request $request) {
        return $request->user();
    });

    Route::resource('pix-transfers', \App\Http\Controllers\PixTransferController::class);
});

