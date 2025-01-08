<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Payment;
use App\Models\Otp;
use Carbon\Carbon;

class PaymentController extends Controller
{
    public function showPaymentPage()
    {
        return view('payment');
    }

    public function processPayment(Request $request)
    {
        // Save payment details temporarily
        Payment::create([
            'email' => $request->email,
            'amount' => $request->amount,
        ]);

        return response()->json(['message' => 'Payment details saved. Sending OTP...']);
    }

    public function sendOtp(Request $request)
    {
        $otp = rand(100000, 999999);
        $expiresAt = Carbon::now()->addMinutes(5);

        // Save OTP to database
        Otp::create([
            'email' => $request->email,
            'otp' => $otp,
            'expires_at' => $expiresAt,
        ]);

        // Send OTP via email
        Mail::raw("Your OTP is: $otp", function ($message) use ($request) {
            $message->to($request->email)->subject('Your OTP Code');
        });

        return response()->json(['message' => 'OTP sent successfully!']);
    }

    public function verifyOtp(Request $request)
    {
        $otpRecord = Otp::where('otp', $request->otp)
            ->where('email', $request->email)
            ->where('expires_at', '>', Carbon::now())
            ->first();

        if ($otpRecord) {
            return response()->json(['message' => 'OTP verified successfully!']);
        }

        return response()->json(['message' => 'Invalid or expired OTP!'], 400);
    }
}
