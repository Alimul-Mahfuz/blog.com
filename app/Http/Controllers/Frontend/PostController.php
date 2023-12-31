<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::where('user_id', Auth::user()->id)->paginate(6);
        return view('frontend.pages.allblogs', compact('posts'));
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
            'title' => 'required',
            'cover_image' => 'required|mimes:jpg,png,jpeg,JPEG,PNG,JPG',
        ]);
        $post = new Post();
        $post->user_id = Auth::user()->id;
        $post->title = $request->title;
        $post->description = $request->blog_body;
        if ($request->hasFile('cover_image')) {
            $file = $request->file('cover_image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->storeAs('public/post_covers', $filename);
            $path = "post_covers/" . $filename;
            $post->cover_image = $path;

        }
        $post->save();
        return redirect()->route('post.index')->with('success', 'Post submitted susccessfully!');
    }

    public function cke_upload(Request $request)
    {
        // return response()->json(['url'=>'https://alimul-mahfuz.github.io/assets/images/hero.jpg']);
    }

    /**
     * Display the specified resource.
     * This will show detailed view of the post
     */
    public function show(string $id)
    {
        $post = Post::find($id);
        $this->authorize('view', $post);
        return view('frontend.pages.viewblog', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param mixed $id of post.
     */
    public function edit(Request $request, string $id)
    {
        $post = Post::find($id);
        $this->authorize('view', $post);
        // if ($request->user()->cannot('view', $post)) {
        //     abort(403);
        // }
        return view('frontend.pages.editblog', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required',
            'cover_image' => 'mimes:jpg,png,jpeg,JPEG,PNG,JPG',
        ]);
        // dd ($request->all());
        $post = Post::find($id);
        $this->authorize('update', $post);
        $post->title = $request->title;
        $post->description = $request->blog_body;
        $coverImagePath = $post->cover_image;
        if ($request->hasFile('cover_image')) {
            if (Storage::exists('public/' . $coverImagePath)) {
                Storage::delete('public/' . $post->cover_image);
                $file = $request->file('cover_image');
                $ext = $file->getClientOriginalExtension();
                $filename = time() . '.' . $ext;
                $file->storeAs('public/post_covers', $filename);
                $path = "post_covers/" . $filename;
                $post->cover_image = $path;
            }
        }
        $post->save();
        return redirect()->back()->with('success', 'Post updated susccessfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::find($id);
        if ($post) {
            $post->delete();
            if (Storage::exists('public/' . $post->cover_image)) {
                Storage::delete('public/' . $post->cover_image);
            }
            session()->flash('status', 'Post deleted successfully!');
            return redirect()->route('post.index');
        } else {
            abort(404, 'Post no found');
        }

    }

    public function post_search($query = '')
    {
        if ($query === '') {
            $post = '';
        } else {
            $post = Post::select('title','id')->where('title', 'like', '%' . $query . '%')->get();
        }
        return response()->json($post,200);
    }

    public function user_search($query=''){
        if ($query === '') {
            $post = '';
        } else {
            $post = Post::select('title','id')->where('title', 'like', '%' . $query . '%')->where('user_id',Auth::user()->id)->get();
        }
        return response()->json($post,200);
    }
}