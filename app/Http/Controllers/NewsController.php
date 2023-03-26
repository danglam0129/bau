<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class NewsController extends Controller
{
    public function list(Request $request)
    {
        $posts = Post::orderby('id', 'desc')->paginate(12);
        $data = $request->all();
        return view('news', compact('posts', 'data'));
    }

    public function post($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        $postss = Post::inRandomOrder()->take(4)->get();
        return view('post', compact('post','postss'));
    }
}
