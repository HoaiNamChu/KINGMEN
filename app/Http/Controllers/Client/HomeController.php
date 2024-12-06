<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Slide;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    const PATH_VIEW = 'client.home.';

    public function index(){
        $products = Product::query()
            ->where('is_active', '=',1)
            ->where('is_home', '=', 1)
            ->with('categories', 'variants')
            ->get();

        $sliders = Slide::query()->where('is_active', '=', 1)->get();
        return view(self::PATH_VIEW.__FUNCTION__, compact('products', 'sliders'));
    }
}
