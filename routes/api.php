<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RequestController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/requests/', [RequestController::class, 'sendRequest'])->name('send_request');
Route::put('/requests/{request_model}', [RequestController::class, 'sendAnswer'])->where('request_model', '[0-9]+')->name('send_answer');
Route::get('/requests', [RequestController::class, 'listRequest'])->name('list_request');

