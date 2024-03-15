<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegistrationController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LikesController;

Route::get('/', function () {return view('/auth/login');});


//'verified'
Route::middleware('auth')->group(function () {

    Route::get('/user/{user}/profile', [UserController::class, 'profile'])->name('user.profile');


});


Auth::routes(['verify' => true]);


