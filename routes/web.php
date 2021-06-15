<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\LobbyController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\AdminGameControlController;

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

Route::get('/edit-password', [UserController::class,'editPasswordIndex'])->name('edit-password'); //修改密碼介面
Route::post('/edit-password', [UserController::class,'editPassword']); //修改密碼

Route::get('/save-money', [AccountController::class,'saveMoneyIndex'])->name('save-money'); //存提款介面
Route::post('/save-money', [AccountController::class,'saveMoney']); //存提款

Route::get('/bingo', [GameController::class,'bingoIndex'])->name('bingo'); //賓果介面
Route::post('/bingo', [GameController::class,'bingo']); // 賓果

Route::get('/gameNumControl', [AdminGameControlController::class, 'gameNumControlIndex'])->name('gameNumControl'); //期數管理介面
Route::post('/gameNumControl', [AdminGameControlController::class, 'gameNumControl']); //期數管理

Route::get('/gameOrdersControl', [AdminGameControlController::class, 'gameOrdersControlIndex'])->name('gameOrdersControl'); //注單管理介面
Route::post('/gameOrdersControl', [AdminGameControlController::class, 'gameOrdersControl']); //注單管理

Route::get('/userSearchControl', [AdminGameControlController::class, 'userSearchControlIndex'])->name('userSearchControl'); //會員輸贏管理介面
Route::post('/userSearchControl', [AdminGameControlController::class, 'userSearchControl']); //會員輸贏管理

Route::get('/userSearchControl/{game_id}', [AdminGameControlController::class, 'userHyperlinkIndex']); //查看該期的所有注單