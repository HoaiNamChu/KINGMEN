<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    const PATH_VIEW = 'client.about.';

    public function index(){
        return view(self::PATH_VIEW.__FUNCTION__);
    }
}
