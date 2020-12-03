<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;

class HomeController extends Controller
{
    public function show()
    {
        return view('front.products.index', [
            'title' => trans('e.home-title'),
            'headline' => trans('e.home-headline'),
            'description' => trans('e.home-description'),
            'products' => Product::inRandomOrder()->paginate(30),
        ]);
    }
}
