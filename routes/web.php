<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\PaymentController;

Route::get('/payment', [PaymentController::class, 'showPaymentPage'])->name('payment.page');
Route::post('/payment', [PaymentController::class, 'processPayment'])->name('payment.process');
Route::post('/send-otp', [PaymentController::class, 'sendOtp'])->name('otp.send');
Route::post('/verify-otp', [PaymentController::class, 'verifyOtp'])->name('otp.verify');

