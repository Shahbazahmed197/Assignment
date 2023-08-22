<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\UpdatePasswordRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;


class PasswordController extends Controller
{
    public function updatePassword(UpdatePasswordRequest $request)
    {
        $user = auth('sanctum')->user();
        if (!Hash::check($request['current_password'], $user->password)) {
            return response()->json(['message' => 'Current password is incorrect', 'success'=>false,'data'=>(object)[],], 422);
        }

        $request->user()->update([
            'password' => Hash::make($request['password']),
        ]);

        return response()->json(["message" => "Password updated successfully", "success"=>true,"data"=>(object)[],], 200);

    }
    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $status = Password::sendResetLink(
            $request->only('email')
        );
        if ($status === Password::RESET_LINK_SENT) {
            return response()->json(['message' => 'Password reset link sent', "success"=>true,"data"=>(object)[],],200);
        } else {
            return response()->json(['message' => 'Failed to send reset link', "success"=>false, "data"=>(object)[],], 422);
        }
    }
}
