<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ProductAttribute;
use Illuminate\Http\Request;

class CardController extends Controller
{
    public function index()
    {
        return view('front.card.index');
    }

    public function pay(Request $request)
    {
        $request->validate([
            'products' => ['required'],
        ]);

        $order = new Order();
        $order->user_id = auth()->id();
        $order->price = 0;
        $items = [];

        foreach (json_decode($request->input('products'), true) as $p) {
            $product = Product::findOrFail($p['id']);
            $productAttributes = ProductAttribute::whereProductId($product->id)->get();
            foreach ($productAttributes as $pa) {
                if (empty(array_diff($pa->record, $p['attributes']))) {
                    $item = new OrderItem();
                    $item->product_id = $product->id;
                    $item->product_attribute_id = $pa->id;
                    $item->count = abs($p['count']);
                    $item->product_price = $product->price;
                    $item->total_price = $item->count * $item->product_price;

                    $items[] = $item;
                    $order->price += $item->total_price;

                    break;
                }
            }
        }

        $order->save();
        $order->items()->saveMany($items);

        return redirect()->route('account.orders.show', [$order]);
    }
}
