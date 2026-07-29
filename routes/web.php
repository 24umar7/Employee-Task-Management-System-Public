<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\TaskController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ResetPasswordController;


// Authentication
Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.submit');

Route::get('/auth/google', [AuthController::class, 'redirectToGoogle'])
    ->name('google.login');

Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback'])
    ->name('google.callback');

// Admin
Route::get('/admin/adminDashboard', [AdminController::class, 'dashboard'])
    ->name('admin.dashboard')
    ->middleware('admin');

Route::get('/registerEmployee', [AdminController::class, 'showRegisterForm'])
    ->name('employee.register')
    ->middleware('admin');

Route::post('/registerEmployee', [AdminController::class, 'registerEmployee'])
    ->name('employee.store')
    ->middleware('admin');

Route::get('/deleteEmployee/{id}', [AdminController::class, 'deleteEmployee'])
    ->name('employee.delete')
    ->middleware('admin');

// Tasks
Route::get('/assignTask/{id}', [TaskController::class, 'showAssignTask'])
    ->name('task.assign.form')
    ->middleware('admin');

Route::post('/assignTask', [TaskController::class, 'assignTask'])
    ->name('task.assign')
    ->middleware('admin');

Route::get('/viewTask/{id}', [TaskController::class, 'viewTasks'])
    ->name('task.view')
    ->middleware('admin');

Route::get('/editTask/{id}', [TaskController::class, 'showEditTask'])
    ->name('task.edit.form')
    ->middleware('admin');

Route::post('/editTask/{id}', [TaskController::class, 'updateTask'])
    ->name('task.update')
    ->middleware('admin');

Route::get('/deleteTask/{id}', [TaskController::class, 'deleteTask'])
    ->name('task.delete')
    ->middleware('admin');


// Employee
Route::get('/employee/dashboard', [EmployeeController::class, 'dashboard'])
    ->name('employee.dashboard')
    ->middleware('employee');

Route::post('/completeTask', [EmployeeController::class, 'completeTask'])
    ->name('task.complete')
    ->middleware('employee');

Route::post('/updateScreenshot', [EmployeeController::class, 'updateScreenshot'])
    ->name('task.screenshot.update')
    ->middleware('employee');

Route::get('/changePassword', [EmployeeController::class, 'showChangePassword'])
    ->name('employee.password.form')
    ->middleware('employee');

Route::post('/changePassword', [EmployeeController::class, 'changePassword'])
    ->name('employee.password.update')
    ->middleware('employee');


Route::get('/logout', [AuthController::class, 'logout'])
    ->name('logout');


//Github Login routes

Route::get('/auth/github', [AuthController::class, 'redirectToGithub'])
    ->name('github.login');

Route::get('/auth/github/callback', [AuthController::class, 'handleGithubCallback']);
