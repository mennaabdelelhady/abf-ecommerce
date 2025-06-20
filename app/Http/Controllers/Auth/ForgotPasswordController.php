<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPasswordMail;
use App\Models\User;


class ForgotPasswordController extends Controller
{
    //
    // Generate a unique token
    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $token = Str::random(60);

        // Hash the token before storing it
        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => Hash::make($token),
            'created_at' => now(),
        ]);

        // Send email with token
        Mail::to($request->email)->send(new ResetPasswordMail($token));

        return response()->json(['message' => 'Reset link sent']);
    }

    public function verifyCode(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'token' => 'required|string',
        ]);

        $reset = DB::table('password_resets')
            ->where([
                'email' => $request->email,
            ])
            ->first();

        if (!$reset ) {
            return response()->json(['message' => 'Invalid or expired token.'], 401);
        }

        return response()->json(['message' => 'Token verified successfully.'], 200);
    }

    /**
     * Reset the user's password.
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'token' => 'required|string',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $reset = DB::table('password_resets')
            ->where([
                'email' => $request->email,
            ])
            ->first();

        if (!$reset) {
            return response()->json(['message' => 'Invalid or expired token.'], 401);
        }

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['message' => 'User not found.'], 404);
        }

        // Update password
        $user->password = bcrypt($request->password);
        $user->save();

        // Delete used token
        DB::table('password_resets')
            ->where('email', $request->email)
            ->delete();

        return response()->json(['message' => 'Password reset successful.'], 200);
    }
}
