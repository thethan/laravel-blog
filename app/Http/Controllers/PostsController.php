<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function index()
    {
        return Post::all();
    }


    public function get($slug)
    {
        $post = Post::where('slug', $slug)->first();
        return view('posts.post', ['post' => $post]);
    }
}
