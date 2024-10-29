<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    const PATH_VIEW = 'client.shop.';

    public function index(){
        return view(self::PATH_VIEW.__FUNCTION__);
    }
}
