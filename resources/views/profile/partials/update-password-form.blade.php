<section>

        <form method="POST" action="{{ route('password.update') }}">
        @csrf
        @method('put')
        <!--Current Password -->
        <div class="form-group">
            <label class="form-label" for="current_password">Current Password</label>
            <div class="form-control-wrap">
                <a tabindex="-1" href="#" class="form-icon form-icon-right passcode-switch lg"
                    data-target="password">
                    <em class="passcode-icon icon-show icon ni ni-eye"></em>
                    <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                </a>
                <input type="password" required name="current_password" class="form-control form-control-lg"
                    id="current_password" value="{{ old('current_password') }}" placeholder="Enter your current password">
                <x-input-error :messages="$errors->get('current_password')" class="mt-2" />
            </div>
        </div>

        <!-- New Password -->
        <div class="form-group">
            <label class="form-label" for="password">New Password</label>
            <div class="form-control-wrap">
                <a tabindex="-1" href="#" class="form-icon form-icon-right passcode-switch lg"
                    data-target="password">
                    <em class="passcode-icon icon-show icon ni ni-eye"></em>
                    <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                </a>
                <input type="password" required name="password" value="{{ old('password') }}" class="form-control form-control-lg" id="password"
                    placeholder="Enter your new password">
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
        </div>
        <!--Confirm New Password -->
        <div class="form-group">
            <label class="form-label" for="password_confirmation">Confirm New Password</label>
            <div class="form-control-wrap">
                <a tabindex="-1" href="#" class="form-icon form-icon-right passcode-switch lg"
                    data-target="password">
                    <em class="passcode-icon icon-show icon ni ni-eye"></em>
                    <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                </a>
                <input type="password" required name="password_confirmation" value="{{ old('password_confirmation') }}" class="form-control form-control-lg"
                    id="password_confirmation" placeholder="Enter your new password again">
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>
        </div>

        <div class="flex items-center gap-4">
            <div class="form-group">
                <button type="submit" class="btn btn-lg btn-primary "> Change Password</button>
            </div>

            @if (session('success') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
