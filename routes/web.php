<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\LobbyController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [UserController::class,'loginIndex']); //登入使用者介面
Route::post('/login', [UserController::class,'login']); //登入使用者

Route::get('/lobby/{name}', [LobbyController::class, 'lobbyIndex'])->name('lobby'); //使用者大廳介面
Route::get('/lobby/{name}', [LobbyController::class, 'lobbyIndex'])->name('adminLobby'); //管理員大廳介面

Route::get('/logout', [UserController::class,'logout'])->name('logout'); //登出使用者

Route::get('/register', [UserController::class,'registerIndex'])->name('register'); //註冊使用者介面
Route::post('/register', [UserController::class,'register']);  //註冊使用者
