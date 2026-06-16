<?php

namespace App\Http\Controllers;

use App\Models\Product;

class CartController extends Controller
{
    public function index()
    {
        $cart = session('cart', []);
        $total = array_sum(array_map(fn($i) => $i['price'] * $i['quantity'], $cart));
        return view('cart.index', compact('cart', 'total'));
    }

    public function add($id)
    {
        $product = Product::findOrFail($id);
        $cart = session('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                'id'       => $product->id,
                'name'     => $product->name,
                'price'    => $product->price,
                'image'    => $product->image,
                'quantity' => 1,
            ];
        }

        session(['cart' => $cart]);
        return back();
    }

    public function remove($id)
    {
        $cart = session('cart', []);
        unset($cart[$id]);
        session(['cart' => $cart]);
        return back();
    }

    public function clear()
    {
        session()->forget('cart');
        return redirect()->route('cart.index');
    }
}
