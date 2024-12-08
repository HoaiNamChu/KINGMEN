<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    const PATH_VIEW = 'client.blog.';

    public function index(){
        $posts = Post::where('is_active', '=', 1)->with('user')->orderBy('created_at', 'DESC')->get();
        return view(self::PATH_VIEW.__FUNCTION__, compact('posts'));
    }
}
