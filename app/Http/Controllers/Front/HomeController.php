<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;

class HomeController extends Controller
{
    public function show()
    {
        return view('front.home.show', [
            'products' => Product::inRandomOrder()->paginate(30),
        ]);
    }
}
