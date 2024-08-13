<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AdminPaymentController;
use App\Http\Controllers\KepsekPaymentController;
use App\Http\Controllers\FinancialSummaryController;
use App\Http\Controllers\BillingInformationController;


Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {

    Route::resource('Admin/billings', BillingInformationController::class)->middleware('auth');

    Route::get('Admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    Route::resource('Admin/billings', BillingInformationController::class);

    Route::resource('Admin/payments', AdminPaymentController::class)->except(['show']);
    Route::resource('Admin/financial-summaries', FinancialSummaryController::class)->except(['show']);    
    Route::get('Admin/payments/print', [AdminPaymentController::class, 'print'])->name('admin.payments.print');
    Route::get('Admin/financial-summaries/print', [FinancialSummaryController::class, 'print'])->name('financial.print');
});