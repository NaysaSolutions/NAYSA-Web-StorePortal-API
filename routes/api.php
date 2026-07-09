<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommissaryController;
use App\Http\Controllers\StorePortalOrderController;

Route::post('/authorized-login', [AuthController::class, 'authorizedLogin']);
Route::get('/me', [AuthController::class, 'me']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::post('/auth/heartbeat', [AuthController::class, 'heartbeat']);

Route::prefix('store-portal')->group(function () {
    Route::get('/store-context', [StorePortalOrderController::class, 'storeContext']);
    Route::get('/items', [StorePortalOrderController::class, 'items']);
    Route::get('/weekly-forecast', [StorePortalOrderController::class, 'loadWeeklyForecast']);
    Route::get('/weekly-forecast-history', [StorePortalOrderController::class, 'loadWeeklyForecastHistory']);
    Route::post('/weekly-forecast', [StorePortalOrderController::class, 'saveWeeklyForecast']);
    Route::get('/confirmation', [StorePortalOrderController::class, 'loadConfirmation']);
    Route::post('/confirm-order', [StorePortalOrderController::class, 'confirmOrder']);
});

Route::prefix('commissary')->group(function () {
    Route::get('/categories', [CommissaryController::class, 'getCategories']);
    Route::get('/summary', [CommissaryController::class, 'getSummary']);
    Route::get('/detailed', [CommissaryController::class, 'getDetailed']);
});
