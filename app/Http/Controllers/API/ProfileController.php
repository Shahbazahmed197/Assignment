<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ProfileDeleteRequest;
use App\Http\Requests\Auth\UpdateProfileImageRequest;
use App\Http\Requests\Auth\UpdateProfileRequest;
use App\Jobs\SendVerifyEmailNotification;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function show()
    {
        $user = User::select('id', 'name', 'email','profile_image')->find(auth('sanctum')->user()->id);
        return response()->json(['message' => 'Profile data found', "success" => true, 'data' => $user]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(UpdateProfileRequest $request)
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
            SendVerifyEmailNotification::dispatch($request->user());
        }

        $request->user()->save();

        return response()->json(['message' => 'Profile Updated Successfully', "success" => true, 'data' => $request->user()]);
    }
    public function updateProfilePicture(UpdateProfileImageRequest $request)
    {
        $image = $request->file('image');
        $filePath = $image->store('profile_images', 'public');
          $user=User::find(auth()->user()->id);
            $user->profile_image=$filePath;
            $user->save();
            return response()->json(['success'=>true,'message'=>'Profile Image Updated','filePath' => $filePath]);
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
