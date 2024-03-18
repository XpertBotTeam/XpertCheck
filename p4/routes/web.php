<?php


use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegistrationController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProjectController;

Route::get('/', function () {return view('/auth/login');});


//'verified'
Route::middleware('auth')->group(function () {

Route::middleware('client')->group(function () {

Route::get('/user', [ClientController::class, 'index'])->name('user.index');

Route::get('/createEmployee', [ClientController::class, 'createEmployee'])->name('createEmployee');

Route::post('/employees', [ClientController::class, 'store'])->name('employees.store');

Route::get('/projects/create', [ClientController::class, 'createProject'])->name('createProject');

Route::get('/projects/{id}', [ProjectController::class, 'showProject'])->name('projectDetails');

Route::post('/projects', [ClientController::class, 'storeProject'])->name('projects.store');

Route::get('/projects/{projectId}/create-phase',[ProjectController::class, 'createProjectPhase']) ->name('createProjectPhase');

Route::post('/projects/store-phase',[ProjectController::class, 'store'] )->name('storeProjectPhase');

Route::get('/projects/{projectId}/assign-employees', [ProjectController::class, 'assignEmployees'])->name('assignEmployees');

Route::post('/projects/{projectId}/store-assignment', [ProjectController::class, 'storeAssignment'])->name('storeAssignment');


    });

    Route::post('/checkInOut/{employeeId}', [EmployeeController::class, 'checkInOut'])->name('checkInOut');

Route::get('/employees/index', [EmployeeController::class, 'show'])->name('employees.show');


});


Auth::routes(['verify' => true]);


