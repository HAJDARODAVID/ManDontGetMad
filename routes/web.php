<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\GameboardController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::controller(GameboardController::class)
->middleware('checkIfGameboard')
->group(function(){
    Route::get('/gameboard', 'index')->name('gameboard');
});

Route::controller(AdminController::class)
/*->middleware('checkIfGameboard')*/
->prefix('admin')
->group(function(){
    Route::get('/', 'index')->name('gameController');
});
