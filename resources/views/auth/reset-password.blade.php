@extends('layouts.guest')
@section('title')
    Reset-Password
@endsection
@section('content')
    <div class="nk-app-root">
        <!-- main @s -->
        <div class="nk-main ">
            <!-- wrap @s -->
            <div class="nk-wrap nk-wrap-nosidebar">
                <!-- content @s -->
                    <div class="nk-content ">
                        <div class="nk-split nk-split-page nk-split-md">
                            <div class="nk-split-content nk-block-area nk-block-area-column nk-auth-container bg-white w-lg-45">
                                <div class="absolute-top-right d-lg-none p-3 p-sm-5">
                                    <a href="#" class="toggle btn btn-white btn-icon btn-light" data-target="athPromo"><em
                                            class="icon ni ni-info"></em></a>
                                </div>
                                <div class="nk-block nk-block-middle nk-auth-body">
                                    <div class="brand-logo pb-5">
                                        <a href="html/index.html" class="logo-link">
                                            <img class="logo-light logo-img logo-img-lg" src="./images/logo.png"
                                                srcset="./images/logo2x.png 2x" alt="logo">
                                            <img class="logo-dark logo-img logo-img-lg" src="./images/logo-dark.png"
                                                srcset="./images/logo-dark2x.png 2x" alt="logo-dark">
                                        </a>
                                    </div>
                                    <div class="nk-block-head">
                                        <div class="nk-block-head-content">
                                            <h5 class="nk-block-title">Reset password</h5>
                                            <div class="nk-block-des">
                                                <p>You can set your new password that you want.</p>
                                            </div>
                                        </div>
                                    </div><!-- .nk-block-head -->
                                    <form method="POST" action="{{ route('password.store') }}">
                                        @csrf

                                        <!-- Password Reset Token -->
                                        <input type="hidden" name="token" value="{{ $request->route('token') }}">

                                        <!-- Email Address -->
                                        <div class="form-group">
                                            <div class="form-label-group">
                                                <label class="form-label" for="default-01">Email</label>
                                            </div>
                                            <div class="form-control-wrap">
                                                <input type="email" name="email" value="{{ old('email', $request->email) }}"
                                                    required class="form-control form-control-lg" id="default-01"
                                                    placeholder="Enter your email address">
                                            </div>
                                        </div>
                                        <!-- Password -->
                                        <div class="form-group">
                                            <label class="form-label" for="password">Password</label>
                                            <div class="form-control-wrap">
                                                <a tabindex="-1" href="#"
                                                    class="form-icon form-icon-right passcode-switch lg" data-target="password">
                                                    <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                                    <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                                                </a>
                                                <input type="password" required name="password"
                                                    class="form-control form-control-lg" id="password"
                                                    placeholder="Enter your passcode">
                                            </div>
                                        </div>
                                        <!-- Confirm Password -->
                                        <div class="form-group">
                                            <label class="form-label" for="password_confirmation">Confirm Password</label>
                                            <div class="form-control-wrap">
                                                <a tabindex="-1" href="#"
                                                    class="form-icon form-icon-right passcode-switch lg" data-target="password_confirmation">
                                                    <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                                    <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                                                </a>
                                                <input type="password" required name="password_confirmation"
                                                    class="form-control form-control-lg" id="password_confirmation"
                                                    placeholder="Enter password again">

                                            </div>
                                        </div>
                                        <!-- Submit button -->
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-lg btn-primary btn-block"> Reset
                                                Password</button>
                                        </div>
                                    </form><!-- form -->
                                    <div class="form-note-s2 pt-5">
                                        <a href="html/pages/auths/auth-login.html"><strong>Return to login</strong></a>
                                    </div>
                                </div><!-- .nk-block -->
                                <div class="nk-block nk-auth-footer">
                                    <div class="mt-3">
                                        <p>&copy; 2022 DashLite. All Rights Reserved.</p>
                                    </div>
                                </div><!-- .nk-block -->
                            </div><!-- .nk-split-content -->
                            <div class="nk-split-content nk-split-stretch bg-lighter d-flex toggle-break-lg toggle-slide toggle-slide-right"
                                data-content="athPromo" data-toggle-screen="lg" data-toggle-overlay="true">
                                <div class="w-100 w-max-550px p-3 p-sm-5 m-auto">
                                    <div class="nk-feature nk-feature-center">
                                        <div class="nk-feature-img">
                                            <img class="round" src="./images/slides/promo-a.png"
                                                srcset="./images/slides/promo-a2x.png 2x" alt="">
                                        </div>
                                        <div class="nk-feature-content py-4 p-sm-5">
                                            <h4>Dashlite</h4>
                                            <p>You can start to create your products easily with its user-friendly design & most
                                                completed responsive layout.</p>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- .nk-split-content -->
                        </div><!-- .nk-split -->
                    </div>
                    <!-- wrap @e -->
                </div>
                <!-- content @e -->
            </div>
            <!-- main @e -->
        </div>
    @endsection
