<?php

use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\RegistrarController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', function () {
    return view('welcome');
})->name('home');

// new routes
Route::get('/career', function () {
    return view('career');
});
Route::get('/about', function () {
    return view('about');
});
Route::get('/admissions', function () {
    return view('admissions');
});
Route::get('/academics', function () {
    return view('academics');
});
Route::get('/article', function () {
    return view('artical');
});
Route::get('/news', function () {
    return view('news');
});
Route::get('/team', function () {
    return view('team');
});
Route::get('/gallery', function () {
    return view('gallery');
});



// Authentication routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Applicant routes
Route::middleware(['auth', 'role:applicant'])->group(function () {
    Route::prefix('applicant')->name('applicant.')->group(function () {
        Route::get('/dashboard', [ApplicantController::class, 'dashboard'])->name('dashboard');
        Route::get('/apply', [ApplicantController::class, 'applicationForm'])->name('apply');
        Route::post('/apply', [ApplicantController::class, 'submitApplication'])->name('application.store');
        Route::get('/payment/{application}', [ApplicantController::class, 'paymentForm'])->name('payment');
        Route::post('/payment/{application}', [ApplicantController::class, 'processPayment'])->name('payment.process');
        Route::get('/status', [ApplicantController::class, 'applicationStatus'])->name('status');
    });
});

// Registrar routes
Route::middleware(['auth', 'role:registrar'])->group(function () {
    Route::prefix('registrar')->group(function () {
        Route::get('/dashboard', [RegistrarController::class, 'dashboard'])->name('registrar.dashboard');
        Route::get('/applications', [RegistrarController::class, 'applications'])->name('registrar.applications');
        Route::get('/applications/{application}', [RegistrarController::class, 'showApplication'])->name('registrar.applications.show');
        Route::put('/applications/{application}/status', [RegistrarController::class, 'updateApplicationStatus'])->name('registrar.applications.status');
        Route::get('/reports', [RegistrarController::class, 'reports'])->name('registrar.reports');

                // Export routes
        Route::get('/export/excel', [RegistrarController::class, 'exportExcel'])->name('registrar.export.excel');
        Route::get('/export/excel-summary', [RegistrarController::class, 'exportExcelSummary'])->name('registrar.export.excel-summary');
        Route::get('/export/pdf', [RegistrarController::class, 'exportPdf'])->name('registrar.export.pdf');
    });

});

// Admin routes - ALL ROUTES WITH NAMES
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::prefix('admin')->name('admin.')->group(function () {
        // Dashboard
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

        // Programme routes
            Route::prefix('programmes')->name('programmes.')->group(function () {
            Route::get('/', [AdminController::class, 'programmes'])->name('index');
            Route::get('/create', [AdminController::class, 'createProgramme'])->name('create');
            Route::post('/', [AdminController::class, 'storeProgramme'])->name('store');
            Route::get('/{programme}/edit', [AdminController::class, 'editProgramme'])->name('edit');
            Route::put('/{programme}', [AdminController::class, 'updateProgramme'])->name('update');
        });

        // User routes
        Route::prefix('users')->name('users.')->group(function () {
            Route::get('/', [AdminController::class, 'users'])->name('index');
            Route::get('/create', [AdminController::class, 'createUser'])->name('create');
            Route::post('/', [AdminController::class, 'storeUser'])->name('store');
        });
    });
});
// Debug route to view error logs
Route::get('/debug-errors', function() {
    return view('errors.debug');
});
