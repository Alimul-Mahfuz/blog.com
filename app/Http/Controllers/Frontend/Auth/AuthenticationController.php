<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthenticationController extends Controller
{
    //
    function login(){
        return view('frontend.auth.login');
    }
    function register(){
        return view('frontend.auth.register');
    }

}
