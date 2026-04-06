@extends('layouts.app')

@section('title', 'Shop All Products - Batik Pudjangga')

@section('content')
<!-- Page Header -->
<section class="page-header">
    <div class="page-header-overlay"></div>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="page-title" data-aos="fade-up">Shop All Products</h1>
                <nav aria-label="breadcrumb" data-aos="fade-up" data-aos-delay="100">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fas fa-home me-1"></i>Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Shop</li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-4 text-md-end" data-aos="fade-up" data-aos-delay="200">
                <div class="product-count-badge">
                    <i class="fas fa-box me-2"></i>
                    <span class="fw-bold">{{ $products->count() }}</span> of <span class="fw-bold">{{ $products->total() }}</span> products
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Shop Content -->
<section class="shop-section py-5">
    <div class="container">
        <div class="row">
            <!-- Filters Sidebar -->
            <div class="col-lg-3 mb-4">
                <div class="filters-sidebar" data-aos="fade-right">
                    <div class="filters-header">
                        <h5 class="mb-0">
                            <i class="fas fa-filter me-2"></i>Filters
                        </h5>
                    </div>
                    
                    <!-- Category Filter -->
                    <div class="filter-group">
                        <h6 class="filter-title">
                            <i class="fas fa-th-large me-2"></i>Categories
                        </h6>
                        <div class="filter-options">
                            <label class="filter-option">
                                <input type="radio" name="category" value="" 
                                       {{ !request('category') ? 'checked' : '' }}
                                       onchange="applyFilters()">
                                <span class="filter-label">
                                    <i class="fas fa-border-all"></i>
                                    All Products
                                </span>
                                <span class="filter-badge">{{ \App\Models\Product::count() }}</span>
                            </label>
                            <label class="filter-option">
                                <input type="radio" name="category" value="men"
                                       {{ request('category') == 'men' ? 'checked' : '' }}
                                       onchange="applyFilters()">
                                <span class="filter-label">
                                    <i class="fas fa-male"></i>
                                    Men Collection
                                </span>
                                <span class="filter-badge">{{ \App\Models\Product::where('category', 'men')->count() }}</span>
                            </label>
                            <label class="filter-option">
                                <input type="radio" name="category" value="women"
                                       {{ request('category') == 'women' ? 'checked' : '' }}
                                       onchange="applyFilters()">
                                <span class="filter-label">
                                    <i class="fas fa-female"></i>
                                    Women Collection
                                </span>
                                <span class="filter-badge">{{ \App\Models\Product::where('category', 'women')->count() }}</span>
                            </label>
                            <label class="filter-option">
                                <input type="radio" name="category" value="pants"
                                       {{ request('category') == 'pants' ? 'checked' : '' }}
                                       onchange="applyFilters()">
                                <span class="filter-label">
                                    <i class="fas fa-shoe-prints"></i>
                                    Pants
                                </span>
                                <span class="filter-badge">{{ \App\Models\Product::where('category', 'pants')->count() }}</span>
                            </label>
                            <label class="filter-option">
                                <input type="radio" name="category" value="oneset"
                                       {{ request('category') == 'oneset' ? 'checked' : '' }}
                                       onchange="applyFilters()">
                                <span class="filter-label">
                                    <i class="fas fa-tshirt"></i>
                                    One Set
                                </span>
                                <span class="filter-badge">{{ \App\Models\Product::where('category', 'oneset')->count() }}</span>
                            </label>
                        </div>
                    </div>
                    
                    <!-- Sort By -->
                    <div class="filter-group">
                        <h6 class="filter-title">
                            <i class="fas fa-sort-amount-down me-2"></i>Sort By
                        </h6>
                        <select class="form-select custom-select" name="sort" onchange="applyFilters()">
                            <option value="">Default Sorting</option>
                            <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>
                                <i class="fas fa-clock"></i> Newest First
                            </option>
                            <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>
                                <i class="fas fa-sort-alpha-down"></i> Name (A-Z)
                            </option>
                            <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>
                                <i class="fas fa-arrow-down"></i> Price: Low to High
                            </option>
                            <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>
                                <i class="fas fa-arrow-up"></i> Price: High to Low
                            </option>
                        </select>
                    </div>
                    
                    <!-- Price Range Filter -->
                    <div class="filter-group">
                        <h6 class="filter-title">
                            <i class="fas fa-tag me-2"></i>Price Range
                        </h6>
                        <div class="price-range-options">
                            <label class="filter-option">
                                <input type="radio" name="price_range" value="" 
                                       {{ !request('price_range') ? 'checked' : '' }}
                                       onchange="applyFilters()">
                                <span class="filter-label">All Prices</span>
                            </label>
                            <label class="filter-option">
                                <input type="radio" name="price_range" value="0-150000"
                                       {{ request('price_range') == '0-150000' ? 'checked' : '' }}
                                       onchange="applyFilters()">
                                <span class="filter-label">Under Rp 150.000</span>
                            </label>
                            <label class="filter-option">
                                <input type="radio" name="price_range" value="150000-300000"
                                       {{ request('price_range') == '150000-300000' ? 'checked' : '' }}
                                       onchange="applyFilters()">
                                <span class="filter-label">Rp 150.000 - Rp 300.000</span>
                            </label>
                            <label class="filter-option">
                                <input type="radio" name="price_range" value="300000-500000"
                                       {{ request('price_range') == '300000-500000' ? 'checked' : '' }}
                                       onchange="applyFilters()">
                                <span class="filter-label">Rp 300.000 - Rp 500.000</span>
                            </label>
                            <label class="filter-option">
                                <input type="radio" name="price_range" value="500000-999999999"
                                       {{ request('price_range') == '500000-999999999' ? 'checked' : '' }}
                                       onchange="applyFilters()">
                                <span class="filter-label">Above Rp 500.000</span>
                            </label>
                        </div>
                    </div>
                    
                    <!-- Clear Filters -->
                    <a href="{{ route('shop.index') }}" class="btn btn-outline-primary w-100 clear-filters-btn">
                        <i class="fas fa-redo me-2"></i>Clear All Filters
                    </a>
                </div>
            </div>
            
            <!-- Products Grid -->
            <div class="col-lg-9">
                @if($products->count() > 0)
                    <div class="products-grid" data-aos="fade-up">
                        <div class="row g-4">
                            @foreach($products as $product)
                                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                                    @include('components.product-card', ['product' => $product])
                                </div>
                            @endforeach
                        </div>
                    </div>
                    
                    <!-- Pagination -->
                    <div class="mt-5" data-aos="fade-up">
                        {{ $products->links('vendor.pagination.custom') }}
                    </div>
                @else
                    <div class="empty-state" data-aos="zoom-in">
                        <div class="empty-state-icon">
                            <i class="fas fa-search"></i>
                        </div>
                        <h3 class="empty-state-title">No Products Found</h3>
                        <p class="empty-state-text">We couldn't find any products matching your criteria.<br>Try adjusting your filters or browse all products.</p>
                        <a href="{{ route('shop.index') }}" class="btn btn-primary btn-lg">
                            <i class="fas fa-border-all me-2"></i>View All Products
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<style>
:root {
    --primary-color: #8B4513;
    --primary-dark: #6d3410;
    --primary-light: #a0522d;
    --secondary-color: #d4a574;
    --accent-color: #e0c097;
    --light-color: #f8f4ed;
}

