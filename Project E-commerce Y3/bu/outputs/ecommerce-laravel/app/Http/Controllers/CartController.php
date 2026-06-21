<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        return view('store.cart', ['cart' => $this->cart()]);
    }

    public function store(Request $request, Product $product)
    {
        abort_unless($product->is_active && $product->stock > 0, 404);

        $data = $request->validate([
            'quantity' => ['required', 'integer', 'min:1', 'max:' . $product->stock],
        ]);

        $cart = session('cart', []);
        $quantity = ($cart[$product->id]['quantity'] ?? 0) + $data['quantity'];

        $cart[$product->id] = [
            'product_id' => $product->id,
            'name' => $product->name,
            'slug' => $product->slug,
            'price' => (float) $product->price,
            'quantity' => min($quantity, $product->stock),
            'image_url' => $product->image_url,
        ];

        session(['cart' => $cart]);

        return redirect()->route('cart.index')->with('success', 'Product added to cart.');
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'quantity' => ['required', 'integer', 'min:1', 'max:' . max(1, $product->stock)],
        ]);

        $cart = session('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] = $data['quantity'];
            session(['cart' => $cart]);
        }

        return back()->with('success', 'Cart updated.');
    }

    public function destroy(Product $product)
    {
        $cart = session('cart', []);
        unset($cart[$product->id]);
        session(['cart' => $cart]);

        return back()->with('success', 'Product removed.');
    }

    private function cart(): array
    {
        $items = collect(session('cart', []))->map(function ($item) {
            $item['line_total'] = $item['price'] * $item['quantity'];

            return $item;
        });

        return [
            'items' => $items,
            'subtotal' => $items->sum('line_total'),
            'shipping' => $items->isEmpty() ? 0 : 8,
            'total' => $items->sum('line_total') + ($items->isEmpty() ? 0 : 8),
        ];
    }
}
