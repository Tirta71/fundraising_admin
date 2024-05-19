<?php

use App\Http\Controllers\API\DonaturController;
use App\Http\Controllers\API\FundraisingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('fundraisings', FundraisingController::class);

Route::apiResource('donaturs', DonaturController::class);

Route::post('/donaturs/add', [DonaturController::class, 'store']);

Route::get('/donaturs/fundraising/{id_fundraising}', [DonaturController::class, 'showByFundraisingId']);