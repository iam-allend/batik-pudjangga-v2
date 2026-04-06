@extends('layouts.admin')

@section('title', 'Order Details')
@section('page-title', 'Order Details - ' . $order->order_code)

@section('content')
<div class="row">
    <!-- Order Information -->
    <div class="col-md-8">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="fas fa-info-circle me-2"></i>Order Information</span>
                <span class="badge bg-{{ ['pending' => 'warning', 'processing' => 'info', 'shipped' => 'primary', 'completed' => 'success', 'cancelled' => 'danger'][$order->status] ?? 'secondary' }}">
                    {{ ucfirst($order->status) }}
                </span>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <p><strong>Order Code:</strong> {{ $order->order_code }}</p>
                        <p><strong>Order Date:</strong> {{ $order->created_at->format('d M Y H:i') }}</p>
                        <p><strong>Payment Method:</strong> 
                            <span class="badge bg-{{ $order->payment_method == 'transfer' ? 'primary' : 'success' }}">
                                {{ strtoupper($order->payment_method) }}
                            </span>
                        </p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Customer:</strong> {{ $order->user->name }}</p>
                        <p><strong>Email:</strong> {{ $order->user->email }}</p>
                        <p><strong>Phone:</strong> {{ $order->phone }}</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Order Items -->
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-box me-2"></i>Order Items
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Size</th>
                                <th>Price</th>
                                <th>Qty</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->items as $item)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset('storage/products/' . $item->product->image) }}" 
                                                 alt="{{ $item->product->name }}"
                                                 style="width: 50px; height: 50px; object-fit: cover; border-radius: 5px; margin-right: 10px;">
                                            <div>
                                                <strong>{{ $item->product->name }}</strong>
                                                @if($item->notes)
                                                    <br><small class="text-muted">Note: {{ $item->notes }}</small>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $item->size ?? '-' }}</td>
                                    <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td><strong>Rp {{ number_format($item->subtotal, 0, ',', '.') }}</strong></td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="4" class="text-end"><strong>Subtotal:</strong></td>
                                <td><strong>Rp {{ number_format($order->subtotal, 0, ',', '.') }}</strong></td>
                            </tr>
                            <tr>
                                <td colspan="4" class="text-end">
                                    <strong>Shipping ({{ ucfirst($order->shipping_method) }}):</strong>
                                </td>
                                <td><strong>Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</strong></td>
                            </tr>
                            <tr class="table-active">
                                <td colspan="4" class="text-end"><strong>TOTAL:</strong></td>
                                <td><strong class="text-primary">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</strong></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        
        <!-- Payment Proof Section (ENHANCED) -->
        @if($order->payment_method == 'transfer' && $order->payment_proof)
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="fas fa-receipt me-2"></i>Payment Proof</span>
                @if($order->payment_status == 'pending')
                    <span class="badge bg-warning">Waiting Verification</span>
                @elseif($order->payment_status == 'verified')
                    <span class="badge bg-success">
                        <i class="fas fa-check-circle me-1"></i>Verified
                    </span>
                @elseif($order->payment_status == 'rejected')
                    <span class="badge bg-danger">
                        <i class="fas fa-times-circle me-1"></i>Rejected
                    </span>
                @endif
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <!-- Payment Proof Image -->
                        <div class="mb-3">
                            <label class="form-label"><strong>Uploaded Proof:</strong></label>
                            <div class="border rounded p-2 text-center" style="background-color: #f8f9fa;">
                                <img src="{{ asset('storage/' . $order->payment_proof) }}" 
                                    alt="Payment Proof" 
                                    class="img-fluid rounded"
                                    style="max-height: 400px; cursor: pointer;"
                                    data-bs-toggle="modal" 
                                    data-bs-target="#paymentProofModal">
                                <p class="mt-2 mb-0 text-muted small">
                                    <i class="fas fa-search-plus me-1"></i>Click to view full size
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <!-- Payment Details -->
                        <div class="mb-3">
                            <label class="form-label"><strong>Payment Details:</strong></label>
                            <div class="border rounded p-3">
                                @if($order->sender_name)
                                    <p class="mb-2">
                                        <i class="fas fa-user text-primary me-2"></i>
                                        <strong>Sender Name:</strong> {{ $order->sender_name }}
                                    </p>
                                @endif
                                
                                @if($order->sender_bank)
                                    <p class="mb-2">
                                        <i class="fas fa-university text-primary me-2"></i>
                                        <strong>From Bank:</strong> {{ $order->sender_bank }}
                                    </p>
                                @endif
                                
                                <p class="mb-2">
                                    <i class="fas fa-money-bill-wave text-primary me-2"></i>
                                    <strong>Amount:</strong> 
                                    <span class="text-success fw-bold">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                                </p>
                                
                                <p class="mb-0">
                                    <i class="fas fa-calendar text-primary me-2"></i>
                                    <strong>Upload Date:</strong> {{ $order->payment_proof_uploaded_at ? $order->payment_proof_uploaded_at->format('d M Y H:i') : '-' }}
                                </p>
                            </div>
                        </div>

                        <!-- VERIFICATION ACTIONS (ENHANCED - MOVED HERE) -->
                        @if($order->payment_status == 'pending')
                        <div class="alert alert-warning mb-3">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            <strong>Action Required:</strong> Please verify this payment proof.
                        </div>
                        
                        <!-- Quick Verify Buttons -->
                        <div class="d-grid gap-2">
                            <form action="{{ route('admin.orders.verify-payment', $order) }}" method="POST" class="verify-form">
                                @csrf
                                <input type="hidden" name="action" value="verify">
                                <button type="submit" class="btn btn-success btn-lg w-100">
                                    <i class="fas fa-check-circle me-2"></i>Verify & Approve Payment
                                </button>
                            </form>
                            
                            <button type="button" class="btn btn-danger btn-lg w-100" data-bs-toggle="modal" data-bs-target="#rejectModal">
                                <i class="fas fa-times-circle me-2"></i>Reject Payment
                            </button>
                        </div>
                        @endif

                        @if($order->payment_status == 'verified')
                        <div class="alert alert-success mb-0">
                            <i class="fas fa-check-circle me-2"></i>
                            <strong>Payment Verified</strong><br>
                            <small>
                                Verified at: {{ $order->payment_verified_at->format('d M Y H:i') }}<br>
                                By: {{ $order->verifiedBy->name ?? 'Admin' }}
                            </small>
                        </div>
                        @endif

                        @if($order->payment_status == 'rejected' && $order->payment_rejection_note)
                        <div class="alert alert-danger mb-0">
                            <i class="fas fa-times-circle me-2"></i>
                            <strong>Payment Rejected</strong><br>
                            <small class="d-block mt-2">
                                <strong>Reason:</strong><br>
                                {{ $order->payment_rejection_note }}
                            </small>
                            <small class="d-block mt-2">
                                Rejected at: {{ $order->payment_rejected_at->format('d M Y H:i') }}<br>
                                By: {{ $order->rejectedBy->name ?? 'Admin' }}
                            </small>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Alternative: Show alert if payment method is transfer but no proof uploaded yet -->
        @if($order->payment_method == 'transfer' && !$order->payment_proof)
        <div class="card mb-4 border-info">
            <div class="card-body">
                <div class="alert alert-info mb-0">
                    <i class="fas fa-info-circle me-2"></i>
                    <strong>Waiting for Payment Proof</strong><br>
                    Customer has not uploaded payment proof yet. Payment method: Bank Transfer
                </div>
            </div>
        </div>
        @endif
        
        <!-- Shipping Information -->
        <div class="card">
            <div class="card-header">
                <i class="fas fa-truck me-2"></i>Shipping Information
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Recipient:</strong> {{ $order->recipient_name }}</p>
                        <p><strong>Phone:</strong> {{ $order->phone }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Shipping Method:</strong> {{ ucfirst($order->shipping_method) }}</p>
                        @if($order->resi_code)
                            <p><strong>Resi Code:</strong> <span class="badge bg-success">{{ $order->resi_code }}</span></p>
                        @endif
                    </div>
                </div>
                <p class="mb-0"><strong>Address:</strong><br>
                    {{ $order->address }}<br>
                    {{ $order->city }}, {{ $order->province }} {{ $order->postal_code }}
                </p>
            </div>
        </div>
    </div>
    
    <!-- Actions & Status -->
    <div class="col-md-4">
        <!-- Payment Verification (NEW) -->
        @if($order->payment_method == 'transfer' && $order->payment_status == 'pending')
        <div class="card mb-4 border-warning">
            <div class="card-header bg-warning text-dark">
                <i class="fas fa-check-circle me-2"></i>Verify Payment
            </div>
            <div class="card-body">
                <p class="text-muted small mb-3">Review the payment proof and verify the transaction.</p>
                
                <form action="{{ route('admin.orders.verify-payment', $order) }}" method="POST">
                    @csrf
                    <input type="hidden" name="action" value="verify">
                    <button type="submit" class="btn btn-success w-100 mb-2">
                        <i class="fas fa-check me-1"></i>Verify & Approve Payment
                    </button>
                </form>
                
                <button type="button" class="btn btn-danger w-100" data-bs-toggle="modal" data-bs-target="#rejectModal">
                    <i class="fas fa-times me-1"></i>Reject Payment
                </button>
            </div>
        </div>
        @endif

        <!-- Update Status -->
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-edit me-2"></i>Update Order Status
            </div>
            <div class="card-body">
                <form action="{{ route('admin.orders.update-status', $order) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select class="form-select" name="status" required>
                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                            <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                            <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-check me-1"></i>Update Status
                    </button>
                </form>
            </div>
        </div>
        
        <!-- Add Resi Code -->
        @if($order->status == 'processing' || $order->status == 'shipped')
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-barcode me-2"></i>Tracking Number
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.orders.add-resi', $order) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Resi Code</label>
                            <input type="text" class="form-control" name="resi_code" 
                                   value="{{ $order->resi_code }}" required>
                        </div>
                        <button type="submit" class="btn btn-success w-100">
                            <i class="fas fa-save me-1"></i>{{ $order->resi_code ? 'Update' : 'Add' }} Resi
                        </button>
                    </form>
                </div>
            </div>
        @endif
        
        <!-- Timeline -->
        <div class="card">
            <div class="card-header">
                <i class="fas fa-clock me-2"></i>Order Timeline
            </div>
            <div class="card-body">
                <div class="timeline">
                    <div class="timeline-item {{ $order->status == 'pending' ? 'active' : '' }}">
                        <i class="fas fa-circle"></i>
                        <span>Order Placed</span>
                        <small>{{ $order->created_at->format('d M Y H:i') }}</small>
                    </div>
                    <div class="timeline-item {{ $order->status == 'processing' ? 'active' : '' }}">
                        <i class="fas fa-circle"></i>
                        <span>Processing</span>
                    </div>
                    <div class="timeline-item {{ $order->status == 'shipped' ? 'active' : '' }}">
                        <i class="fas fa-circle"></i>
                        <span>Shipped</span>
                    </div>
                    <div class="timeline-item {{ $order->status == 'completed' ? 'active' : '' }}">
                        <i class="fas fa-circle"></i>
                        <span>Completed</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Payment Proof Modal (Full Size View) -->
<div class="modal fade" id="paymentProofModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-receipt me-2"></i>Payment Proof - {{ $order->order_code }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
                <img src="{{ asset('storage/' . $order->payment_proof) }}" 
                     alt="Payment Proof" 
                     class="img-fluid"
                     style="max-height: 70vh;">
                <div class="mt-3">
                    <a href="{{ asset('storage/' . $order->payment_proof) }}" 
                       download 
                       class="btn btn-primary">
                        <i class="fas fa-download me-1"></i>Download Proof
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Reject Payment Modal -->
<div class="modal fade" id="rejectModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">
                    <i class="fas fa-times-circle me-2"></i>Reject Payment
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.orders.verify-payment', $order) }}" method="POST">
                @csrf
                <input type="hidden" name="action" value="reject">
                <div class="modal-body">
                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        Are you sure you want to reject this payment?
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Rejection Reason <span class="text-danger">*</span></label>
                        <textarea class="form-control" 
                                  name="rejection_note" 
                                  rows="4" 
                                  placeholder="Please provide a reason for rejection..."
                                  required></textarea>
                        <small class="text-muted">This note will be sent to the customer.</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-times me-1"></i>Reject Payment
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.timeline {
    position: relative;
    padding-left: 30px;
}

.timeline::before {
    content: '';
    position: absolute;
    left: 8px;
    top: 0;
    bottom: 0;
    width: 2px;
    background: #ddd;
}

.timeline-item {
    position: relative;
    margin-bottom: 20px;
}

.timeline-item i {
    position: absolute;
    left: -26px;
    top: 2px;
    font-size: 10px;
    color: #ddd;
}

.timeline-item.active i {
    color: var(--primary-color);
}

.timeline-item span {
    display: block;
    font-weight: 600;
    color: #666;
}

.timeline-item.active span {
    color: var(--primary-color);
}

.timeline-item small {
    display: block;
    color: #999;
    font-size: 0.8rem;
}

/* Payment Proof Styling */
.payment-proof-container {
    position: relative;
    overflow: hidden;
    border-radius: 8px;
}

.payment-proof-container img {
    transition: transform 0.3s ease;
}

.payment-proof-container:hover img {
    transform: scale(1.05);
}
</style>
@endpush

@push('scripts')
<script>
// Add confirmation for payment verification
document.querySelectorAll('form[action*="verify-payment"]').forEach(form => {
    form.addEventListener('submit', function(e) {
        const action = this.querySelector('input[name="action"]').value;
        if (action === 'verify') {
            if (!confirm('Are you sure you want to verify and approve this payment?')) {
                e.preventDefault();
            }
        }
    });
});

// Show success message if payment was verified
@if(session('success'))
    setTimeout(() => {
        const alert = document.createElement('div');
        alert.className = 'alert alert-success alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x mt-3';
        alert.style.zIndex = '9999';
        alert.innerHTML = `
            <i class="fas fa-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;
        document.body.appendChild(alert);
        
        setTimeout(() => alert.remove(), 5000);
    }, 100);
@endif
</script>
@endpush