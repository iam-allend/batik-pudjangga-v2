<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Subscriber;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // FIX: Optimized query dengan select yang jelas
        $newProducts = Product::query()
            ->where('is_new', true) // Langsung where, jangan pakai scope dulu
            ->where(function($q) {
                $q->where('is_preorder', true)
                  ->orWhere('stock', '>', 0);
            })
            ->latest()
            ->limit(8) // Gunakan limit bukan take
            ->get();

        // FIX: Query sale products yang lebih simple
        $saleProducts = Product::query()
            ->where('is_sale', true)
            ->whereNotNull('sale_price')
            ->where('sale_price', '>', 0)
            ->where(function($q) {
                $q->where('is_preorder', true)
                  ->orWhere('stock', '>', 0);
            })
            ->latest()
            ->limit(8)
            ->get();

        $featuredProducts = Product::query()
            ->where(function($q) {
                $q->where('is_preorder', true)
                  ->orWhere('stock', '>', 0);
            })
            ->latest()
            ->limit(12)
            ->get();

        return view('home.index', compact('newProducts', 'saleProducts', 'featuredProducts'));
    }

    public function shippingInfo()
    {
        return view('home.shipping-info');
    }

    public function returnPolicy()
    {
        return view('home.return-policy');
    }

    public function about()
    {
        return view('about.index');
    }


    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:subscribers,email',
        ]);

        Subscriber::create([
            'email' => $request->email,
            'is_active' => true,
        ]);

        return back()->with('success', 'Thank you for subscribing to our newsletter!');
    }
}