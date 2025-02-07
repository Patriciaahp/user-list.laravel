<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;



Route::get('/', function () {
    return view('welcome');
});
Route::get('/users/search', [UserController::class, 'index'])->name('users.search');
Route::resource('users', UserController::class);