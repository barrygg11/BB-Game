<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CurrentOrderApi;
use App\Http\Controllers\UserApi;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/currentOrder/game_type={game_type}&game_num={game_num}', [CurrentOrderApi::class,'OrderApi']);

Route::put('/login/changePassword', [UserApi::class,'loginApi']);
Route::post('/login/register', [UserApi::class,'registerUserApi']);
