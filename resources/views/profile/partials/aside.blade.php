<div class="card-aside card-aside-left user-aside toggle-slide toggle-slide-left toggle-break-lg" data-content="userAside"
    data-toggle-screen="lg" data-toggle-overlay="true">
    <div class="card-inner-group" data-simplebar>
        <div class="card-inner">
            <div class="user-card">
                <div class="user-avatar bg-primary">
                    @isset(auth()->user()->profile_image)
                    <img src="{{ asset('storage/' . auth()->user()->profile_image) }}" alt="profile picture">
                @else
                <span>AB</span>
                @endisset
                </div>
                <div class="user-info">
                    <span class="lead-text user-name">{{ $user->name }}</span>
                    <span class="sub-text user-email">{{ $user->email }}</span>
                </div>
                <div class="user-action">
                    <div class="dropdown">
                        <a class="btn btn-icon btn-trigger mr-n2" data-toggle="dropdown" href="#"><em
                                class="icon ni ni-more-v"></em></a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <ul class="link-list-opt no-bdr">
                                <li data-toggle="modal" data-target="#change-photo"><a><em
                                            class="icon ni ni-camera-fill"></em><span>Change Photo</span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div><!-- .user-card -->
        </div><!-- .card-inner -->

        <div class="card-inner p-0">
            <ul class="link-list-menu">
                <li><a class="{{ Route::is('profile.index') ? 'active' : '' }}" href="{{ route('profile.index') }}"><em
                            class="icon ni ni-user-fill-c"></em><span>Personal Infomation</span></a></li>
                <li><a class="{{ Route::is('setting.index') ? 'active' : '' }}" href="{{ route('setting.index') }}"><em
                            class="icon ni ni-lock-alt-fill"></em><span>Security Settings</span></a></li>
            </ul>
        </div><!-- .card-inner -->
    </div><!-- .card-inner-group -->
</div><!-- card-aside -->
<div class="modal fade" role="dialog" id="change-photo">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        @include('profile.partials.change-photo-form')
    </div><!-- .modal-dialog -->
</div><!-- .modal -->


