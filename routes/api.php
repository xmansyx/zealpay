<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BabiesController;
use App\Http\Controllers\Api\ParentsController;
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

Route::get('partner',[ParentsController::class, 'getPartner'])->middleware('auth:sanctum');
Route::post('partner',[ParentsController::class, 'addPartner'])->middleware('auth:sanctum');
Route::apiResource('/babies', BabiesController::class)->middleware('auth:sanctum');

Route::post('login',[AuthController::class, 'login']);
Route::post('register',[AuthController::class, 'register']);
