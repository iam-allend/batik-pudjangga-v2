@extends('layouts.admin')

@section('title', 'Edit User')
@section('page-title', 'Edit User - ' . $user->name)

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <i class="fas fa-edit me-2"></i>Edit User Information
                </div>
                <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-secondary">
                    <i class="fas fa-arrow-left me-1"></i>Back to List
                </a>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.users.update', $user) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <!-- Left Column -->
                        <div class="col-md-6">
                            <h5 class="mb-3">Basic Information</h5>
                            
                            <div class="mb-3">
                                <label class="form-label">Full Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                       name="name" value="{{ old('name', $user->name) }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Email Address <span class="text-danger">*</span></label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                       name="email" value="{{ old('email', $user->email) }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Phone Number</label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror" 
                                       name="phone" value="{{ old('phone', $user->phone) }}" 
                                       placeholder="e.g. 081234567890">
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">New Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                       name="password" placeholder="Leave blank to keep current password">
                                <small class="text-muted">Minimum 8 characters. Leave blank if you don't want to change password.</small>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Confirm New Password</label>
                                <input type="password" class="form-control" 
                                       name="password_confirmation" placeholder="Confirm new password">
                            </div>
                        </div>
                        
                        <!-- Right Column -->
                        <div class="col-md-6">
                            <h5 class="mb-3">Address Information</h5>
                            
                            <div class="mb-3">
                                <label class="form-label">Address</label>
                                <textarea class="form-control @error('address') is-invalid @enderror" 
                                          name="address" rows="3" 
                                          placeholder="Full street address">{{ old('address', $user->address) }}</textarea>
                                @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">City</label>
                                <input type="text" class="form-control @error('city') is-invalid @enderror" 
                                       name="city" value="{{ old('city', $user->city) }}" 
                                       placeholder="e.g. Jakarta">
                                @error('city')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Postal Code</label>
                                <input type="text" class="form-control @error('postal_code') is-invalid @enderror" 
                                       name="postal_code" value="{{ old('postal_code', $user->postal_code) }}" 
                                       placeholder="e.g. 12345">
                                @error('postal_code')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Profile Image</label>
                                @if($user->profile_image)
                                    <div class="mb-2">
                                        <img src="{{ asset('storage/profiles/' . $user->profile_image) }}" 
                                             alt="Current Profile" 
                                             class="rounded"
                                             style="width: 100px; height: 100px; object-fit: cover;">
                                    </div>
                                @endif
                                <input type="file" class="form-control @error('profile_image') is-invalid @enderror" 
                                       name="profile_image" accept="image/*">
                                <small class="text-muted">Upload new image (JPG, PNG, max 2MB)</small>
                                @error('profile_image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <!-- Admin Privileges -->
                    <div class="row">
                        <div class="col-12">
                            <h5 class="mb-3">Account Settings</h5>
                            
                            <div class="mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="is_admin" name="is_admin" 
                                           value="1" {{ old('is_admin', $user->is_admin) ? 'checked' : '' }}
                                           {{ $user->id == auth()->id() ? 'disabled' : '' }}>
                                    <label class="form-check-label" for="is_admin">
                                        <strong>Administrator Privileges</strong>
                                    </label>
                                </div>
                                <small class="text-muted">Grant this user full access to the admin panel</small>
                                @if($user->id == auth()->id())
                                    <div class="alert alert-info mt-2 mb-0">
                                        <i class="fas fa-info-circle me-2"></i>
                                        You cannot change your own admin status
                                    </div>
                                @endif
                            </div>
                            
                            @if($user->id != auth()->id())
                            <div class="alert alert-warning">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                <strong>Warning:</strong> Granting admin privileges will give this user full access to manage products, orders, and other users.
                            </div>
                            @endif
                        </div>
                    </div>

                    <hr class="my-4">

                    <!-- Action Buttons -->
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i>Update User
                        </button>
                        <a href="{{ route('admin.users.show', $user) }}" class="btn btn-info">
                            <i class="fas fa-eye me-1"></i>View Details
                        </a>
                        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times me-1"></i>Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Account Information -->
        <div class="card mt-3">
            <div class="card-header">
                <i class="fas fa-info-circle me-2"></i>Account Information
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <p class="mb-2"><strong>User ID:</strong> {{ $user->id }}</p>
                        <p class="mb-2"><strong>Status:</strong> 
                            <span class="badge bg-{{ $user->is_admin ? 'danger' : 'primary' }}">
                                {{ $user->is_admin ? 'Administrator' : 'Customer' }}
                            </span>
                        </p>
                    </div>
                    <div class="col-md-4">
                        <p class="mb-2"><strong>Total Orders:</strong> {{ $user->orders->count() }}</p>
                        <p class="mb-2"><strong>Total Spent:</strong> Rp {{ number_format($user->orders->sum('total_amount'), 0, ',', '.') }}</p>
                    </div>
                    <div class="col-md-4">
                        <p class="mb-2"><strong>Joined:</strong> {{ $user->created_at->format('d M Y, H:i') }}</p>
                        <p class="mb-2"><strong>Last Updated:</strong> {{ $user->updated_at->format('d M Y, H:i') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection