@extends('layouts.email')
@section('content')
    <!-- content @s-->
        <div class="nk-content ">
            <div class="container-fluid">
                <div class="nk-content-inner">
                    <div class="nk-content-body">
                        <div class="content-page wide-md m-auto">
                            <div class="nk-block">
                                <div class="card card-bordered">
                                    <div class="card-inner">
                                        <!-- <h4 class="title text-soft mb-4 overline-title">Notification - Confirmation Email Template</h4> -->
                                        <table class="email-wraper">
                                            <tr>
                                                <td class="py-5">
                                                    <table class="email-header">
                                                        <tbody>
                                                            <tr>
                                                                <td class="text-center pb-4">
                                                                    <a href="#"><img class="email-logo"
                                                                            src="{{ asset('images/logo-dark2x.png') }}"
                                                                            alt="logo"></a>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <table class="email-body">
                                                        <tbody>
                                                            <tr>
                                                                <td class="px-3 px-sm-5 pt-3 pt-sm-5 pb-3">
                                                                    <h2 class="email-heading">Confirm Your E-Mail Address</h2>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="px-3 px-sm-5 pb-2">
                                                                    <p>Hi {{ $user->name }},</p>
                                                                    <p>Welcome! <br> You are receiving this email because you
                                                                        have registered on our site.</p>
                                                                    <p>Click the link below to active your account.</p>
                                                                    <p class="mb-4">This link will expire in 15 minutes and
                                                                        can only be used once.</p>
                                                                    <a href="{{ $verificationUrl }}" class="email-btn">Verify
                                                                        Email</a>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="px-3 px-sm-5 pt-4">
                                                                    <h4 class="email-heading-s2">or</h4>
                                                                    <p>If the button above does not work, paste this link into
                                                                        your web browser:</p>
                                                                    <a href="#"
                                                                        class="link-block">{{ $verificationUrl }}</a>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="px-3 px-sm-5 pt-4 pb-3 pb-sm-5">
                                                                    <p>If you did not make this request, please contact us or
                                                                        ignore this message.</p>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <table class="email-footer">
                                                        <tbody>
                                                            <tr>
                                                                <td class="text-center pt-4">
                                                                    <p class="email-copyright-text">Copyright © 2020 DashLite. All rights reserved. <br> Template Made By <a href="https://themeforest.net/user/softnio/portfolio">Softnio</a>.</p>
                                                                    <ul class="email-social">
                                                                        <li><a href="#"><img src="{{ asset('images/socials/facebook.png') }}" alt=""></a></li>
                                                                        <li><a href="#"><img src="{{ asset('images/socials/twitter.png') }}" alt=""></a></li>
                                                                        <li><a href="#"><img src="{{ asset('images/socials/youtube.png') }}" alt=""></a></li>
                                                                        <li><a href="#"><img src="{{ asset('images/socials/medium.png') }}" alt=""></a></li>
                                                                    </ul>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>

                                    </div>
                                </div>
                            </div><!-- .nk-block -->

                        </div><!-- .content-page -->
                    </div>
                </div>
            </div>
        </div>
        <!-- content @e -->
    @endsection
