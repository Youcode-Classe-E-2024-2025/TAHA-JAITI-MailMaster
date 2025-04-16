<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\TrackingController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/unsubscribe/{subscriber}', [SubscriberController::class, 'unsubscribe'])->name('unsubscribe');
Route::get('/track/open/{campaign_id}/{subscriber_id}', [TrackingController::class, 'trackOpen'])
    ->name('track.open')
    ->middleware('signed');

Route::middleware('jwt')->group(function () {
    Route::apiResource('newsletters', NewsletterController::class);
    Route::apiResource('subscribers', SubscriberController::class);
    Route::apiResource('campaigns', CampaignController::class);
    Route::post('/campaigns/{campaign}/send', [CampaignController::class, 'send']);
    Route::get('/campaigns/{campaign}/preview', [CampaignController::class, 'preview']);
});
