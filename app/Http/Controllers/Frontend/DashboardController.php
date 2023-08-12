<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class DashboardController extends Controller
{
    function profile()
    {
        return view('frontend.pages.dashboard');
    }

    function profile_image_upload(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'profile_image' => "mimes:jpg,jpeg,png,JPEG,PNG,JPG"
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        if ($request->hasFile('profile_image')) {
            $user = User::find(Auth::user()->id);
            if ($request->hasFile('profile_image')) {
                if ($user->profile_image != null) {

                    if (\Storage::exists('public/' . $user->profile_image)) {
                        \Storage::delete('public/' . $user->profile_image);
                    }

                }
                $file = $request->file('profile_image');
                $name = time() . $file->getClientOriginalName();
                $path = 'userimage/' . $name;
                $file->storeAs('public/userimage/', $name);
                $user->profile_image = $path;
                $user->save();
            }


            return response()->json([
                'message' => 'Profile image changes successfully!',
                'image_url' => $user->profile_image,
            ]);
        }
    }

    public function update_basicInfo(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $validator = Validator::make($request->all(), [
            'fullname' => 'required',
            'email' => [
                'required',
                Rule::unique('users')->ignore($user)
            ],
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $user->name = $request->fullname;
        $user->email=$request->email;
        $user->save();
        return response()->json(['success' => true, 'message' => 'Informatin successfully updated']);
    }

    function update_password(Request $request){
        $validator=Validator::make($request->all(),[
            'old_password'=>'required',
            'password'=>'required|confirmed',
        ]);
        
    }
}