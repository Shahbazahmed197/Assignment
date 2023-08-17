<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Jobs\SendAdminNotification;
use App\Mail\NewUserRegistered;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $user=User::find($user->id);
            $token = $user->createToken('authToken')->plainTextToken;
            return response()->json([
                'message' => 'Login successful',
                'token' => $token,
            ], 200);
        }

        return response()->json(['message' => 'Invalid credentials'], 401);
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
        // Auth::login($user);
        $adminUser = User::role('admin')->first();
        SendAdminNotification::dispatch($user);
        $token = $user->createToken('authToken')->plainTextToken;

        return response()->json(['token' => $token,'message'=>"Registered Successfully","success"=>true,"data"=>$user], 200);
    }

}
