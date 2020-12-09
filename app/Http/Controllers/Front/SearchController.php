<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->input('q');
        $products = Product::whereRaw('MATCH(content) AGAINST(?)', ['q' => $q])
            ->paginate(30);

        return view('front.products.index', [
            'title' => trans('e.search-title', ['term' => $q]),
            'description' => trans('e.search-description', ['term' => $q]),
            'products' => $products,
        ]);
    }
}
