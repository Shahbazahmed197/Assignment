<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ProfileDeleteRequest;
use App\Http\Requests\ProfileUpdateRequest;
use App\Jobs\SendVerifyEmailNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function show()
    {
        $user = auth('sanctum')->user();
        return response()->json(['message' => 'Profile data found', "success" => true, 'data' => $user]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request)
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
            SendVerifyEmailNotification::dispatch($request->user());
        }

        $request->user()->save();

        return response()->json(['message' => 'Profile Updated Successfully', "success" => true, 'data' => $request->user()]);
    }

    /**
     * Delete the user's account.
     */
    public function destroy(ProfileDeleteRequest $request)
    {
        $user = $request->user();
        if (!Hash::check($request['password'], $user->password)) {
            return response()->json(['message' => 'password is incorrect', "success"=>false,'data' => (object)[]], 422);
        }

        $request->user()->tokens()->delete();

        $user->delete();

        return response()->json(['message' => 'Profile deleted Successfully', "success" => true, 'data' => (object)[]]);
    }
}
