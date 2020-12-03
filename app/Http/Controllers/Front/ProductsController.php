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
            'title' => trans('e.products-index'),
            'description' => trans('e.home-description'),
            'products' => Product::paginate(30),
        ]);
    }

    public function show(Product $product)
    {
        $records = [];
        $attributes = [];
        foreach ($product->attributes as $attribute) {
            $item = $attribute->record;
            $item['count'] = $attribute->count;
            $records[] = $item;

            foreach ($attribute->record as $name => $value) {
                isset($attributes[$name]) || $attributes[$name] = [];
                in_array($value, $attributes[$name]) || $attributes[$name][] = $value;
            }
        }

        return view('front.products.show', [
            'product' => $product,
            'records' => $records,
            'attributes' => $attributes,
        ]);
    }
}
