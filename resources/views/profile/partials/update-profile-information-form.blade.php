<section>
    <header>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update',['profile'=>"me"]) }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div class="form-group">
            <label class="form-label" for="name">Name</label>
            <div class="form-control-wrap">
                <input type="text" name="name" value="{{ $user->name }}" required  class="form-control form-control-lg" id="name" placeholder="Enter your name">
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>
        </div>
        <div class="form-group">
            <label class="form-label" for="email">Email</label>
            <div class="form-control-wrap">
                <input type="email" name="email" value={{ $user->email }} required class="form-control form-control-lg" id="email" placeholder="Enter your email address">
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-success text-green-600 dark:text-green-400">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
                @else
                <div>
                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                        {{ __('Your email address is verified.') }}
                    </p>
                </div>
            @endif


        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-lg btn-primary">Update Profile</button>
        </div>
        <div class="flex items-center gap-4">
            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
