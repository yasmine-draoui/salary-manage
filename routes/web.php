<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepartementController;
use App\Http\Controllers\EmployerController;
use App\Http\Controllers\ConfigurationController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PaymentController;

//authetification
Route::get('/', [AuthController::class, 'login'])->name('login');
Route::post('/', [AuthController::class, 'handlelogin'])->name('handlelogin');


Route::middleware(['auth'])->group(function () {

    //dashboard
    Route::get('dashboard', [AppController::class, 'index'])->name('dashboard');
    Route::get('/validate-account/{email}',[AdminController::class, 'defineAccess']);
    Route::post('/validate-account/{email}',[AdminController::class, 'submitDefineAccess'])->name('submitDefineAccess');

    //departement
    Route::prefix('departement')->name('departement.')->group(function(){
        Route::get('/', [DepartementController::class, 'index'])->name('index');
        Route::get('/create', [DepartementController::class, 'create'])->name('create');
        Route::post('/create', [DepartementController::class, 'store'])->name('store');
        Route::get('/edit/{departement}', [DepartementController::class, 'edit'])->name('edit');
        Route::put('/departement/{departement}', [DepartementController::class, 'update'])->name('update');
        Route::get('/departements/{departement}', [DepartementController::class, 'delete'])->name('delete');
    });

    //employer
    Route::prefix('employer')->name('employer.')->group(function(){
        Route::get('/employer', [EmployerController::class, 'index'])->name('index');
        Route::get('/createemp', [EmployerController::class, 'create'])->name('create');
        Route::post('/createemp', [EmployerController::class, 'store'])->name('store');
        Route::get('/editemp/{employer}', [EmployerController::class, 'edit'])->name('edit');
        Route::put('/employer/{employer}', [EmployerController::class, 'update'])->name('update');
        Route::delete('/employers/{employer}', [EmployerController::class, 'delete'])->name('delete');
    });

    //configuration
        Route::prefix('config')->name('config.')->group(function(){
        Route::get('/config', [ConfigurationController::class, 'index'])->name('index');
        Route::get('/create', [ConfigurationController::class, 'create'])->name('create');
        Route::post('/create', [ConfigurationController::class, 'store'])->name('store');
        Route::delete('/config/{config}', [ConfigurationController::class, 'delete'])->name('delete');
    });

    //admin
    Route::prefix('admin')->name('admin.')->group(function(){
        Route::get('/', [AdminController::class, 'index'])->name('index');
        Route::get('/create', [AdminController::class, 'create'])->name('create');
        Route::post('/create', [AdminController::class, 'store'])->name('store');
        Route::get('/edit/{user}', [AdminController::class,'edit'])->name('edit');
        Route::put('/admin/{user}', [AdminController::class,'update'])->name('update');
        Route::delete('/admin/{user}',[AdminController::class, 'delete'])->name('delete');
    });

    //paiement
    Route::prefix('payment')->name('payment.')->group(function(){
    Route::get('/payment', [PaymentController::class, 'index'])->name('index');
    Route::get('/make', [PaymentController::class, 'initPayment'])->name('init');
    Route::get('/download-invoice/{payment}', [PaymentController::class, 'downloadInvoice'])->name('download');
    });

});
