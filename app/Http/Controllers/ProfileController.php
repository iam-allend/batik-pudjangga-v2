<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user()->load(['addresses', 'orders', 'wishlists']);
        
        // Get order statistics
        $totalOrders = $user->orders()->count();
        $pendingOrders = $user->orders()->where('status', 'pending')->count();
        $completedOrders = $user->orders()->where('status', 'completed')->count();
        
        // Get wishlist count
        $wishlistCount = $user->wishlists()->count();
        
        // Get address count
        $addressCount = $user->addresses()->count();
        
        // Get recent orders (last 5)
        $recentOrders = $user->orders()
            ->with(['items.product'])
            ->latest()
            ->take(5)
            ->get();

        return view('profile.index', compact(
            'user', 
            'totalOrders', 
            'pendingOrders', 
            'completedOrders',
            'wishlistCount',
            'addressCount',
            'recentOrders'
        ));
    }

    public function edit()
    {
        $user = auth()->user();
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'city' => 'nullable|string|max:100',
            'postal_code' => 'nullable|string|max:10',
            'current_password' => 'nullable|required_with:new_password',
            'new_password' => 'nullable|min:8|confirmed',
        ]);

        $data = $request->only('name', 'email', 'phone', 'address', 'city', 'postal_code');

        // Update password if provided
        if ($request->filled('new_password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Current password is incorrect.']);
            }
            $data['password'] = Hash::make($request->new_password);
        }

        $user->update($data);

        return back()->with('success', 'Profile updated successfully!');
    }

    public function uploadImage(Request $request)
    {
        $request->validate([
            'profile_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user = auth()->user();

        // Delete old image if exists
        if ($user->profile_image) {
            Storage::disk('public')->delete($user->profile_image);
        }

        // Upload image
        $image = $request->file('profile_image');
        $filename = 'profile_' . $user->id . '_' . time() . '.' . $image->getClientOriginalExtension();
        
        // Store in public/profiles directory
        $path = $image->storeAs('profiles', $filename, 'public');

        $user->update([
            'profile_image' => $path,
        ]);

        return back()->with('success', 'Profile image updated successfully!');
    }
}