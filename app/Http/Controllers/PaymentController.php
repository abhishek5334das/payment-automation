<?php

namespace App\Http\Controllers;

use App\Models\Otp;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    // Step 1: Show the Payment Page
    public function showPaymentPage()
    {
        return view('payment');
    }

    // Step 2: Generate OTP and Save Payment
    public function generateOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email', // Validate email format
            'amount' => 'required|numeric',
        ]);

        // Generate OTP
        $otp = Str::random(6); // Generate a 6-character OTP
        $expiresAt = now()->addMinutes(5);

        // Save OTP to the database
        Otp::create([
            'email' => $request->email,
            'otp' => $otp,
            'expires_at' => $expiresAt,
        ]);

        // Save payment as pending
        Payment::create([
            'email' => $request->email,
            'amount' => $request->amount,
            'status' => 'Pending',
        ]);

        // Send OTP via email
        Mail::raw("Your OTP is: $otp", function ($message) use ($request) {
            $message->to($request->email)->subject('Your OTP for Payment');
        });

        return redirect()->route('verifyOtpPage')->with('email', $request->email);
    }

    // Step 3: Show OTP Verification Page
    public function showOtpPage()
    {
        return view('verify-otp');
    }

    // Step 4: Verify OTP and Complete Payment
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required',
        ]);

        // Check OTP validity
        $otpRecord = Otp::where('email', $request->email)
            ->where('otp', $request->otp)
            ->where('expires_at', '>', now())
            ->first();

        if ($otpRecord) {
            // Update payment status to Successful
            Payment::where('email', $request->email)->update(['status' => 'Successful']);

            return response()->json(['message' => 'Payment done successfully!']);
        } else {
            // Update payment status to Incomplete
            Payment::where('email', $request->email)->update(['status' => 'Incomplete']);

            return response()->json(['message' => 'Invalid OTP. Payment incomplete.']);
        }
    }
}
