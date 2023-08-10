<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts=Post::where('user_id',Auth::user()->id)->get();
        return view('frontend.pages.allblogs',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('frontend.pages.createblog');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required',
            'cover_image'=>'required|mimes:jpg,png,jpeg,JPEG,PNG,JPG',
        ]);
        $post=new Post();
        $post->user_id=Auth::user()->id;
        $post->title=$request->title;
        $post->description=$request->blog_body;
        if($request->hasFile('cover_image')){
            $file=$request->file('cover_image');
            $ext=$file->getClientOriginalExtension();
            $filename=time().'.'.$ext;
            $file->storeAs('public/post_covers',$filename);
            $path="post_covers/".$filename;
            $post->cover_image=$path;

        }
        $post->save();
        return redirect()->route('post.index')->with('success','Post submitted susccessfully!');
    }

    public function cke_upload(Request $request){
        // return response()->json(['url'=>'https://alimul-mahfuz.github.io/assets/images/hero.jpg']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
