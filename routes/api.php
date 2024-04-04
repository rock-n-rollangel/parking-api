<?php

use Illuminate\Support\Facades\Route;

Route::prefix('tariffications')
    ->resource('tariffications', \App\Http\Controllers\TarifficationController::class);
Route::prefix('tariffications')
    ->group(function () {
        Route::get('/get-amount/{car}', [\App\Http\Controllers\TarifficationController::class, 'getAmount'])
            ->name('tariffications.get-amount');
    });


Route::prefix('parking-spaces')
    ->resource('parking-spaces', \App\Http\Controllers\ParkingSpaceController::class);
Route::prefix('parking-spaces')
    ->group(function () {
        Route::get('/free', [\App\Http\Controllers\ParkingSpaceController::class, 'freeSpaces'])
            ->name('parking-spaces.free');
    });

Route::prefix('cars')
    ->resource('cars', \App\Http\Controllers\CarController::class);
Route::prefix('cars')
    ->name('cars')
    ->controller(\App\Http\Controllers\CarController::class)
    ->group(function () {
        Route::get('{car}/check', 'check')->name('.check');
        Route::post('{car}/park/{parkingSpace}', 'park')->name('.park');
        Route::post('{car}/leave/{parkingSpace}', 'leave')->name('.leave');
    });

Route::prefix('checks')
    ->resource('checks', \App\Http\Controllers\CheckController::class);

Route::prefix('payments')
    ->name('payments')
    ->controller(\App\Http\Controllers\PaymentController::class)
    ->group(function () {
        Route::post('/payme/{car}', 'payWithPayme')->name('.pay-with-payme');
    });
