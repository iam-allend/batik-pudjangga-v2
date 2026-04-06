@extends('layouts.app')

@section('title', 'Payment - Order #' . $order->order_code)

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <!-- Order Summary Card -->
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-receipt me-2"></i>Order Summary</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-6">
                            <p class="mb-1 text-muted">Order Code:</p>
                            <h6>{{ $order->order_code }}</h6>
                        </div>
                        <div class="col-6 text-end">
                            <p class="mb-1 text-muted">Order Date:</p>
                            <h6>{{ $order->created_at->format('d M Y, H:i') }}</h6>
                        </div>
                    </div>
                    
                    <hr>
                    
                    <div class="d-flex justify-content-between mb-2">
                        <span>Subtotal:</span>
                        <strong>Rp {{ number_format($order->subtotal, 0, ',', '.') }}</strong>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Shipping Cost:</span>
                        <strong>Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</strong>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between mb-0">
                        <strong class="h5">Total Payment:</strong>
                        <strong class="h4 text-primary">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</strong>
                    </div>
                </div>
            </div>

            <!-- Bank Account Information -->
            <div class="card mb-4">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0"><i class="fas fa-university me-2"></i>Bank Account Information</h5>
                </div>
                <div class="card-body">
                    <p class="mb-3">Please transfer to one of these bank accounts:</p>
                    
                    <!-- Bank 1 -->
                    <div class="bank-card mb-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-1"><i class="fas fa-building me-2"></i>Bank BCA</h6>
                                <p class="mb-1">Account Number: <strong>2380361399</strong></p>
                                <p class="mb-0 text-muted">Account Name: ARRY AJIE SUHARDIMAN</p>
                            </div>
                            <button class="btn btn-sm btn-outline-primary" onclick="copyText('2380361399')">
                                <i class="fas fa-copy"></i> Copy
                            </button>
                        </div>
                    </div>
                    
                    <!-- Bank 2 -->
                    <div class="bank-card mb-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-1"><i class="fas fa-building me-2"></i>Bank Jateng</h6>
                                <p class="mb-1">Account Number: <strong>2007225752</strong></p>
                                <p class="mb-0 text-muted">Account Name: SRI SUNINGSIH</p>
                            </div>
                            <button class="btn btn-sm btn-outline-primary" onclick="copyText('2007225752')">
                                <i class="fas fa-copy"></i> Copy
                            </button>
                        </div>
                    </div>
                    
                    <div class="alert alert-warning mt-3">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <strong>Important:</strong> Please transfer the exact amount and upload your payment proof below.
                    </div>
                </div>
            </div>

            <!-- Upload Payment Proof -->
            <div class="card mb-4">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0"><i class="fas fa-upload me-2"></i>Upload Payment Proof</h5>
                </div>
                <div class="card-body">
                    @if($order->payment_proof)
                        <!-- Already uploaded -->
                        <div class="alert alert-info">
                            <i class="fas fa-check-circle me-2"></i>
                            Payment proof has been uploaded on {{ $order->payment_proof_uploaded_at->format('d M Y, H:i') }}
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Current Payment Proof:</label>
                            <div class="text-center">
                                <img src="{{ asset('storage/' . $order->payment_proof) }}" 
                                     alt="Payment Proof" 
                                     class="img-fluid rounded border"
                                     style="max-height: 400px;">
                            </div>
                        </div>
                        
                        <p class="text-muted">Status: 
                            <span class="badge bg-{{ $order->payment_status_color }}">
                                {{ $order->payment_status_text }}
                            </span>
                        </p>
                        
                        <hr>
                        <p class="mb-3"><strong>Want to re-upload?</strong> You can upload a new payment proof below:</p>
                    @endif
                    
                    <form action="{{ route('checkout.payment.confirm', $order) }}" method="POST" enctype="multipart/form-data" id="paymentForm">
                        @csrf
                        
                        <div class="mb-3">
                            <label class="form-label">Upload Payment Proof <span class="text-danger">*</span></label>
                            <input type="file" class="form-control @error('payment_proof') is-invalid @enderror" 
                                   name="payment_proof" id="payment_proof" accept="image/*" required>
                            <small class="text-muted">Accepted formats: JPG, PNG, JPEG (Max: 2MB)</small>
                            @error('payment_proof')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Image Preview -->
                        <div class="mb-3" id="preview-container" style="display: none;">
                            <label class="form-label">Preview:</label>
                            <div class="text-center">
                                <img id="preview-image" src="" alt="Preview" 
                                     class="img-fluid rounded border" 
                                     style="max-height: 300px;">
                            </div>
                        </div>
                        
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" id="confirm" required>
                            <label class="form-check-label" for="confirm">
                                I confirm that I have transferred the exact amount to the bank account above.
                            </label>
                        </div>
                        
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-success btn-lg">
                                <i class="fas fa-check me-2"></i>Submit Payment Proof
                            </button>
                            <a href="{{ route('orders.show', $order) }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Back to Order Detail
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Instructions -->
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0"><i class="fas fa-info-circle me-2"></i>Instructions</h6>
                </div>
                <div class="card-body">
                    <ol>
                        <li>Transfer the <strong>exact amount</strong> to one of the bank accounts above</li>
                        <li>Take a screenshot or photo of your transfer receipt</li>
                        <li>Upload the payment proof using the form above</li>
                        <li>Wait for admin verification (usually within 24 hours)</li>
                        <li>You will receive a notification once your payment is verified</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.bank-card {
    border: 2px solid #e0e0e0;
    padding: 15px;
    border-radius: 10px;
    transition: all 0.3s;
}

.bank-card:hover {
    border-color: var(--primary-color);
    background: var(--light-color);
}
</style>

<script>
// Copy bank account number
function copyText(text) {
    navigator.clipboard.writeText(text).then(function() {
        alert('Account number copied: ' + text);
    });
}

// Image preview
document.getElementById('payment_proof').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('preview-image').src = e.target.result;
            document.getElementById('preview-container').style.display = 'block';
        }
        reader.readAsDataURL(file);
    }
});

// Form validation
document.getElementById('paymentForm').addEventListener('submit', function(e) {
    const fileInput = document.getElementById('payment_proof');
    const file = fileInput.files[0];
    
    if (file) {
        // Check file size (2MB = 2048KB = 2097152 bytes)
        if (file.size > 2097152) {
            e.preventDefault();
            alert('File size too large! Maximum size is 2MB.');
            return false;
        }
        
        // Check file type
        const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
        if (!allowedTypes.includes(file.type)) {
            e.preventDefault();
            alert('Invalid file type! Only JPG, PNG, and JPEG are allowed.');
            return false;
        }
    }
});
</script>
@endsection