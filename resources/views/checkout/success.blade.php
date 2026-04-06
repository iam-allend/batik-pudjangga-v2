@extends('layouts.app')

@section('title', 'Order Success')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-6 text-center">
            <!-- Success Icon -->
            <div class="success-icon mb-4">
                <i class="fas fa-check-circle"></i>
            </div>
            
            <h2 class="mb-3">Order Placed Successfully!</h2>
            <p class="text-muted mb-4">Thank you for your order. Your order code is:</p>
            
            <div class="order-code-box mb-4">
                <h3 class="text-primary mb-0">{{ $order->order_code }}</h3>
            </div>
            
            @if($order->payment_method === 'transfer')
                @if($order->payment_proof)
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle me-2"></i>
                        <strong>Payment Proof Uploaded!</strong>
                        <p class="mb-0 mt-2">We have received your payment proof and will verify it within 24 hours.</p>
                    </div>
                @else
                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <strong>Action Required:</strong>
                        <p class="mb-0 mt-2">Please upload your payment proof to complete the order.</p>
                    </div>
                @endif
            @else
                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i>
                    <strong>Cash on Delivery</strong>
                    <p class="mb-0 mt-2">Please prepare cash payment when you receive the product.</p>
                </div>
            @endif
            
            <!-- Order Details -->
            <div class="card mb-4 text-start">
                <div class="card-body">
                    <h5 class="card-title mb-3">Order Summary</h5>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Subtotal:</span>
                        <strong>Rp {{ number_format($order->subtotal, 0, ',', '.') }}</strong>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Shipping Cost:</span>
                        <strong>Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</strong>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <strong>Total:</strong>
                        <strong class="text-primary">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</strong>
                    </div>
                </div>
            </div>
            
            <!-- Action Buttons -->
            <div class="d-grid gap-2">
                @if($order->payment_method === 'transfer' && !$order->payment_proof)
                    <a href="{{ route('checkout.payment', $order) }}" class="btn btn-primary btn-lg">
                        <i class="fas fa-upload me-2"></i>Upload Payment Proof
                    </a>
                @endif
                
                <a href="{{ route('orders.show', $order) }}" class="btn btn-outline-primary">
                    <i class="fas fa-eye me-2"></i>View Order Details
                </a>
                
                <a href="{{ route('shop.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-shopping-bag me-2"></i>Continue Shopping
                </a>
            </div>
            
            <!-- Next Steps -->
            <div class="card mt-4">
                <div class="card-body text-start">
                    <h6 class="card-title">What's Next?</h6>
                    <ul class="mb-0">
                        @if($order->payment_method === 'transfer')
                            @if($order->payment_proof)
                                <li>We will verify your payment proof within 24 hours</li>
                                <li>Once verified, your order will be processed</li>
                            @else
                                <li>Upload your payment proof</li>
                                <li>Wait for payment verification</li>
                            @endif
                        @else
                            <li>Your order will be processed immediately</li>
                        @endif
                        <li>We will prepare and package your items</li>
                        <li>You will receive a tracking number once shipped</li>
                        <li>Estimated delivery: 3-5 business days</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.success-icon {
    font-size: 100px;
    color: #28a745;
    animation: scaleIn 0.5s ease-in-out;
}

@keyframes scaleIn {
    from {
        transform: scale(0);
        opacity: 0;
    }
    to {
        transform: scale(1);
        opacity: 1;
    }
}

.order-code-box {
    background: var(--light-color);
    padding: 20px;
    border-radius: 10px;
    border: 2px dashed var(--primary-color);
}
</style>
@endsection