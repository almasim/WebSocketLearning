<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\ChatController;

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

Route::get('/', function () {
    return view('welcome');
});
Auth::routes();

Route::get('/chat', [ChatController::class, 'showChat'])->name('chat.open');
Route::get('/chat', [ChatController::class, 'showChat'])->name('chat.show');
Route::post('/chat/message', [ChatController::class, 'messageRecieved'])->name('chat.message');
Route::post('/chat/greet/{user}', [ChatController::class, 'greetRecieved'])->name('chat.greet');

Route::view('/users', 'users.ShowAll')->name('home');

Route::view('/game', 'game.show')->name('game.show');