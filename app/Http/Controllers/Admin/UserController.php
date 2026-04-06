<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::with('orders')->latest();

        // Search
        if ($request->has('search') && $request->search) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%')
                  ->orWhere('phone', 'like', '%' . $request->search . '%');
            });
        }

        $users = $query->paginate(20);

        return view('admin.users.index', compact('users'));
    }

    public function show(User $user)
    {
        $user->load(['orders', 'addresses']);
        return view('admin.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        $user->load('orders'); // Load orders for statistics
        return view('admin.users.edit', compact('user'));
    }

public function update(Request $request, User $user)
    {
        // Validasi dasar tanpa password dulu
        $rules = [
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'phone' => ['nullable', 'string', 'max:20'],
            'address' => ['nullable', 'string', 'max:500'],
            'city' => ['nullable', 'string', 'max:100'],
            'postal_code' => ['nullable', 'string', 'max:10'],
            'is_admin' => ['boolean'],
            'profile_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ];

        // TAMBAHKAN validasi password HANYA jika field password diisi
        if ($request->filled('password')) {
            $rules['password'] = ['required', 'min:8', 'confirmed'];
        }

        $validated = $request->validate($rules);

        // Update basic info (HAPUS province)
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->phone = $validated['phone'] ?? $user->phone;
        $user->address = $validated['address'] ?? $user->address;
        $user->city = $validated['city'] ?? $user->city;
        $user->postal_code = $validated['postal_code'] ?? $user->postal_code;

        // Update password HANYA jika diisi
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // Update admin status (but not for self)
        if ($user->id != auth()->id()) {
            $user->is_admin = $request->has('is_admin') ? 1 : 0;
        }

        // Handle profile image upload
        if ($request->hasFile('profile_image')) {
            // Delete old image if exists
            if ($user->profile_image) {
                Storage::delete('public/profiles/' . $user->profile_image);
            }

            // Store new image
            $imageName = time() . '_' . $request->file('profile_image')->getClientOriginalName();
            $request->file('profile_image')->storeAs('public/profiles', $imageName);
            $user->profile_image = $imageName;
        }

        $user->save();

        return redirect()->route('admin.users.index')
            ->with('success', 'User updated successfully!');
    }
    
    
    public function destroy(User $user)
    {
        // Prevent deleting own account
        if ($user->id === auth()->id()) {
            return back()->with('error', 'You cannot delete your own account!');
        }

        // Delete profile image if exists
        if ($user->profile_image) {
            Storage::delete('public/profiles/' . $user->profile_image);
        }

        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'User deleted successfully!');
    }
}