<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Jobs\SendVerifyEmailNotification;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
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
        // Determine the type of update based on the input fields present
        if ($request->has('profile_image')) {
            // // Update profile image
            // $request->validate([
            //     'profile_image' => 'required',
            // ]);
            // $user=User::find(auth()->user()->id);

            // Process and update profile image
            // ...
            // Redirect with success message
            return response()->json(['success'=>true,'message' => 'profile image updated', 'data' => ""]);
        }else{
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
