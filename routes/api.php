<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\ClientController;
use App\Http\Controllers\API\EmployeeController;
use App\Http\Controllers\API\ProjectController;
use App\Http\Controllers\API\ProjectPhasesController;
use App\Http\Controllers\API\EmployeeTimeLogsController;
use App\Http\Controllers\API\EmployeeProjectAssignmentsController;
use App\Http\Controllers\API\RoleController;

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
    // Routes for EmployeeController
    Route::resource('employees',EmployeeController::class);
// Route::post('/employees', [EmployeeController::class, 'store']);
// Route::get('/employees', [EmployeeController::class, 'index']);
// Route::get('/employees/{id}', [EmployeeController::class, 'show']);
// Route::put('/employees/{id}', [EmployeeController::class, 'update']);
// Route::delete('/employees/{id}', [EmployeeController::class, 'destroy']);

// Routes for ProjectController
Route::post('/projects', [ProjectController::class, 'store']);
Route::get('/projects', [ProjectController::class, 'index']);
Route::get('/projects/{id}', [ProjectController::class, 'show']);
Route::put('/projects/{id}', [ProjectController::class, 'update']);
Route::delete('/projects/{id}', [ProjectController::class, 'destroy']);

// Routes for ProjectPhasesController
Route::resource('/project-phases', ProjectPhasesController::class)->except(['create', 'edit']);

// Routes for EmployeeLogTimesController
Route::resource('/employee-time-logs', EmployeeTimeLogsController::class)->except(['create', 'edit']);

// Routes for EmployeeProjectAssignmentsController
Route::resource('/employee-project-assignments', EmployeeProjectAssignmentsController::class)->except(['create', 'edit']);

});
// Route::post('/clients', [ClientController::class, 'store']);
// Route::get('/clients', [ClientController::class, 'index']);
// Route::get('/clients/{id}', [ClientController::class, 'show']);
// Route::put('/clients/{id}', [ClientController::class, 'update']);
// Route::delete('/clients/{id}', [ClientController::class, 'destroy']);



//Route::get('/users/{userID}', [UserController::class, 'getUser']);