<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Tag;

class TagsController extends Controller
{
    public function show($tag)
    {
        $tagModel = Tag::whereName($tag)->firstOrFail();

        return view('front.products.index', [
            'title' => trans('e.title', ['title' => unSpace($tag)]),
            'description' => trans('e.search-description', ['term' => unSpace($tag)]),
            'products' => $tagModel->products()->paginate(30),
        ]);
    }
}
