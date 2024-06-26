<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LinkController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

/**
 * get /links -> index
 * post /links -> store
 */
Route::apiResource('/links', LinkController::class);
Route::get('/{shortUrl}', [LinkController::class, 'redirectToUrl']);