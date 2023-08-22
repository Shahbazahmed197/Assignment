<div class="nk-header nk-header-fixed is-light">
    <div class="container-fluid">
        <div class="nk-header-wrap">
            <div class="nk-menu-trigger d-xl-none ml-n1">
                <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="sidebarMenu"><em
                        class="icon ni ni-menu"></em></a>
            </div>
            <div class="nk-header-brand d-xl-none">
                <a href="html/index.html" class="logo-link">
                    <img class="logo-light logo-img" src="{{ asset('images/logo.png') }}"
                        srcset="{{ asset('images/logo2x.png') }} 2x" alt="logo">
                    <img class="logo-dark logo-img" src="{{ asset('/images/logo-dark.png') }}"
                        srcset="{{ asset('/images/logo-dark2x.png') }} 2x" alt="logo-dark">
                </a>
            </div><!-- .nk-header-brand -->
            <div class="nk-header-tools">
                <ul class="nk-quick-nav">
                    <li class="dropdown user-dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <div class="user-toggle">
                                <div class="user-avatar sm">
                                    {{-- <em class="icon ni ni-user-alt"></em>
                                                     --}}
                                    @isset(auth()->user()->profile_image)
                                        <img src="{{ asset('storage/' . auth()->user()->profile_image) }}" alt="profile picture">
                                    @else
                                        <em class="icon ni ni-user-alt"></em>
                                    @endisset
                                </div>
                                <div class="user-info d-none d-md-block">
                                    {{-- <div class="user-status">{{ auth()->user()->getRoleNames()->first() }}</div> --}}
                                    <div class="user-name dropdown-indicator">{{ auth()->user()->name }}</div>
                                </div>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-md dropdown-menu-right dropdown-menu-s1">
                            <div class="dropdown-inner user-card-wrap bg-lighter d-none d-md-block">
                                <div class="user-card">
                                    <div class="user-avatar">
                                        @isset(auth()->user()->profile_image)
                                        <img src="{{ asset('storage/' . auth()->user()->profile_image) }}" alt="profile picture">
                                    @else
                                        <em class="icon ni ni-user-alt"></em>
                                    @endisset
                                    </div>
                                    <div class="user-info">
                                        <span class="lead-text">{{ Auth::user()->name }}</span>
                                        <span class="sub-text">{{ Auth::user()->email }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="dropdown-inner">
                                <ul class="link-list">
                                    <li><a href="{{ route('profile.index') }}"><em
                                                class="icon ni ni-user-alt"></em><span>View Profile</span></a></li>
                                </ul>
                            </div>
                            <div class="dropdown-inner">
                                <ul class="link-list">
                                    <form id="logoutForm" method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <li>
                                            <a id="submitFormLink" onClick="$('#logoutForm').submit()">
                                                <em class="icon ni ni-signout">
                                                </em>
                                                <span>Sign out</span>
                                            </a>
                                        </li>
                                    </form>
                                </ul>
                            </div>
                        </div>
                    </li><!-- .dropdown -->

                </ul><!-- .nk-quick-nav -->
            </div><!-- .nk-header-tools -->
        </div><!-- .nk-header-wrap -->
    </div><!-- .container-fliud -->
</div>
