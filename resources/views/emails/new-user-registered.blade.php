@extends('layouts.email')
@section('content')
    <!-- content @s
        -->
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
                                                                    <h2 class="email-heading">New User Registered</h2>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="px-3 px-sm-5 pb-2">
                                                                    <p>Hi Admin,</p>
                                                                    <p> You are receiving this email because a new user have
                                                                        registered on your site
                                                                        with following details.</p>
                                                                    <p>Name: {{ $user->name }}</p>
                                                                    <p class="mb-4">Email: {{ $user->email }}</p>
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