/* Page Header */
.page-header {
    position: relative;
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
    padding: 80px 0 60px;
    margin-bottom: 60px;
    overflow: hidden;
}

.page-header-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><rect width="100" height="100" fill="%238B4513"/><path d="M0 0L50 50L0 100M50 0L100 50L50 100M100 0L50 50L100 100" stroke="%23ffffff" stroke-width="0.5" opacity="0.1"/></svg>') repeat;
    opacity: 0.1;
}

.page-title {
    color: white;
    font-size: 3rem;
    font-weight: 700;
    margin-bottom: 15px;
    text-shadow: 0 2px 10px rgba(0,0,0,0.2);
}

.breadcrumb {
    background: rgba(255, 255, 255, 0.1);
    padding: 10px 20px;
    border-radius: 50px;
    display: inline-flex;
    backdrop-filter: blur(10px);
}

.breadcrumb-item a {
    color: rgba(255, 255, 255, 0.8);
    text-decoration: none;
    transition: all 0.3s;
}

.breadcrumb-item a:hover {
    color: white;
}

.breadcrumb-item.active {
    color: white;
}

.breadcrumb-item + .breadcrumb-item::before {
    color: rgba(255, 255, 255, 0.6);
}

.product-count-badge {
    background: rgba(255, 255, 255, 0.15);
    padding: 15px 25px;
    border-radius: 15px;
    color: white;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
}

/* Filters Sidebar */
.filters-sidebar {
    background: white;
    border-radius: 20px;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
    overflow: hidden;
    position: sticky;
    top: 100px;
}

.filters-header {
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
    padding: 25px;
    color: white;
}

.filters-header h5 {
    margin: 0;
    font-weight: 600;
}

.filter-group {
    padding: 25px;
    border-bottom: 1px solid #f0f0f0;
}

.filter-group:last-child {
    border-bottom: none;
}

