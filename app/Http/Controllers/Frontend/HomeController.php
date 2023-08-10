<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    function index(){
        $posts=Post::all();
        return view('welcome',compact('posts'));
    }

    function read_blog($id){
        $post=Post::find($id);
        return view('frontend.pages.guestread',compact('post'));
    }
}
