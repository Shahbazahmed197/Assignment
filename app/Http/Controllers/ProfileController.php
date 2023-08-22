<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\UpdateProfileImage;
use App\Jobs\SendVerifyEmailNotification;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function index(Request $request): View
    {
        return view('profile.index', [
            'user' => $request->user(),
        ]);
    }
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request)
    {
            $emailVerified=true;
            $request->user()->fill($request->validated());

            if ($request->user()->isDirty('email')) {
                $request->user()->email_verified_at = null;
                $emailVerified=false;
                SendVerifyEmailNotification::dispatch($request->user());
            }

            $request->user()->save();

             return response()->json(["success"=>true,"message"=>"profile updated","data"=>['user'=>$request->validated(),
             'verified'=>$emailVerified]]);
    }
    public function updateProfilePicture(UpdateProfileImage $request)
    {
        $image = $request->file('image');
        $filePath = $image->store('profile_images', 'public');
          $user=User::find(auth()->user()->id);
            $user->profile_image=$filePath;
            $user->save();
            return response()->json(['success'=>true,'message'=>'Profile Image Updated','filePath' => Storage::url($filePath)]);
    }
    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
