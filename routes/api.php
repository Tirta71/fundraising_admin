<?php

use App\Http\Controllers\API\DonaturController;
use App\Http\Controllers\API\FundraiserController;
use App\Http\Controllers\API\FundraisingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('fundraisings', FundraisingController::class);

Route::apiResource('fundraisers', FundraiserController::class);

// Fundraising_phase
Route::get('fundraising-phases', [FundraisingController::class, 'getAllFundraisingPhase']);


// Donaturs

Route::apiResource('donaturs', DonaturController::class);

Route::post('/donaturs/add', [DonaturController::class, 'store']);

Route::post('/donaturs/{id}/update-payment-status', [DonaturController::class, 'updatePaymentStatus']);

Route::get('/donaturs/fundraising/{id_fundraising}', [DonaturController::class, 'showByFundraisingId']);