@extends('layouts.app')

@section('title', $product->name . ' - Batik Pudjangga')

@section('content')
<div class="container py-5">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ route('shop.index') }}">Belanja</a></li>
            <li class="breadcrumb-item"><a href="{{ route('shop.' . $product->category) }}">{{ ucfirst($product->category) }}</a></li>
            <li class="breadcrumb-item active">{{ $product->name }}</li>
        </ol>
    </nav>

    <div class="row">
        <!-- Product Images -->
        <div class="col-lg-6 mb-4">
            <div class="product-images">
                <!-- Main Image -->
                <div class="main-image mb-3">
                    <img src="{{ asset('storage/products/' . $product->image) }}" alt="{{ $product->name }}"
                        id="mainProductImage" class="img-fluid rounded">

                    <!-- Product Badges - Fixed Layout -->
                    <div class="product-badges">
                        @if($product->is_sale)
                        <span class="product-badge badge-sale" style="top: 110px;">
                                <i class="fas fa-tag"></i> SALE {{ round((($product->price - $product->sale_price) / $product->price) * 100) }}% OFF
                            </span>
                        @endif

                        @if($product->is_new)
                            <span class="product-badge badge-new" style="top: 55px;">
                                <i class="fas fa-star"></i> NEW
                            </span>
                        @endif
                        
                        @if($product->is_preorder)
                            <span class="product-badge badge-preorder">
                                <i class="fas fa-clock"></i> PRE-ORDER
                            </span>
                        @endif
                    </div>
                </div>

                <!-- Thumbnail Images -->
                @if($product->images->count() > 0)
                <div class="thumbnails">
                    <div class="row g-2">
                        <div class="col-3">
                            <img src="{{ asset('storage/products/' . $product->image) }}" alt="Thumbnail"
                                class="img-thumbnail thumbnail-item active" onclick="changeMainImage(this.src)">
                        </div>
                        @foreach($product->images as $image)
                        <div class="col-3">
                            <img src="{{ asset('storage/' . $image->image_path) }}" alt="Thumbnail"
                                class="img-thumbnail thumbnail-item" onclick="changeMainImage(this.src)">
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>

        <!-- Product Info -->
        <div class="col-lg-6">
            <div class="product-info">
                <h1 class="product-title">{{ $product->name }}</h1>

                <!-- Category Badge -->
                <p class="text-muted mb-3">
                    <i class="fas fa-tag me-2"></i>
                    <a href="{{ route('shop.' . $product->category) }}" class="text-decoration-none">
                        {{ ucfirst($product->category) }}
                    </a>
                    @if($product->subcategory)
                    / {{ $product->subcategory }}
                    @endif
                </p>

                <!-- Price -->
                <div class="product-price mb-4">
                    @if($product->is_sale && $product->sale_price)
                    <h2 class="text-primary mb-0">
                        Rp {{ number_format($product->sale_price, 0, ',', '.') }}
                    </h2>
                    <p class="text-muted mb-0">
                        <del>Rp {{ number_format($product->price, 0, ',', '.') }}</del>
                        <span class="badge bg-danger ms-2">
                            Save Rp {{ number_format($product->price - $product->sale_price, 0, ',', '.') }}
                        </span>
                    </p>
                    @else
                    <h2 class="text-primary mb-0">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </h2>
                    @endif
                </div>

                <!-- Stock & Pre-order Status -->
                <div class="mb-3">
                    @if($product->is_preorder)
                        <div class="alert alert-warning d-flex align-items-center">
                            <i class="fas fa-clock me-2"></i>
                            <div>
                                <strong>Pre-order Item</strong>
                                <p class="mb-0 small">Production time: {{ $product->preorder_duration }} days after payment confirmed</p>
                            </div>
                        </div>
                    @else
                        @if($product->stock > 0)
                        <span class="badge bg-success">
                            <i class="fas fa-check-circle"></i> Ready Stock ({{ $product->stock }} available)
                        </span>
                        @else
                        <span class="badge bg-danger">
                            <i class="fas fa-times-circle"></i> Out of Stock
                        </span>
                        @endif
                    @endif
                </div>

                <!-- Description -->
                @if($product->description)
                <div class="product-description mb-4">
                    <h5>Description</h5>
                    <div class="description-wrapper">
                        <p class="text-muted description-text" id="descriptionText">{!! nl2br(e($product->description)) !!}</p>
                        <button class="btn btn-link p-0 text-primary" id="toggleDescription" style="display: none;">
                            <span class="show-more">Show More <i class="fas fa-chevron-down"></i></span>
                            <span class="show-less" style="display: none;">Show Less <i class="fas fa-chevron-up"></i></span>
                        </button>
                    </div>
                </div>
                @endif

                <!-- Add to Cart Form -->
                <form action="{{ route('cart.add') }}" method="POST" id="addToCartForm">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">

                    <!-- Size Selection -->
                    @php
                        $availableSizes = json_decode($product->available_sizes, true) ?? [];
                    @endphp
                    
                    @if(!empty($availableSizes))
                    <div class="mb-4">
                        <label class="form-label"><strong>Pilih Size</strong></label>
                        <div class="size-options d-flex flex-wrap gap-2">
                            @foreach($availableSizes as $size)
                            <div class="size-option">
                                <input type="radio" class="btn-check" name="size" id="size_{{ $size }}"
                                    value="{{ $size }}" {{ $loop->first ? 'checked' : '' }} required>
                                <label class="btn btn-outline-primary" for="size_{{ $size }}">
                                    {{ $size }}
                                </label>
                            </div>
                            @endforeach
                        </div>
                        <small class="text-muted">Pilih Ukuran Anda</small>
                    </div>
                    @endif

                    <!-- Quantity -->
                    <div class="mb-3">
                        <label class="form-label"><strong>Jumlah</strong></label>
                        <div class="input-group quantity-input" style="max-width: 150px;">
                            <button class="btn btn-outline-secondary" type="button" onclick="decreaseQty()">
                                <i class="fas fa-minus"></i>
                            </button>
                            <input type="number" name="quantity" id="quantity" class="form-control text-center"
                                value="1" min="1" max="{{ $product->is_preorder ? 999 : $product->stock }}" required>
                            <button class="btn btn-outline-secondary" type="button" onclick="increaseQty()">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                        @if(!$product->is_preorder)
                            <small class="text-muted">Maximum: {{ $product->stock }} items</small>
                        @endif
                    </div>

                    <!-- Special Notes -->
                    <div class="mb-4">
                        <label class="form-label">Special Notes (Optional)</label>
                        <textarea name="notes" class="form-control" rows="3"
                            placeholder="Add custom request or notes..."></textarea>
                        <small class="text-muted">Example: color preference, special measurements, etc.</small>
                    </div>

                    <!-- Action Buttons -->
                    @auth
                    @if($product->stock > 0 || $product->is_preorder)
                    <button type="submit" class="btn btn-primary btn-lg w-100 mb-2">
                        <i class="fas fa-shopping-cart me-2"></i>
                        {{ $product->is_preorder ? 'Pre-order Now' : 'Add to Cart' }}
                    </button>
                    @else
                    <button type="button" class="btn btn-secondary btn-lg w-100 mb-2" disabled>
                        Out of Stock
                    </button>
                    @endif
                    @else
                    <a href="{{ route('login') }}" class="btn btn-primary btn-lg w-100 mb-2">
                        <i class="fas fa-sign-in-alt me-2"></i>Login to Order
                    </a>
                    @endauth
                </form>

                <!-- Wishlist Button -->
                @auth
                <form action="{{ route('wishlist.toggle') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <button type="submit" class="btn btn-outline-danger btn-lg w-100">
                        <i class="fas fa-heart {{ $isInWishlist ? 'text-danger' : '' }}"></i>
                        {{ $isInWishlist ? 'Remove from Wishlist' : 'Add to Wishlist' }}
                    </button>
                </form>
                @endauth

                <!-- Product Meta -->
                <div class="product-meta mt-4">
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <strong>SKU:</strong> BP-{{ str_pad($product->id, 5, '0', STR_PAD_LEFT) }}
                        </li>
                        <li class="mb-2">
                            <strong>Kategori:</strong>
                            <a href="{{ route('shop.' . $product->category) }}">{{ ucfirst($product->category) }}</a>
                        </li>
                        @if($product->subcategory)
                        <li class="mb-2">
                            <strong>Subcategory:</strong> {{ $product->subcategory }}
                        </li>
                        @endif
                        @if(!empty($availableSizes))
                        <li class="mb-2">
                            <strong>Available Sizes:</strong> {{ implode(', ', $availableSizes) }}
                        </li>
                        @endif
                        <li class="mb-2">
                            <strong>Status:</strong>
                            @if($product->is_preorder)
                                <span class="badge bg-warning">Pre-order</span>
                            @else
                                <span class="badge bg-success">Ready Stock</span>
                            @endif
                        </li>
                    </ul>
                </div>

                <!-- Share Buttons -->
                <div class="share-product mt-4">
                    <p class="mb-2"><strong>Share this product:</strong></p>
                    <div class="d-flex gap-2">
                        </a>
                        <a href="https://wa.me/6285930433717" {{ $product->name }} {{ url()->current() }}" target="_blank"
                            class="btn btn-sm btn-outline-success">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                        <button type="button" class="btn btn-sm btn-outline-secondary" onclick="copyLink()">
                            <i class="fas fa-link"></i> Copy Link
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Related Products -->
    @if($relatedProducts->count() > 0)
    <div class="related-products mt-5">
        <h3 class="mb-4">You May Also Like</h3>
        <div class="row">
            @foreach($relatedProducts as $related)
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                @include('components.product-card', ['product' => $related])
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>

