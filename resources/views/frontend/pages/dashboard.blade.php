@extends('frontend.layouts.authuser')
@section('title')
    Create New
@endsection
@section('title')
    Profile
@endsection
@section('user-content')
    <div class="col-12 mb-2 col-md-9">
        <div class="card bg-cucumber-water border border-0">
            <div class="card-header">
                <img height="30" width="30" src="{{asset('assets/frontend/icons/system/user-icon.png')}}" alt="">&nbsp;&nbsp;<b>User's Profile</b>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-4 col-md-2">
                        <img src="{{ $image = Auth::user()->profile_image ?? asset('assets/frontend/images/no-image.jpg') }}"
                            class="mb-1 rounded float-start avater-image" alt="...">
                    </div>
                    <div class="col-8 col-md-10">
                        <h4>{{ Auth::user()->name }}</h4>
                        <p>{{ Auth::user()->email }}</p>
                        <p><a href="" class="link-unstyled border border-1 p-2 rounded bg-lavender"><img width="20" height="20" src="https://img.icons8.com/fluency/48/pencil-tip.png" alt="pencil-tip"/>&nbsp;Change picture</a></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="card border border-0" style="background: none !important;">
                            <div class="card-body p-0">
                                <form>
                                    <div class="mb-3">
                                        <label for="fullname" class="form-label">Full Name</label>
                                        <input type="text" class="form-control" id="fullname"
                                            value="{{ Auth::user()->name }}" aria-describedby="emailHelp">
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email address</label>
                                        <input type="email" class="form-control" id="email"
                                            value="{{ Auth::user()->email }}" aria-describedby="emailHelp">
                                    </div>
                                    <button type="submit" class="btn btn-primary float-end">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <div class="card border border-0">
                            <div class="card-header">
                                <img height="30" width="30" src="{{asset('assets/frontend/icons/system/lock-icon.png')}}" alt="">&nbsp;&nbsp;<b>Change password</b>
                            </div>
                            <div class="card-body p-3">
                                <form>
                                    <div class="mb-3">
                                        <label for="oldpassword" class="form-label">Old Password</label>
                                        <input type="password" class="form-control" id="oldpassword">
                                    </div>
                                    <div class="mb-3">
                                        <label for="newpassword" class="form-label">New Password</label>
                                        <input type="password" class="form-control" id="newpassword">
                                    </div>
                                    <div class="mb-3">
                                        <label for="confirmPassword" class="form-label">Re-enter new password</label>
                                        <input type="password" class="form-control" id="confirmPassword">
                                    </div>
                                    <button type="submit" class="btn btn-primary float-end">Save</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <div class="card border border-0">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <div><img height="30" width="30" src="{{asset('assets/frontend/icons/system/delete-icon.png')}}" alt="">&nbsp;&nbsp;Delete Your account</div>
                                <div><button class="btn btn-danger float-end bg-bloody-mimosa">Delete Account</button></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
