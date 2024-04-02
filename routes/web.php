<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', function () {
    return view('/auth/login');
});

// Authenticated routes
Route::middleware('auth')->group(function () {

    // Client middleware routes
    Route::middleware('client')->group(function () {

        // Admin routes
        Route::get('/user', [AdminController::class, 'index'])->name('user.index');

        // Client routes
        Route::get('/Client', [AdminController::class, 'indexClient'])->name('Clientindex');
        Route::get('/clients/create', [AdminController::class, 'createClient'])->name('createClient');
        Route::post('/clients/store', [AdminController::class, 'storeClient'])->name('storeClient');
        Route::get('/clients/{id}/edit', [AdminController::class, 'editClient'])->name('editClient');
        Route::put('/clients/{id}', [AdminController::class, 'updateClient'])->name('updateClient');
        Route::delete('/clients/{id}', [AdminController::class, 'destroyClient'])->name('deleteClient');
        Route::get('/clients', [AdminController::class, 'createClient'])->name('employee');


        // Employee routes
        Route::get('/Employee', [AdminController::class, 'indexEmployee'])->name('Employeeindex');
        Route::get('/createEmployee', [AdminController::class, 'createEmployee'])->name('createEmployee');
        Route::post('/employees', [AdminController::class, 'store'])->name('employees.store');
        Route::get('/employee/edit/{id}', [AdminController::class, 'editEmployee'])->name('editEmployee');
        Route::put('/employee/update/{id}', [AdminController::class, 'updateEmployee'])->name('updateEmployee');
        Route::delete('/employee/delete/{id}', [AdminController::class, 'destroyEmployee'])->name('deleteEmployee');

        // Project routes
        Route::get('/Project', [AdminController::class, 'indexProject'])->name('Projectindex');
        Route::get('/projects/create', [AdminController::class, 'createProject'])->name('createProject');
        Route::post('/projects', [AdminController::class, 'storeProject'])->name('projects.store');
        Route::get('/projects/{id}/edit', [AdminController::class, 'editProject'])->name('editProject');
        Route::put('/projects/{id}', [AdminController::class, 'updateProject'])->name('updateProject');
        Route::delete('/projects/{id}', [AdminController::class, 'destroyProject'])->name('deleteProject');

        // Project phase routes
        Route::get('/projects/{projectId}/phases/{phaseId}/edit', [ProjectController::class, 'editProjectPhase'])->name('editProjectPhase');
        Route::put('/projects/{projectId}/phases/{phaseId}', [ProjectController::class, 'updateProjectPhase'])->name('updateProjectPhase');
        Route::delete('/projects/{projectId}/phases/{phaseId}',[ProjectController::class, 'deleteProjectPhase'])->name('deleteProjectPhase');

        // Employee assignment routes
        Route::get('/projects/{projectId}/assignments/{assignmentId}/edit',[ProjectController::class, 'editEmployeeAssignment'])->name('editEmployeeAssignment');
        Route::put('/projects/{projectId}/assignments/{assignmentId}', [ProjectController::class, 'updateEmployeeAssignment'])->name('updateEmployeeAssignment');
        Route::delete('/projects/{projectId}/assignments/{assignmentId}',[ProjectController::class, 'deleteEmployeeAssignment'])->name('deleteEmployeeAssignment');

        // Project details and phase assignment routes
        Route::get('/projects/{id}', [ProjectController::class, 'showProject'])->name('projectDetails');
        Route::get('/projects/{projectId}/create-phase',[ProjectController::class, 'createProjectPhase']) ->name('createProjectPhase');
        Route::post('/projects/store-phase',[ProjectController::class, 'store'] )->name('storeProjectPhase');
        Route::get('/projects/{projectId}/assign-employees', [ProjectController::class, 'assignEmployees'])->name('assignEmployees');
        Route::post('/projects/{projectId}/store-assignment', [ProjectController::class, 'storeAssignment'])->name('storeAssignment');
 
       //Role of the Users
       Route::get('/roles', [AdminController::class, 'indexRole'])->name('Roleindex');
       Route::get('/roles/create', [AdminController::class, 'createRole'])->name('createRole');
       Route::post('/roles/store', [AdminController::class, 'storeRole'])->name('storeRole');
       Route::get('/roles/{id}/edit', [AdminController::class, 'editRole'])->name('editRole');
       Route::put('/roles/{id}/update', [AdminController::class, 'updateRole'])->name('updateRole');
       Route::delete('/roles/{id}/destroy', [AdminController::class, 'destroyRole'])->name('destroyRole');


    });

    // Route for viewing employees
    Route::get('/employees/index', [EmployeeController::class, 'show'])->name('employees.show');

    Route::get('/home',function(){
        return redirect('user');
    });
});

// Authentication routes
Auth::routes(['verify' => true]);
