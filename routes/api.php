<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\ClientController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/login',[UserController::class,'login']);
Route::post('/register',[UserController::class,'register']);

Route::group(['middleware'=>'auth:sanctum'],function(){

    Route::resource('users',UserController::class);
    Route::resource('clients', ClientController::class); // For client management, only admins can create clients
    Route::resource('roles',RoleController::class);

});
// Route::post('/clients', [ClientController::class, 'store']);
// Route::get('/clients', [ClientController::class, 'index']);
// Route::get('/clients/{id}', [ClientController::class, 'show']);
// Route::put('/clients/{id}', [ClientController::class, 'update']);
// Route::delete('/clients/{id}', [ClientController::class, 'destroy']);



//Route::get('/users/{userID}', [UserController::class, 'getUser']);