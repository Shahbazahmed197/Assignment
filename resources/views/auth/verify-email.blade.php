@extends('layouts.guest')
@section('title')
    Verify
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
                            <a href="#" class="toggle btn btn-white btn-icon btn-light" data-target="athPromo"><em class="icon ni ni-info"></em></a>
                        </div>
                        <div class="nk-block nk-block-middle nk-auth-body">
                            <div class="brand-logo pb-5">
                                <a href="html/index.html" class="logo-link">
                                    <img class="logo-light logo-img logo-img-lg" src="./images/logo.png" srcset="./images/logo2x.png 2x" alt="logo">
                                    <img class="logo-dark logo-img logo-img-lg" src="./images/logo-dark.png" srcset="./images/logo-dark2x.png 2x" alt="logo-dark">
                                </a>
                            </div>
                            <div class="nk-block-head">
                                <div class="nk-block-head-content">
                                    <h5 class="nk-block-title">Verify Email</h5>
                                    <div class="nk-block-des">
                                        <p>Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another.</p>
                                    </div>
                                </div>
                            </div><!-- .nk-block-head -->
                            <div class="mt-4 flex items-center justify-between">
                                <form method="POST" action="{{ route('verification.send') }}">
                                    @csrf
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-lg btn-primary btn-block">Resend Verification Email</button>
                                    </div>
                                </form>

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <button type="submit" class="btn btn-lg btn-info">
                                        Log Out
                                    </button>
                                </form>
                            </div>
                        </div><!-- .nk-block -->
                        <div class="nk-block nk-auth-footer">
                            <div class="mt-3">
                                <p>&copy; 2022 DashLite. All Rights Reserved.</p>
                            </div>
                        </div><!-- .nk-block -->
                    </div><!-- .nk-split-content -->
                    <div class="nk-split-content nk-split-stretch bg-lighter d-flex toggle-break-lg toggle-slide toggle-slide-right" data-content="athPromo" data-toggle-screen="lg" data-toggle-overlay="true">
                        <div class="w-100 w-max-550px p-3 p-sm-5 m-auto">
                            <div class="nk-feature nk-feature-center">
                                <div class="nk-feature-img">
                                    <img class="round" src="./images/slides/promo-a.png" srcset="./images/slides/promo-a2x.png 2x" alt="">
                                </div>
                                <div class="nk-feature-content py-4 p-sm-5">
                                    <h4>Dashlite</h4>
                                    <p>You can start to create your products easily with its user-friendly design & most completed responsive layout.</p>
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
