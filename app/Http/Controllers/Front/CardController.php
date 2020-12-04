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
    public function pay(Request $request)
    {
        if (auth()->check() == false) {
            return redirect()->route('auth.otp.show')
                ->with('success', trans('e.sign-in-before-pay'));
        }

        $request->validate([
            'products' => ['required'],
        ]);

        $order = new Order();
        $order->user_id = auth()->id();
        $order->price = 0;
        $items = [];

        foreach (json_decode($request->input('products'), true) as $p) {
            $product = Product::findOrFail($p['id']);
            $attribute = ProductAttribute::findOrFail($p['attributes']['id']);

            if ($attribute->product_id != $product->id) {
                abort(403);
            }

            $item = new OrderItem();
            $item->product_id = $product->id;
            $item->product_attribute_id = $attribute->id;
            $item->count = abs($p['count']);
            $item->product_price = $product->price;
            $item->total_price = $item->count * $item->product_price;

            if ($attribute->count < $item->count) {
                if ($attribute->count > 0) {
                    $item->count = $attribute->count;
                } else {
                    continue;
                }
            }

            $attribute->count -= $item->count;
            $attribute->save();

            $items[] = $item;
            $order->price += $item->total_price;
        }

        if (empty($items)) {
            abort(403);
        }

        $order->save();
        $order->items()->saveMany($items);

        return redirect()->route('account.orders.show', [$order]);
    }
}
