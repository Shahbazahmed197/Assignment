@extends('layouts.master')

@section('title')
    Profile
@endsection
@section('content')
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block">
                    <div class="card card-bordered">
                        <div class="card-aside-wrap">
                            <div class="card-inner card-inner-lg">
                                <div class="nk-block-head nk-block-head-lg">
                                    <div class="nk-block-between">
                                        <div class="nk-block-head-content">
                                            <h4 class="nk-block-title">Personal Information</h4>
                                            <div class="nk-block-des">
                                                <p>Basic info, like your name and address.</p>
                                            </div>
                                        </div>
                                        <div class="nk-block-head-content align-self-start d-lg-none">
                                            <a href="#" class="toggle btn btn-icon btn-trigger mt-n1" data-target="userAside"><em class="icon ni ni-menu-alt-r"></em></a>
                                        </div>
                                    </div>
                                </div><!-- .nk-block-head -->
                                <div class="nk-block">
                                    <div class="nk-data data-list">
                                        <div class="data-head">
                                            <h6 class="overline-title">Basics</h6>
                                        </div>
                                        <div class="data-item" data-toggle="modal" data-target="#profile-edit">
                                            <div class="data-col">
                                                <span class="data-label">Full Name</span>
                                                <span class="data-value user-name">{{ $user->name }}</span>
                                            </div>
                                            <div class="data-col data-col-end"><span class="data-more"><em class="icon ni ni-forward-ios"></em></span></div>
                                        </div><!-- data-item -->
                                        <div class="data-item" >
                                            <div class="data-col">
                                                <span class="data-label">Email</span>
                                                <span class="data-value user-email">{{ $user->email }}</span>
                                            </div>
                                            <div class="data-col data-col-end"></div>
                                        </div><!-- data-item -->
                                    </div><!-- data-list -->
                                </div><!-- .nk-block -->
                            </div>
                            @include('profile.partials.aside')
                        </div><!-- .card-aside-wrap -->
                    </div><!-- .card -->
                </div><!-- .nk-block -->
            </div>
        </div>
    </div>

        <!-- @@ Profile Edit Modal @e -->
        <div class="modal fade" role="dialog" id="profile-edit">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <a href="#" class="close" data-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                    <div class="modal-body modal-body-lg">
                        <h5 class="title">Update Profile</h5>
                     @include('profile.partials.update-profile-information-form')

                    </div><!-- .modal-body -->
                </div><!-- .modal-content -->
            </div><!-- .modal-dialog -->
        </div><!-- .modal -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        @push('scripts')

        <script>

    $(document).ready(function() {
        $('.update-profile').click(function() {
            console.log('Button clicked');
            var submitBtn = $('.submit-btn');
            submitBtn.prop('disabled', true);
            submitBtn.html(loader);
            var formData = new FormData(document.getElementById('updateProfileInfromationForm'));
            var formDataJSON = {};

            formData.forEach(function(value, key) {
                formDataJSON[key] = value;
            });

            var formDataString = JSON.stringify(formDataJSON);
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            // Send AJAX request to the controller
            $.ajax({
                url: '/profile/'+'me',
                type: 'PUT',
                data: formDataString,
                contentType: 'application/json',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },

                processData: false,
                success: function(response) {
                    $('.user-name').html(response.data.user.name);
                    $('.user-email').html(response.data.user.email);
                    submitBtn.html('Update Profile');
                    submitBtn.prop('disabled', false);
                    $('.modal').modal('hide');
                    NioApp.Toast(response.message, 'success');
                },
                error: function(xhr, status, error, response) {
                    // Show error message in the responseMessage
                    submitBtn.prop('disabled', false);
                    submitBtn.html('Update Profile');
                    NioApp.Toast(xhr.responseJSON.message, 'error');
                }
            });
        });
    });
        </script>

        @endpush
@endsection
