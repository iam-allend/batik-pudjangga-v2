<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Address;
use App\Models\ShippingZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;


class CheckoutController extends Controller
{
    public function index()
    {
        try {
            // Get selected items from session
            $selectedItems = session('checkout_items', []);

            if (empty($selectedItems)) {
                return redirect()->route('cart.index')
                    ->with('error', 'No items selected for checkout!');
            }

            // Get cart items
            $cartItems = Cart::whereIn('id', $selectedItems)
                ->where('user_id', Auth::id())
                ->with('product')
                ->get();

            if ($cartItems->isEmpty()) {
                session()->forget('checkout_items');
                return redirect()->route('cart.index')
                    ->with('error', 'Cart items not found!');
            }

            // Check stock availability
            foreach ($cartItems as $item) {
                if ($item->product->stock < $item->quantity) {
                    return redirect()->route('cart.index')
                        ->with('error', "Product {$item->product->name} is out of stock!");
                }
            }

            // Add subtotal to each item
            foreach ($cartItems as $item) {
                $item->subtotal = $item->price * $item->quantity;
            }

            // Calculate subtotal
            $subtotal = $cartItems->sum(function($item) {
                return $item->price * $item->quantity;
            });

            // Get user addresses
            $addresses = Auth::user()->addresses()->get();
            
            // Get default address
            $defaultAddress = $addresses->where('is_default', true)->first();
            if (!$defaultAddress) {
                $defaultAddress = $addresses->first();
            }

            // CRITICAL FIX: Get provinces with DISTINCT and ORDER BY
            $provinces = ShippingZone::select('province', 'cost_regular', 'cost_express')
                ->distinct('province')
                ->orderBy('province')
                ->get();

            // Debug log (optional - comment out in production)
            Log::info('Checkout Data:', [
                'cart_items' => $cartItems->count(),
                'subtotal' => $subtotal,
                'addresses' => $addresses->count(),
                'provinces' => $provinces->count()
            ]);

            return view('checkout.index', compact(
                'cartItems', 
                'subtotal', 
                'addresses', 
                'defaultAddress',
                'provinces',
                'selectedItems'
            ));

        } catch (\Exception $e) {
            Log::error('Checkout Error: ' . $e->getMessage());
            return redirect()->route('cart.index')
                ->with('error', 'Something went wrong! Please try again.');
        }
    }

    public function process(Request $request)
    {
        try {
            // Validate
            $validated = $request->validate([
                'recipient_name' => ['required', 'string', 'max:255'],
                'phone' => ['required', 'string', 'max:20'],
                'address' => ['required', 'string'],
                'city' => ['required', 'string', 'max:100'],
                'province' => ['required', 'string', 'max:100'],
                'postal_code' => ['required', 'string', 'max:10'],
                'shipping_method' => ['required', 'in:regular,express'],
                'payment_method' => ['required', 'in:transfer,cod'],
            ]);

            // Get selected cart items
            $selectedItems = session('checkout_items', []);
            if (empty($selectedItems)) {
                return redirect()->route('cart.index')
                    ->with('error', 'No items selected for checkout!');
            }

            $cartItems = Cart::whereIn('id', $selectedItems)
                ->where('user_id', Auth::id())
                ->with('product')
                ->get();

            if ($cartItems->isEmpty()) {
                return redirect()->route('cart.index')
                    ->with('error', 'Cart items not found!');
            }

            // Calculate subtotal
            $subtotal = $cartItems->sum(function($item) {
                return $item->price * $item->quantity;
            });

            // Get shipping cost
            $zone = ShippingZone::where('province', $validated['province'])->first();
            
            if (!$zone) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Shipping zone not found for selected province!');
            }

            $shippingCost = $validated['shipping_method'] === 'express' 
                ? $zone->cost_express 
                : $zone->cost_regular;

            $totalAmount = $subtotal + $shippingCost;

            DB::beginTransaction();
            try {
                // Create order
                $order = Order::create([
                    'order_code' => $this->generateOrderCode(),
                    'user_id' => Auth::id(),
                    'recipient_name' => $validated['recipient_name'],
                    'address' => $validated['address'],
                    'city' => $validated['city'],
                    'province' => $validated['province'],
                    'postal_code' => $validated['postal_code'],
                    'phone' => $validated['phone'],
                    'subtotal' => $subtotal,
                    'shipping_cost' => $shippingCost,
                    'total_amount' => $totalAmount,
                    'payment_method' => $validated['payment_method'],
                    'shipping_method' => ucfirst($validated['shipping_method']) . ' Shipping',
                    'status' => 'pending',
                    'design_status' => 'pending',
                ]);

                // Create order items & reduce stock
                foreach ($cartItems as $item) {
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $item->product_id,
                        'quantity' => $item->quantity,
                        'price' => $item->price,
                        'size' => $item->size,
                        'notes' => $item->notes,
                    ]);

                    // Reduce stock
                    $item->product->decrement('stock', $item->quantity);

                    // Remove from cart
                    $item->delete();
                }

                DB::commit();

                // Clear session
                session()->forget('checkout_items');

                return redirect()->route('checkout.payment', $order)
                    ->with('success', 'Order placed successfully!');

            } catch (\Exception $e) {
                DB::rollBack();
                Log::error('Order Creation Error: ' . $e->getMessage());
                throw $e;
            }

        } catch (\Exception $e) {
            Log::error('Checkout Process Error: ' . $e->getMessage());
            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to process order. Please try again.');
        }
    }

    public function payment(Order $order)
    {
        // Authorize
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        return view('checkout.payment', compact('order'));
    }

    private function generateOrderCode()
    {
        do {
            $code = 'BP-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -6));
        } while (Order::where('order_code', $code)->exists());

        return $code;
    }

    public function confirmPayment(Request $request, Order $order)
    {
        // Pastikan order milik user
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        // Pastikan metode transfer
        if ($order->payment_method !== 'transfer') {
            return redirect()->route('orders.show', $order)
                ->with('info', 'This order does not require payment proof.');
        }

        // Validasi file
        $request->validate([
            'payment_proof' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        try {
            // Hapus bukti lama (jika ada)
            if ($order->payment_proof) {
                Storage::disk('public')->delete($order->payment_proof);
            }

            // Upload bukti pembayaran
            $file = $request->file('payment_proof');
            $filename = 'payment_' . $order->order_code . '_' . time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('payment_proofs', $filename, 'public');

            // Update order
            $order->update([
                'payment_proof' => $path,
                'payment_proof_uploaded_at' => now(),
                'payment_status' => 'pending_verification',
                'status' => 'processing',
            ]);

            return redirect()->route('checkout.success', $order);

        } catch (\Exception $e) {
            Log::error('Payment Proof Upload Error: ' . $e->getMessage());
            return back()->with('error', 'Failed to upload payment proof.');
        }
    }

    public function success(Order $order)
    {
        return view('checkout.success', compact('order'));
    }

}