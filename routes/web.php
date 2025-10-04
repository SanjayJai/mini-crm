<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;

// Public routes
Route::get('/', function () { return view('welcome'); })->name('index');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Protected routes
Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::middleware(['role:admin'])->group(function () {
        Route::get('/companies', [CompanyController::class, 'index'])->name('companies.index');
        Route::get('/companies/create', [CompanyController::class, 'create'])->name('companies.create');
        Route::post('/companies/store', [CompanyController::class, 'store'])->name('companies.store');
        Route::get('/companies/{company}/edit', [CompanyController::class, 'edit'])->name('companies.edit');
        Route::put('/companies/{company}/update', [CompanyController::class, 'update'])->name('companies.update');
        Route::delete('/companies/{company}/delete', [CompanyController::class, 'destroy'])->name('companies.destroy');


        Route::get('/employees', [EmployeeController::class, 'index'])->name('employees.index');
        Route::get('/employees/create', [EmployeeController::class, 'create'])->name('employees.create');
        Route::post('/employees/store', [EmployeeController::class, 'store'])->name('employees.store');
        Route::get('/employees/{employee}/edit', [EmployeeController::class, 'edit'])->name('employees.edit');
        Route::put('/employees/{employee}/update', [EmployeeController::class, 'update'])->name('employees.update');
        Route::delete('/employees/{employee}/delete', [EmployeeController::class, 'destroy'])->name('employees.destroy');
    });


    Route::middleware(['role:company'])->group(function () {
        // Edit own profile
        Route::get('/company/profile/edit', [CompanyController::class, 'editProfile'])->name('company.profile.edit');
        Route::put('/company/profile/update', [CompanyController::class, 'updateProfile'])->name('company.profile.update');


        Route::get('/employees', [EmployeeController::class, 'index'])->name('company.employees.index');
        Route::get('/employees/create', [EmployeeController::class, 'create'])->name('company.employees.create');
        Route::post('/employees/store', [EmployeeController::class, 'store'])->name('company.employees.store');
        Route::get('/employees/{employee}/edit', [EmployeeController::class, 'edit'])->name('company.employees.edit');
        Route::put('/employees/{employee}/update', [EmployeeController::class, 'update'])->name('company.employees.update');
        Route::delete('/employees/{employee}/delete', [EmployeeController::class, 'destroy'])->name('company.employees.destroy');
    });


});
