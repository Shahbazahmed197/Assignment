<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Jobs\SendAdminNotification;
use App\Jobs\SendVerifyEmailNotification;
use App\Mail\VerifyEmail;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $user = User::find($user->id);
            if (!$user->hasVerifiedEmail()) {
                 SendVerifyEmailNotification::dispatch($user);
                Auth::logout();
                return response()->json([
                    'message' => 'Please verify your email before logging in.',
                    'status' => false, 'data' => (object)[]
                ], 403);
            }
            $token = $user->createToken('authToken')->plainTextToken;
            return response()->json([
                'message' => 'Login successful',
                'success' => true,
                'token' => $token,
                'data' => Auth::user()
            ], 200);
        }

        return response()->json(['message' => 'Invalid credentials', 'success' => false, 'data' => (object)[],], 401);
    }
    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $user->assignRole('user');
        // event(new Registered($user));
        SendVerifyEmailNotification::dispatch($user);
        Auth::login($user);

        SendAdminNotification::dispatch($user);
        $token = $user->createToken('authToken')->plainTextToken;

        return response()->json(['token' => $token, 'message' => "Registered Successfully", "success" => true, "data" => $user], 200);
    }
    public function logout(Request $request)
    {
        // Revoke the user's token
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Logged out successfully', "success" => true, "data" => (object)[],], 200);
    }

}
