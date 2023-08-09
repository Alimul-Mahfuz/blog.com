<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterFormRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class AuthenticationController extends Controller
{
    //
    function login()
    {
        return view('frontend.auth.login');
    }
    function register()
    {
        return view('frontend.auth.register');
    }
    function post_register(RegisterFormRequest $request)
    {
        $request->validated($request->all());
        User::create([
            'name' => $request->fullname,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        $do_remember = $request->has('remember');
        if (Auth::attempt($request->only('email', 'password'), $do_remember)) {
            return 'login successful';
        }

    }

    function google_singin_redirect()
    {
        return Socialite::driver('google')->redirect();
    }
    function google_singin_callback()
    {
        try {
            $user = Socialite::driver('google')->user();
            // dd ($user);
            $email = $user->email;
            $existingUser = User::where('email', $email)->first();
            if ($existingUser) {
                Auth::login($existingUser);
            } else {
                $newuser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'profile_image' => $user->avatar,
                ]);
                Auth::login($newuser);
            }
            return redirect()->route('home');
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }

    // Non functional code
    function twitter_singin_redirect()
    {
        return Socialite::driver('twitter-oauth-2')->redirect();
    }
    function twitter_singin_callback()
    {
        try {
            $user = Socialite::driver('twitter-oauth-2')->user();
            dd ($user);
            // $email = $user->email;
            // $existingUser = User::where('email', $email)->first();
            // if ($existingUser) {
            //     Auth::login($existingUser);
            // } else {
            //     $newuser = User::create([
            //         'name' => $user->name,
            //         'email' => $user->email,
            //         'profile_image' => $user->avatar,
            //     ]);
            //     Auth::login($newuser);
            // }
            // return redirect()->route('home');
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }
    // End non functional code

    function logout(Request $request){
        Auth::logout();
        session()->flush();
        session()->regenerate();
        return redirect()->route('home');
    }

}