.filter-title {
    font-size: 1rem;
    font-weight: 600;
    color: #333;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
}

.filter-title i {
    color: var(--primary-color);
}

.filter-options {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.filter-option {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 12px 15px;
    background: #f8f9fa;
    border-radius: 10px;
    cursor: pointer;
    transition: all 0.3s;
    border: 2px solid transparent;
}

.filter-option:hover {
    background: var(--light-color);
    transform: translateX(5px);
}

.filter-option input[type="radio"] {
    display: none;
}

.filter-option input[type="radio"]:checked + .filter-label,
.filter-option:has(input[type="radio"]:checked) {
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
    color: white;
    border-color: var(--primary-color);
}

.filter-option:has(input[type="radio"]:checked) .filter-label {
    color: white;
}

.filter-option:has(input[type="radio"]:checked) .filter-badge {
    background: rgba(255, 255, 255, 0.2);
    color: white;
}

.filter-label {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 0.95rem;
    flex: 1;
}

.filter-label i {
    font-size: 1rem;
    opacity: 0.7;
}

.filter-badge {
    background: white;
    padding: 3px 10px;
    border-radius: 15px;
    font-size: 0.75rem;
    font-weight: 600;
    color: var(--primary-color);
}

/* Custom Select */
.custom-select {
    padding: 12px 15px;
    border: 2px solid #e0e0e0;
    border-radius: 10px;
    font-size: 0.95rem;
    transition: all 0.3s;
    background-color: white;
}

.custom-select:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 0.2rem rgba(139, 69, 19, 0.15);
}

/* Clear Filters Button */
.clear-filters-btn {
    margin: 20px;
    padding: 12px;
    font-weight: 600;
    border: 2px solid var(--primary-color);
    color: var(--primary-color);
    transition: all 0.3s;
}

.clear-filters-btn:hover {
    background: var(--primary-color);
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(139, 69, 19, 0.3);
}

/* Products Grid */
.products-grid {
    min-height: 400px;
}

/* Empty State */
.empty-state {
    text-align: center;
    padding: 80px 20px;
    background: white;
    border-radius: 20px;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
}

.empty-state-icon {
    width: 120px;
    height: 120px;
    margin: 0 auto 30px;
    background: linear-gradient(135deg, var(--light-color) 0%, #fff 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.empty-state-icon i {
    font-size: 3.5rem;
    color: var(--primary-color);
}

.empty-state-title {
    font-size: 2rem;
    font-weight: 700;
    color: #333;
    margin-bottom: 15px;
}

.empty-state-text {
    color: #666;
    font-size: 1.1rem;
    margin-bottom: 30px;
    line-height: 1.8;
}

/* Custom Pagination */
.custom-pagination {
    display: flex;
    justify-content: center;
}

.custom-pagination .pagination {
    gap: 8px;
}

.custom-pagination .page-link {
    border: 2px solid #e0e0e0;
    color: var(--primary-color);
    padding: 10px 18px;
    border-radius: 10px;
    font-weight: 600;
    transition: all 0.3s;
}

.custom-pagination .page-link:hover {
    background: var(--primary-color);
    border-color: var(--primary-color);
    color: white;
    transform: translateY(-2px);
}

.custom-pagination .page-item.active .page-link {
    background: var(--primary-color);
    border-color: var(--primary-color);
}

/* Responsive */
@media (max-width: 991px) {
    .filters-sidebar {
        position: static;
    }
    
    .page-title {
        font-size: 2rem;
    }
}

@media (max-width: 768px) {
    .page-header {
        padding: 60px 0 40px;
        margin-bottom: 40px;
    }
    
    .product-count-badge {
        margin-top: 15px;
    }
}
</style>
@endpush

@push('scripts')
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
// Initialize AOS
AOS.init({
    duration: 800,
    once: true
});

// Apply Filters Function
function applyFilters() {
    const category = document.querySelector('input[name="category"]:checked')?.value || '';
    const sort = document.querySelector('select[name="sort"]')?.value || '';
    const priceRange = document.querySelector('input[name="price_range"]:checked')?.value || '';
    
    let url = new URL(window.location.href);
    
    // Set or delete category
    if (category) {
        url.searchParams.set('category', category);
    } else {
        url.searchParams.delete('category');
    }
    
    // Set or delete sort
    if (sort) {
        url.searchParams.set('sort', sort);
    } else {
        url.searchParams.delete('sort');
    }
    
    // Set or delete price range
    if (priceRange) {
        url.searchParams.set('price_range', priceRange);
    } else {
        url.searchParams.delete('price_range');
    }
    
    // Redirect with new parameters
    window.location.href = url.toString();
}
</script>
@endpush