<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterFormRequest;
use App\Mail\PasswordRecoveryEmail;
use App\Models\PasswordResetToken;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;

class AuthenticationController extends Controller
{
    /**
     * @param none
     * @method none login() to return the view page
     */
    function login()
    {
        return view('frontend.auth.login');
    }
    function login_post(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        $do_remember = $request->has('remember');
        if (Auth::attempt($request->only('email', 'password'), $do_remember)) {
            return redirect()->route('home');
        }
        else{
            return redirect()->back()->with('failed','Email or password is invalid');
        }
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
            return redirect()->route('home');
        }

    }
    function reset_request()
    {
        return view('frontend.auth.reset-request');
    }
    function google_singin_redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * @throws user not found exception
     */
    function google_singin_callback()
    {
        try {
            $user = Socialite::driver('google')->stateless()->user();
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

    // Handel twitter oauth2 service
    // function twitter_singin_redirect()
    // {
    //     return Socialite::driver('twitter-oauth-2')->redirect();
    // }
    // function twitter_singin_callback()
    // {
    //     try {
    //         $user = Socialite::driver('twitter-oauth-2')->user();
    //         dd ($user);
    //         $email = $user->email;
    //         $existingUser = User::where('email', $email)->first();
    //         if ($existingUser) {
    //             Auth::login($existingUser);
    //         } else {
    //             $newuser = User::create([
    //                 'name' => $user->name,
    //                 'email' => $user->email,
    //                 'profile_image' => $user->avatar,
    //             ]);
    //             Auth::login($newuser);
    //         }
    //         return redirect()->route('home');
    //     } catch (\Throwable $th) {
    //         dd($th->getMessage());
    //     }
    // }

    function logout(Request $request)
    {
        Auth::logout();
        session()->flush();
        session()->regenerate();
        return redirect()->route('home');
    }

    function reset_request_post(Request $request)
    {
        // return response()->json("Hello Peter");
        $validator = Validator::make($request->all(), [
            'email' => 'required'
        ]);
        // return response()->json($request->all());
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $is_exists = User::where('email', $request->email)->first();
        if (!$is_exists) {
            return response()->json(['is_exists' => false]);
        }
        $resetToken = DB::table('password_reset_tokens')->where('email', $request->email)->first();
        if ($resetToken==null) {
            $resetToken = DB::table('password_reset_tokens')->insert([
                'email' => $request->email,
                'token' => Str::random(64),
                'created_at' => Carbon::now(),
            ]);
        }
        Mail::to($request->email)->send(new PasswordRecoveryEmail($resetToken));
        return response()->json([
            'is_exists' => true,
            'email' => $request->email,
        ]);
    }

    /**
     * @param mixed $email the email that provided by the user for reset paassword
     * @param mixed $token the password reset token that send to the user via email
     * If the email and token matched the user will redirect to the view page of
     * reset password
     */
    function reset_password($email, $token)
    {
        $token = PasswordResetToken::where('email', $email)->where('token', $token)->first();
        if ($token) {
            return view('frontend.auth.new-password', compact('email'));
        }
        return "Invalid Request!";
    }

    /**
     * @return RedirectResponse to the route login where user can update the new password
     * This function only responsible in case of forgot password of unauthenticated user. 
     */
    function update_password(Request $request):RedirectResponse
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required|confirmed'
        ]);
        $user = User::where('email', $request->email)->first();
        $user->password = Hash::make($request->password);
        $user->save();
        DB::table('password_reset_tokens')->where('email', $request->email)->delete();
        return redirect()->route('user.login')->with('success', 'Password updated successfully!');

    }

    function test()
    {
        $resetToken = DB::table('password_reset_tokens')->where('email', 'alimulmahfuztushar@gmail.com')->first();
        if ($resetToken==null) {
            $resetToken = DB::table('password_reset_tokens')->insert([
                'email' => 'alimulmahfuztushar@gmail.com',
                'token' => Str::random(64),
                'created_at' => Carbon::now(),
            ]);
        }
        Mail::to('alimulmahfuztushar@gmail.com')->send(new PasswordRecoveryEmail($resetToken));
        dd($resetToken);
    }


}