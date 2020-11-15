<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Tag;

class ProductsController extends Controller
{
    public function index()
    {
        return view('front.products.index', [
            'products' => Product::paginate(30),
        ]);
    }

    public function indexByTag($tag)
    {
        $tagModel = Tag::whereName($tag)->firstOrFail();

        return view('front.products.index', [
            'tag' => $tagModel,
            'products' => $tagModel->products()->paginate(30),
        ]);
    }

    public function show(Product $product)
    {
        return view('front.products.show', [
            'product' => $product,
        ]);
    }
}
