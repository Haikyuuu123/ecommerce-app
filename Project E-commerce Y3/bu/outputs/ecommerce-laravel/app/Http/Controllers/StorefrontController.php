<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class StorefrontController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::with('category')
            ->where('is_active', true)
            ->where('is_featured', true)
            ->latest()
            ->take(6)
            ->get();

        $categories = Category::where('is_active', true)->withCount('products')->get();

        return view('store.home', compact('featuredProducts', 'categories'));
    }

    public function products(Request $request)
    {
        $categories = Category::where('is_active', true)->orderBy('name')->get();
        $products = Product::with('category')
            ->where('is_active', true)
            ->when($request->filled('category'), function ($query) use ($request) {
                $query->whereHas('category', fn ($category) => $category->where('slug', $request->category));
            })
            ->when($request->filled('search'), function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->search . '%');
            })
            ->latest()
            ->paginate(9)
            ->withQueryString();

        return view('store.products', compact('products', 'categories'));
    }

    public function show(Product $product)
    {
        abort_unless($product->is_active, 404);

        $product->load('category');

        return view('store.product-show', compact('product'));
    }
}
