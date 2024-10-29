<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    const PATH_VIEW = 'client.blog.';

    public function index(){
        return view(self::PATH_VIEW.__FUNCTION__);
    }
}
