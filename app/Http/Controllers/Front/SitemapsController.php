<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Tag;

class SitemapsController extends Controller
{
    public function index()
    {
        $sitemaps = [];

        $productCount = Product::count('id');
        $productSitemapCount = floor($productCount / 100);
        for ($i = 0; $i <= $productSitemapCount; $i++) {
            $sitemaps[] = route('sitemaps.products', [$i]);
        }

        $tagCount = Tag::count('id');
        $tagSitemapCount = floor($tagCount / 100);
        for ($i = 0; $i <= $tagSitemapCount; $i++) {
            $sitemaps[] = route('sitemaps.tags', [$i]);
        }

        $sitemaps[] = route('sitemaps.statics');

        return response()->view('front.sitemaps.index', [
            'sitemaps' => $sitemaps,
        ])->header('Content-Type', 'text/xml');
    }

    public function statics()
    {
        $items = [
            [
                'loc' => route('home'),
                'lastmod' => date('Y-m-d'),
                'changefreq' => 'daily',
                'images' => [],
            ],
            [
                'loc' => route('products.index'),
                'lastmod' => date('Y-m-d'),
                'changefreq' => 'daily',
                'images' => [],
            ],
            [
                'loc' => route('contact.show'),
                'lastmod' => '2020-12-09',
                'changefreq' => 'monthly',
                'images' => [],
            ],
            [
                'loc' => route('about.show'),
                'lastmod' => '2020-12-09',
                'changefreq' => 'monthly',
                'images' => [
                    [
                        'loc' => fh(asset('img/milad-rahimi.jpg')),
                        'title' => trans('e.milad-rahimi'),
                    ],
                    [
                        'loc' => fh(asset('img/behzad-rahimi.jpg')),
                        'title' => trans('e.behzad-rahimi'),
                    ],
                ],
            ],
        ];

        return response()->view('front.sitemaps.show', [
            'items' => $items,
        ])->header('Content-Type', 'text/xml');
    }

    public function products($page)
    {
        $items = [];

        /** @var Product[] $products */
        $products = Product::take(100)->offset($page * 100)->get();

        foreach ($products as $product) {
            $item = [
                'loc' => route('products.show', [$product]),
                'lastmod' => $product->created_at->format('Y-m-d'),
                'changefreq' => 'weekly',
                'images' => [],
            ];

            foreach ($product->photos() as $photo) {
                $item['images'][] = [
                    'loc' => photoUrl($photo),
                    'title' => $product->title,
                ];
            }

            $items[] = $item;
        }

        return response()->view('front.sitemaps.show', [
            'items' => $items,
        ])->header('Content-Type', 'text/xml');
    }

    public function tags($page)
    {
        $items = [];

        /** @var Tag[] $tags */
        $tags = Tag::take(100)->offset($page * 100)->get();

        foreach ($tags as $tag) {
            $items[] = [
                'loc' => route('tags.show', [$tag->name]),
                'lastmod' => $tag->created_at->format('Y-m-d'),
                'changefreq' => 'daily',
                'images' => [],
            ];
        }

        return response()->view('front.sitemaps.show', [
            'items' => $items,
        ])->header('Content-Type', 'text/xml');
    }
}
