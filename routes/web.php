<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\PaymentController;

Route::get('/', [PaymentController::class, 'index'])->name('home');
Route::post('/payment', [PaymentController::class, 'processPayment'])->name('payment.process');
Route::get('/success', [PaymentController::class, 'success'])->name('payment.success');
Route::get('/failure', [PaymentController::class, 'failure'])->name('payment.failure');

