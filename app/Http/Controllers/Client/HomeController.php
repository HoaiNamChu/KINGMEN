<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    const PATH_VIEW = 'client.home.';

    public function index(){
        return view(self::PATH_VIEW.__FUNCTION__);
    }
}