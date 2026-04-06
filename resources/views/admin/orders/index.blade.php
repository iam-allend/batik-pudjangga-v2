@extends('layouts.admin')

@section('title', 'Orders')
@section('page-title', 'Orders Management')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <div>
            <i class="fas fa-shopping-cart me-2"></i>All Orders
        </div>
        <div id="batchActions" style="display: none;">
            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#batchUpdateModal">
                <i class="fas fa-edit me-1"></i>Update Selected (<span id="selectedCount">0</span>)
            </button>
            <button type="button" class="btn btn-sm btn-secondary" onclick="clearSelection()">
                <i class="fas fa-times me-1"></i>Clear
            </button>
        </div>
    </div>
    <div class="card-body">
        <!-- Statistics Cards -->
        @if(isset($statistics))
        <div class="row mb-4">
            <div class="col-md-2">
                <div class="card bg-primary text-white">
                    <div class="card-body p-3">
                        <h6 class="mb-0">Total Orders</h6>
                        <h3 class="mb-0">{{ $statistics['total_orders'] }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="card bg-warning text-white">
                    <div class="card-body p-3">
                        <h6 class="mb-0">Pending Payment</h6>
                        <h3 class="mb-0">{{ $statistics['pending_payment'] }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="card bg-info text-white">
                    <div class="card-body p-3">
                        <h6 class="mb-0">Processing</h6>
                        <h3 class="mb-0">{{ $statistics['processing'] }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="card bg-primary text-white">
                    <div class="card-body p-3">
                        <h6 class="mb-0">Shipped</h6>
                        <h3 class="mb-0">{{ $statistics['shipped'] }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="card bg-success text-white">
                    <div class="card-body p-3">
                        <h6 class="mb-0">Completed</h6>
                        <h3 class="mb-0">{{ $statistics['completed'] }}</h3>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Filters -->
        <div class="row mb-3">
            <div class="col-md-4">
                <form action="{{ route('admin.orders.index') }}" method="GET">
                    <div class="input-group">
                        <input type="text" class="form-control" name="search" 
                               placeholder="Search order code, customer..." value="{{ request('search') }}">
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
            </div>
            <div class="col-md-3">
                <form action="{{ route('admin.orders.index') }}" method="GET" id="statusFilter">
                    <select class="form-select" name="status" onchange="this.form.submit()">
                        <option value="">All Status</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>Processing</option>
                        <option value="shipped" {{ request('status') == 'shipped' ? 'selected' : '' }}>Shipped</option>
                        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </form>
            </div>
            <div class="col-md-3">
                <form action="{{ route('admin.orders.index') }}" method="GET" id="paymentFilter">
                    <select class="form-select" name="payment_status" onchange="this.form.submit()">
                        <option value="">All Payment Status</option>
                        <option value="pending" {{ request('payment_status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="verified" {{ request('payment_status') == 'verified' ? 'selected' : '' }}>Verified</option>
                        <option value="rejected" {{ request('payment_status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                    </select>
                </form>
            </div>
        </div>
        
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th width="30">
                            <input type="checkbox" id="selectAll" onclick="toggleSelectAll(this)">
                        </th>
                        <th>Order Code</th>
                        <th>Customer</th>
                        <th>Items</th>
                        <th>Total</th>
                        <th>Payment</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                        <tr>
                            <td>
                                <input type="checkbox" class="order-checkbox" value="{{ $order->id }}" 
                                       onchange="updateSelectedCount()">
                            </td>
                            <td><strong>{{ $order->order_code }}</strong></td>
                            <td>
                                {{ $order->user->name }}
                                <br>
                                <small class="text-muted">{{ $order->user->email }}</small>
                            </td>
                            <td>{{ $order->items->count() }} item(s)</td>
                            <td><strong>Rp {{ number_format($order->total_amount, 0, ',', '.') }}</strong></td>
                            <td>
                                <span class="badge bg-{{ $order->payment_method == 'transfer' ? 'primary' : 'success' }}">
                                    {{ strtoupper($order->payment_method) }}
                                </span>
                                <br>
                                @php
                                    $paymentColors = [
                                        'pending' => 'warning',
                                        'verified' => 'success',
                                        'rejected' => 'danger'
                                    ];
                                @endphp
                                <small class="badge bg-{{ $paymentColors[$order->payment_status] ?? 'secondary' }}">
                                    {{ ucfirst($order->payment_status) }}
                                </small>
                            </td>
                            <td>
                                @php
                                    $statusColors = [
                                        'pending' => 'warning',
                                        'processing' => 'info',
                                        'shipped' => 'primary',
                                        'completed' => 'success',
                                        'cancelled' => 'danger'
                                    ];
                                @endphp
                                <span class="badge bg-{{ $statusColors[$order->status] ?? 'secondary' }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                            <td>
                                {{ $order->created_at->format('d M Y') }}
                                <br>
                                <small class="text-muted">{{ $order->created_at->format('H:i') }}</small>
                            </td>
                            <td>
                                <a href="{{ route('admin.orders.show', $order) }}" 
                                   class="btn btn-sm btn-primary">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center py-4">
                                <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                <p class="text-muted">No orders found</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-3">
            {{ $orders->links() }}
        </div>
    </div>
</div>

<!-- Batch Update Modal -->
<div class="modal fade" id="batchUpdateModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.orders.batch-update-status') }}" method="POST" id="batchUpdateForm">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Update Selected Orders</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        You are about to update <strong><span id="modalSelectedCount">0</span> order(s)</strong>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">New Status <span class="text-danger">*</span></label>
                        <select class="form-select" name="status" required>
                            <option value="">Select Status</option>
                            <option value="pending">Pending</option>
                            <option value="processing">Processing</option>
                            <option value="shipped">Shipped</option>
                            <option value="completed">Completed</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                        <small class="text-muted">
                            Note: Orders with unverified payments cannot be set to "Processing"
                        </small>
                    </div>

                    <input type="hidden" name="order_ids" id="selectedOrderIds">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-check me-1"></i>Update Orders
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
// Select All Checkbox
function toggleSelectAll(checkbox) {
    const checkboxes = document.querySelectorAll('.order-checkbox');
    checkboxes.forEach(cb => {
        cb.checked = checkbox.checked;
    });
    updateSelectedCount();
}

// Update Selected Count
function updateSelectedCount() {
    const checkboxes = document.querySelectorAll('.order-checkbox:checked');
    const count = checkboxes.length;
    
    document.getElementById('selectedCount').textContent = count;
    document.getElementById('modalSelectedCount').textContent = count;
    
    // Show/hide batch actions
    const batchActions = document.getElementById('batchActions');
    if (count > 0) {
        batchActions.style.display = 'block';
    } else {
        batchActions.style.display = 'none';
        document.getElementById('selectAll').checked = false;
    }
    
    // Update hidden input with selected IDs
    const selectedIds = Array.from(checkboxes).map(cb => cb.value);
    document.getElementById('selectedOrderIds').value = JSON.stringify(selectedIds);
}

// Clear Selection
function clearSelection() {
    document.querySelectorAll('.order-checkbox').forEach(cb => {
        cb.checked = false;
    });
    document.getElementById('selectAll').checked = false;
    updateSelectedCount();
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    updateSelectedCount();
});
</script>
@endpush
@endsection