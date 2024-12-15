<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function detail($slug){
        $post = Post::where('slug', $slug)->with('user')->first();

        return view('client.blog.blog-detail', compact('post'));
    }
}
