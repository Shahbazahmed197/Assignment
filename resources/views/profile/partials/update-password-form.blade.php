<section>

        <form method="POST" id="updatePasswordForm">
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
                    id="password" value="{{ old('current_password') }}" placeholder="Enter your current password" aria-invalid="false">
                            </div>
        </div>

        <!-- New Password -->
        <div class="form-group">
            <label class="form-label" for="password">New Password</label>
            <div class="form-control-wrap">
                <a tabindex="-1" href="#" class="form-icon form-icon-right passcode-switch lg"
                    data-target="new_password">
                    <em class="passcode-icon icon-show icon ni ni-eye"></em>
                    <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                </a>
                <input type="password" required name="password" value="{{ old('password') }}" class="form-control form-control-lg" id="new_password"
                    placeholder="Enter your new password">
            </div>
        </div>
        <!--Confirm New Password -->
        <div class="form-group">
            <label class="form-label" for="password_confirmation">Confirm New Password</label>
            <div class="form-control-wrap">
                <a tabindex="-1" href="#" class="form-icon form-icon-right passcode-switch lg"
                    data-target="password_confirmation">
                    <em class="passcode-icon icon-show icon ni ni-eye"></em>
                    <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                </a>
                <input type="password" required name="password_confirmation" value="{{ old('password_confirmation') }}" class="form-control form-control-lg"
                    id="password_confirmation" placeholder="Enter your new password again">
                </div>
        </div>

        <div class="flex items-center gap-4">
            <div class="form-group">
                <button type="button" class="btn btn-lg btn-primary submit-btn " id="update-password-button"> Change Password</button>
            </div>

            {{-- @if (session('success') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400">{{ __('Saved.') }}</p>
            @endif --}}
        </div>
    </form>
    <script>
    $(document).ready(function() {
            NioApp.Passcode('.passcode-switch');
    });
    </script>

</section>
