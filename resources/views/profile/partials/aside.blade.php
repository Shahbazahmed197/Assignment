<div class="card-aside card-aside-left user-aside toggle-slide toggle-slide-left toggle-break-lg" data-content="userAside" data-toggle-screen="lg" data-toggle-overlay="true">
    <div class="card-inner-group" data-simplebar>
        <div class="card-inner">
            <div class="user-card">
                <div class="user-avatar bg-primary">
                    <span>AB</span>
                </div>
                <div class="user-info">
                    <span class="lead-text">{{ $user->name }}</span>
                    <span class="sub-text">{{ $user->email }}</span>
                </div>
                <div class="user-action">
                    <div class="dropdown">
                        <a class="btn btn-icon btn-trigger mr-n2" data-toggle="dropdown" href="#"><em class="icon ni ni-more-v"></em></a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <ul class="link-list-opt no-bdr">
                                <li><a href="#"><em class="icon ni ni-edit-fill"></em><span>Update Profile</span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div><!-- .user-card -->
        </div><!-- .card-inner -->
        <div class="card-inner">
            <div class="user-account-info py-0">
                <h6 class="overline-title-alt">Nio Wallet Account</h6>
                 </div>
        </div><!-- .card-inner -->
        <div class="card-inner p-0">
            <ul class="link-list-menu">
                <li><a class="{{ Route::is('profile.index') ? 'active' : '' }}" href="{{ route('profile.index') }}"><em class="icon ni ni-user-fill-c"></em><span>Personal Infomation</span></a></li>
                 <li><a class="{{ Route::is('setting.index') ? 'active' : '' }}" href="{{ route('setting.index') }}"><em class="icon ni ni-lock-alt-fill"></em><span>Security Settings</span></a></li>
            </ul>
        </div><!-- .card-inner -->
    </div><!-- .card-inner-group -->
</div><!-- card-aside -->
