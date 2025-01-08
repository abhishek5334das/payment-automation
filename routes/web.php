<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
use App\Http\Controllers\PaymentController;

Route::get('/payment', [PaymentController::class, 'showPaymentPage'])->name('paymentPage');
Route::post('/generate-otp', [PaymentController::class, 'generateOtp'])->name('generateOtp');
Route::get('/verify-otp', [PaymentController::class, 'showOtpPage'])->name('verifyOtpPage');
Route::post('/verify-otp', [PaymentController::class, 'verifyOtp'])->name('verifyOtp');


