<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

use App\Http\Controllers\GoogleChatController;

// UI Route
Route::get('/', function () {
    return view('welcome');
});

// API Routes
Route::post('/send-text', [GoogleChatController::class, 'sendMessage']);
Route::post('/send-card', [GoogleChatController::class, 'sendCard']);
Route::post('/send-notification', [GoogleChatController::class, 'sendNotification']);