<style>
    .product-images .main-image {
        position: relative;
        overflow: hidden;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
    }

    .product-images .main-image img {
        width: 100%;
        height: auto;
        max-height: 600px;
        object-fit: contain;
        background: #f8f9fa;
    }

    /* Product Badges Container */
    .product-badges {
        position: absolute;
        top: 20px;
        left: 20px;
        right: auto;
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        gap: 8px;
        z-index: 10;
        width: auto;
        max-width: 200px;
    }

    /* Individual Badge Styling */
    .product-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 10px 16px;
        border-radius: 8px;
        font-weight: 700;
        font-size: 0.85rem;
        letter-spacing: 0.5px;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.2);
        animation: slideInLeft 0.5s ease;
        transition: all 0.3s ease;
    }

    .product-badge:hover {
        transform: translateX(5px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    }

    .product-badge i {
        font-size: 0.9rem;
    }

    /* Sale Badge - Red */
    .badge-sale {
        background: linear-gradient(135deg, #dc3545, #c82333);
        color: white;
    }

    /* New Badge - Green */
    .badge-new {
        background: linear-gradient(135deg, #28a745, #218838);
        color: white;
    }

    /* Pre-order Badge - Yellow/Orange */
    .badge-preorder {
        background: linear-gradient(135deg, #ffc107, #ff9800);
        color: #000;
    }

    /* Slide In Animation */
    @keyframes slideInLeft {
        from {
            opacity: 0;
            transform: translateX(-20px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    /* Thumbnail Styling */
    .thumbnail-item {
        cursor: pointer;
        transition: all 0.3s;
        border: 2px solid #dee2e6;
        height: 100px;
        object-fit: cover;
        border-radius: 8px;
    }

    .thumbnail-item:hover {
        border-color: #8B4513;
        transform: scale(1.05);
        box-shadow: 0 3px 10px rgba(139, 69, 19, 0.3);
    }

    .thumbnail-item.active {
        border-color: #8B4513;
        box-shadow: 0 3px 10px rgba(139, 69, 19, 0.5);
    }

    /* Description Styling */
    .description-wrapper {
        position: relative;
    }

    .description-text {
        transition: max-height 0.3s ease;
        overflow: hidden;
    }

    .description-text.collapsed {
        max-height: 5.4em; /* 3 lines (1.8 line-height * 3) */
        position: relative;
    }

    .description-text.collapsed::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 1.8em;
        background: linear-gradient(to bottom, transparent, white);
    }

    .description-text.expanded {
        max-height: none;
    }

    #toggleDescription {
        font-weight: 600;
        text-decoration: none;
        margin-top: 0.5rem;
        display: inline-block;
    }

    #toggleDescription:hover {
        text-decoration: underline;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .product-badges {
            top: 15px;
            left: 15px;
            gap: 8px;
        }
        
        .product-badge {
            padding: 8px 12px;
            font-size: 0.75rem;
        }
        
        .product-badge i {
            font-size: 0.8rem;
        }
    }

    @media (max-width: 576px) {
        .product-badges {
            top: 10px;
            left: 10px;
            gap: 6px;
        }
        
        .product-badge {
            padding: 6px 10px;
            font-size: 0.7rem;
        }
    }

    .thumbnail-item:hover,
    .thumbnail-item.active {
        border-color: #0d6efd;
        transform: scale(1.05);
    }

    .product-title {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 1rem;
    }

    .product-price h2 {
        font-size: 2.5rem;
        font-weight: 700;
    }

    .size-option .btn {
        min-width: 60px;
        font-weight: 600;
    }

    .size-option .btn-check:checked + .btn {
        background: #0d6efd;
        color: white;
    }

    .quantity-input input {
        border-left: none;
        border-right: none;
    }

    .quantity-input button {
        width: 40px;
    }

    .product-meta a {
        color: #0d6efd;
        text-decoration: none;
    }

    .product-meta a:hover {
        text-decoration: underline;
    }
</style>

<script>
function changeMainImage(src) {
    document.getElementById('mainProductImage').src = src;
    
    document.querySelectorAll('.thumbnail-item').forEach(thumb => {
        thumb.classList.remove('active');
    });
    event.target.classList.add('active');
}

function increaseQty() {
    const input = document.getElementById('quantity');
    const max = parseInt(input.getAttribute('max'));
    const current = parseInt(input.value);
    
    if (current < max) {
        input.value = current + 1;
    }
}

function decreaseQty() {
    const input = document.getElementById('quantity');
    const min = parseInt(input.getAttribute('min'));
    const current = parseInt(input.value);
    
    if (current > min) {
        input.value = current - 1;
    }
}

function copyLink() {
    navigator.clipboard.writeText(window.location.href).then(function() {
        alert('Product link copied to clipboard!');
    });
}

// Description Toggle
document.addEventListener('DOMContentLoaded', function() {
    const descText = document.getElementById('descriptionText');
    const toggleBtn = document.getElementById('toggleDescription');
    
    if (descText) {
        // Check if text exceeds 3 lines
        const lineHeight = parseFloat(window.getComputedStyle(descText).lineHeight);
        const maxHeight = lineHeight * 3;
        
        if (descText.scrollHeight > maxHeight) {
            descText.classList.add('collapsed');
            toggleBtn.style.display = 'inline-block';
            
            toggleBtn.addEventListener('click', function() {
                const isCollapsed = descText.classList.contains('collapsed');
                
                if (isCollapsed) {
                    descText.classList.remove('collapsed');
                    descText.classList.add('expanded');
                    toggleBtn.querySelector('.show-more').style.display = 'none';
                    toggleBtn.querySelector('.show-less').style.display = 'inline';
                } else {
                    descText.classList.add('collapsed');
                    descText.classList.remove('expanded');
                    toggleBtn.querySelector('.show-more').style.display = 'inline';
                    toggleBtn.querySelector('.show-less').style.display = 'none';
                }
            });
        }
    }
});
</script>
@endsection