@extends('layouts.admin')

@section('title', 'Users')
@section('page-title', 'Users Management')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <div>
            <i class="fas fa-users me-2"></i>All Users
        </div>
        <span class="badge bg-primary">Total: {{ $users->total() }}</span>
    </div>
    <div class="card-body">
        <!-- Search -->
        <div class="row mb-3">
            <div class="col-md-4">
                <form action="{{ route('admin.users.index') }}" method="GET">
                    <div class="input-group">
                        <input type="text" class="form-control" name="search" 
                               placeholder="Search users..." value="{{ request('search') }}">
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                        @if(request('search'))
                            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times"></i>
                            </a>
                        @endif
                    </div>
                </form>
            </div>
        </div>
        
        @if($users->count() > 0)
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Orders</th>
                        <th>Joined</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    @if($user->profile_image)
                                        <img src="{{ asset('storage/profiles/' . $user->profile_image) }}" 
                                             alt="{{ $user->name }}"
                                             class="rounded-circle me-2"
                                             style="width: 35px; height: 35px; object-fit: cover;">
                                    @else
                                        <div class="user-avatar me-2" style="width: 35px; height: 35px; font-size: 0.9rem;">
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        </div>
                                    @endif
                                    <strong>{{ $user->name }}</strong>
                                </div>
                            </td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone ?? '-' }}</td>
                            <td>
                                <span class="badge bg-info">
                                    {{ $user->orders->count() }} orders
                                </span>
                            </td>
                            <td>
                                {{-- FIX: Handle null created_at --}}
                                @if($user->created_at)
                                    {{ $user->created_at->format('d M Y') }}
                                @else
                                    <span class="text-muted">N/A</span>
                                @endif
                            </td>
                            <td>
    <div class="btn-group" role="group">
        <a href="{{ route('admin.users.show', $user) }}" 
           class="btn btn-sm btn-info" title="View Details">
            <i class="fas fa-eye"></i>
        </a>
        
        {{-- TAMBAH TOMBOL EDIT --}}
        <a href="{{ route('admin.users.edit', $user) }}" 
           class="btn btn-sm btn-warning" title="Edit User">
            <i class="fas fa-edit"></i>
        </a>
        
        @if($user->id != auth()->id())
            <form action="{{ route('admin.users.destroy', $user) }}" 
                  method="POST" 
                  class="d-inline"
                  onsubmit="return confirm('Are you sure you want to delete this user? This action cannot be undone.')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                    <i class="fas fa-trash"></i>
                </button>
            </form>
        @else
            <button class="btn btn-sm btn-secondary" disabled title="Cannot delete yourself">
                <i class="fas fa-ban"></i>
            </button>
        @endif
    </div>
</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <div class="mt-3">
            {{ $users->links() }}
        </div>
        @else
        <div class="text-center py-5">
            <i class="fas fa-users fa-4x text-muted mb-3"></i>
            <h5 class="text-muted">No users found</h5>
            @if(request('search'))
                <p>Try adjusting your search criteria</p>
                <a href="{{ route('admin.users.index') }}" class="btn btn-primary">
                    <i class="fas fa-list me-2"></i>View All Users
                </a>
            @endif
        </div>
        @endif
    </div>
</div>

<style>
.user-avatar {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
}
</style>
@endsection