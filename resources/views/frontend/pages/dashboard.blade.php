@extends('frontend.layouts.authuser')
@section('title')
    Create New
@endsection
@section('title')
    Profile
@endsection
@section('user-content')
    <div class="col-12 mb-2 col-md-9">
        <div class="card">
            <div class="card-header">
                <img height="30" width="30" src="{{ asset('assets/frontend/icons/system/user-icon.png') }}"
                    alt="">&nbsp;&nbsp;<b>User's Profile</b>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-4 col-md-2">
                        <img id="profile-image"
                            src="{{ Auth::user()->profile_image == null ? asset('assets/frontend/images/no-image.jpg') : asset('storage/' . Auth::user()->profile_image) }}"
                            class="mb-1 rounded float-start avater-image" alt="...">
                    </div>
                    <div class="col-8 col-md-10">
                        <h4>{{ Auth::user()->name }}</h4>
                        <p>{{ Auth::user()->email }}</p>
                        <form action="" id="profie-img-upload" class="d-flex align-items-center"
                            enctype="multipart/form-data" method="post">
                            @csrf
                            <p class="mb-0 me-3"><label for="profile_image"
                                    class="link-unstyled btn btn-sm rounded bg-lavender"><input type="file"
                                        name="profile_image" hidden id="profile_image"><img width="20" height="20"
                                        src="https://img.icons8.com/fluency/48/pencil-tip.png"
                                        alt="pencil-tip" />&nbsp;Change picture</a></p>
                            <button type="submit" id="btn-image-save"
                                class="btn btn-sm btn-primary d-block d-none">Save</button>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="card border border-0" style="background: none !important;">
                            <div class="card-body p-0">
                                <form method="post" id="personal-details-form">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="fullname" class="form-label">Full Name</label>
                                        <input type="text" class="form-control" id="fullname"
                                            value="{{ Auth::user()->name }}" name="fullname" aria-describedby="emailHelp">
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email address</label>
                                        <input type="email" class="form-control" name="email" id="email"
                                            value="{{ Auth::user()->email }}" aria-describedby="emailHelp">
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <div class="form-text" id="basic-info-status"></div>
                                        <button type="submit"
                                            class="d-inline-block btn btn-primary float-end">Save</button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if (Auth::user()->password != null)
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <div class="card">
                                <div class="card-header">
                                    <img height="30" width="30"
                                        src="{{ asset('assets/frontend/icons/system/lock-icon.png') }}"
                                        alt="">&nbsp;&nbsp;<b>Change password</b>
                                </div>
                                <div class="card-body p-3">
                                    <form method="post" id="password-update">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="oldpassword" class="form-label">Current Password</label>
                                            <input type="password" name="current_password" class="form-control"
                                                id="current_password">
                                        </div>
                                        <div class="mb-3">
                                            <label for="newpassword" class="form-label">New Password</label>
                                            <input type="password" name="password" class="form-control" id="password">
                                        </div>
                                        <div class="mb-3">
                                            <label for="confirmPassword" class="form-label">Re-enter new password</label>
                                            <input type="password" class="form-control" name="password_confirmation" id="confirmPassword">
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <div class="form-text" id="password-info-status"></div>
                                            <button type="submit"
                                                class="d-inline-block btn btn-primary float-end">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <div><img height="30" width="30"
                                        src="{{ asset('assets/frontend/icons/system/delete-icon.png') }}"
                                        alt="">&nbsp;&nbsp;Delete Your account</div>
                                <div><button class="btn btn-danger float-end bg-bloody-mimosa">Delete Account</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/frontend/js/auth.js') }}"></script>
@endsection
