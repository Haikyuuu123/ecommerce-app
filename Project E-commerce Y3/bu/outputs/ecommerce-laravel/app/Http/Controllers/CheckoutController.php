<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function create()
    {
        $cart = $this->cart();

        if ($cart['items']->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        return view('store.checkout', compact('cart'));
    }

    public function store(Request $request)
    {
        $cart = $this->cart();

        if ($cart['items']->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $data = $request->validate([
            'customer_name' => ['required', 'string', 'max:120'],
            'customer_email' => ['required', 'email', 'max:160'],
            'customer_phone' => ['required', 'string', 'max:30'],
            'shipping_address' => ['required', 'string', 'max:500'],
            'notes' => ['nullable', 'string', 'max:500'],
        ]);

        $order = DB::transaction(function () use ($cart, $data) {
            $order = Order::create([
                ...$data,
                'subtotal' => $cart['subtotal'],
                'shipping_fee' => $cart['shipping'],
                'total' => $cart['total'],
            ]);

            foreach ($cart['items'] as $item) {
                $product = Product::lockForUpdate()->findOrFail($item['product_id']);

                if ($product->stock < $item['quantity']) {
                    abort(422, "{$product->name} does not have enough stock.");
                }

                $product->decrement('stock', $item['quantity']);

                $order->items()->create([
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'price' => $product->price,
                    'quantity' => $item['quantity'],
                    'line_total' => $item['line_total'],
                ]);
            }

            return $order;
        });

        session()->forget('cart');

        return redirect()->route('checkout.success', $order)->with('success', 'Order placed successfully.');
    }

    public function success(Order $order)
    {
        $order->load('items');

        return view('store.success', compact('order'));
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
