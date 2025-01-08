<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;

Route::get('/', function () {
    return view('welcome')->name('rwelcome');
});

Route::get('/payment', [PaymentController::class, 'showPaymentPage'])->name('paymentPage');
Route::post('/generate-otp', [PaymentController::class, 'generateOtp'])->name('generateOtp');
Route::get('/verify-otp', [PaymentController::class, 'showOtpPage'])->name('verifyOtpPage');
Route::post('/verify-otp', [PaymentController::class, 'verifyOtp'])->name('verifyOtp');
Route::get('/payment-success', [PaymentController::class, 'showPaymentsuccess'])->name('paymentsuccessPage');
Route::get('/payment-fail', [PaymentController::class, 'showPaymentfail'])->name('paymentfailPage');

