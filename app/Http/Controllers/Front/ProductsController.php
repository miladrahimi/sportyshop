<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductsController extends Controller
{
    public function index()
    {
        return view('front.products.index', [
            'products' => Product::paginate(30),
        ]);
    }

    public function show(Product $product)
    {
        return view('front.products.show', [
            'product' => $product,
        ]);
    }
}
