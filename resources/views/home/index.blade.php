@extends('layouts.app')

@section('title', 'Batik Pudjangga - Premium Indonesian Batik')

@section('content')
<!-- Hero Section -->
<section class="hero-section">
    <div class="hero-overlay"></div>
    <div class="container">
        <div class="row align-items-center" style="min-height: 600px;">
            <div class="col-lg-6">
                <h1 class="hero-title" data-aos="fade-up">
                   Sentuhan Seni dalam Setiap Helai Kain Batik<br>
                </h1>
                <p class="hero-subtitle" data-aos="fade-up" data-aos-delay="100">
                    Batik lukis dan tenun karya tangan yang dikerjakan dengan penuh dedikasi. Setiap motif 
                    adalah mahakarya eksklusif yang tak akan Anda temui di tempat lain.
                </p>
                <div class="hero-buttons" data-aos="fade-up" data-aos-delay="200">
                    <a href="{{ route('shop.index') }}" class="btn btn-primary btn-lg me-3">
                        <i class="fas fa-shopping-bag me-2"></i>Belanja Sekarang
                    </a>
                    <a href="{{ route('about') }}" class="btn btn-outline-primary btn-lg">
                        <i class="fas fa-info-circle me-2"></i> Tentang Kami
                    </a>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left" data-aos-delay="300">
                <div class="hero-image-wrapper">
                    <img src="{{ asset('assets/img/logo.png') }}" 
                         alt="Batik Collection" 
                         class="img-fluid hero-image">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="features-section py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-3 col-6" data-aos="fade-up">
                <div class="feature-card text-center">
                    <div class="feature-icon">
                        <i class="fas fa-shipping-fast"></i>
                    </div>
                    <h5>Free Ongkir</h5>
                    <p>Untuk order diatas Rp 900.000</p>
                </div>
            </div>
            <div class="col-md-3 col-6" data-aos="fade-up" data-aos-delay="100">
                <div class="feature-card text-center">
                    <div class="feature-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h5>Keamanan Pembayaran</h5>
                    <p>100% Tranksaksi Aman</p>
                </div>
            </div>
            <div class="col-md-3 col-6" data-aos="fade-up" data-aos-delay="200">
                <div class="feature-card text-center">
                    <div class="feature-icon">
                        <i class="fas fa-undo"></i>
                    </div>
                    <h5>Pengembalian Dengan Mudah</h5>
                    <p>7 hari Kebijakan Pengembalian</p>
                </div>
            </div>
            <div class="col-md-3 col-6" data-aos="fade-up" data-aos-delay="300">
                <div class="feature-card text-center">
                    <div class="feature-icon">
                        <i class="fas fa-headset"></i>
                    </div>
                    <h5>24/7 Support</h5>
                    <p>Dedikasi Custumer Service</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- New Arrivals -->
@if($newProducts->count() > 0)
<section class="products-section py-5">
    <div class="container">
        <div class="section-header text-center mb-5" data-aos="fade-up">
            <span class="section-badge">Koleksi Terbaru</span>
            <h2 class="section-title">Produk Terbaru</h2>
        </div>
        
        <div class="row g-4">
            @foreach($newProducts as $product)
                <div class="col-lg-3 col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    @include('components.product-card', ['product' => $product])
                </div>
            @endforeach
        </div>
        
        <div class="text-center mt-5" data-aos="fade-up">
            <a href="{{ route('shop.new') }}" class="btn btn-outline-primary btn-lg">
                Lihat Semua Produk Baru <i class="fas fa-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
</section>
@endif

<!-- Sale Products -->
@if($saleProducts->count() > 0)
<section class="sale-section py-5" style="background: var(--light-color);">
    <div class="container">
        <div class="section-header text-center mb-5" data-aos="fade-up">
            <span class="section-badge bg-danger">Special Offer</span>
            <h2 class="section-title">Hot Sale!</h2>
            <p class="section-subtitle">Produk dan Waktu Terbatas</p>
        </div>
        
        <div class="row g-4">
            @foreach($saleProducts as $product)
                <div class="col-lg-3 col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    @include('components.product-card', ['product' => $product])
                </div>
            @endforeach
        </div>
        
        <div class="text-center mt-5" data-aos="fade-up">
            <a href="{{ route('shop.sale') }}" class="btn btn-danger btn-lg">
                Lihat semua produk diskon <i class="fas fa-fire ms-2"></i>
            </a>
        </div>
    </div>
</section>
@endif

<!-- Categories -->
<section class="categories-section py-5">
    <div class="container">
        <div class="section-header text-center mb-5" data-aos="fade-up">
            <span class="section-badge">Belanja Berdasarkan Kategori</span>
            <h2 class="section-title">Koleksi Kita</h2>
            <p class="section-subtitle">Jelajahi beragam produk kami</p>
        </div>
        
        <div class="row g-4">
            <div class="col-md-3 col-6" data-aos="fade-up">
                <a href="{{ route('shop.men') }}" class="category-card">
                    <div class="category-image">
                        {{-- FIX: Gunakan gambar default jika tidak ada --}}
                        <img src="{{ asset('assets/img/cowok.png') }}" 
                             alt="Men Collection"
                             onerror="this.src='{{ asset('assets/img/default-category.jpg') }}'">
                    </div>
                    <div class="category-overlay">
                        <h4>Koleksi Pria</h4>
                    </div>
                </a>
            </div>
            
            <div class="col-md-3 col-6" data-aos="fade-up" data-aos-delay="100">
                <a href="{{ route('shop.women') }}" class="category-card">
                    <div class="category-image">
                        <img src="{{ asset('assets/img/wanita.png') }}" 
                             alt="Women Collection"
                             onerror="this.src='{{ asset('assets/img/default-category.jpg') }}'">
                    </div>
                    <div class="category-overlay">
                        <h4>Koleksi Wanita</h4>
                    </div>
                </a>
            </div>
            
            <div class="col-md-3 col-6" data-aos="fade-up" data-aos-delay="200">
                <a href="{{ route('shop.pants') }}" class="category-card">
                    <div class="category-image">
                        <img src="{{ asset('assets/img/celanaoi.png') }}" 
                             alt="Pants Collection"
                             onerror="this.src='{{ asset('assets/img/default-category.jpg') }}'">
                    </div>
                    <div class="category-overlay">
                        <h4>Koleksi Celana</h4>
                    </div>
                </a>
            </div>
            
            <div class="col-md-3 col-6" data-aos="fade-up" data-aos-delay="300">
                <a href="{{ route('shop.oneset') }}" class="category-card">
                    <div class="category-image">
                        <img src="{{asset('assets/img/onesett.png') }}" 
                             alt="One Set Collection"
                             onerror="this.src='{{ asset('assets/img/default-category.jpg') }}'">
                    </div>
                    <div class="category-overlay">
                        <h4>One Set</h4>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- About Preview -->
<section class="about-preview py-5" style="background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0" data-aos="fade-right">
                <img src="{{ asset('assets/images/about-preview.jpg') }}" 
                     alt="About Us" 
                     class="img-fluid rounded shadow"
                     onerror="this.src='{{ asset('assets/img/logo.png') }}'">
            </div>
            <div class="col-lg-6 text-white" data-aos="fade-left">
                <span class="section-badge bg-white text-dark">Tentang Kami</span>
                <h2 class="mt-3 mb-4">Seni Batik Lukis & Tenun yang Tak Tergantikan</h2>
                <p class="mb-4">
                    Batik Pudjangga menghadirkan batik lukis dan tenun handmade yang dikerjakan oleh seniman
                    terampil dengan dedikasi tinggi. Setiap karya adalah hasil seni eksklusif yang menggabungkan teknik tradisional 
                    dengan sentuhan desain kontemporer. Bukan batik pasaran—ini adalah mahakarya unik yang menjamin keaslian dan kualitas premium.
                </p>
                <ul class="list-unstyled">
                    <li class="mb-2"><i class="fas fa-check-circle me-2"></i>100% Batik Lukis & Tenun Handmade</li>
                    <li class="mb-2"><i class="fas fa-check-circle me-2"></i>Karya Seniman Lokal Berpengalaman</li>
                    <li class="mb-2"><i class="fas fa-check-circle me-2"></i>Material Premium Berkualitas Tinggi</li>
                    <li class="mb-2"><i class="fas fa-check-circle me-2"></i>Desain Eksklusif & Tidak Pasaran</li>
                </ul>
                <a href="{{ route('about') }}" class="btn btn-light btn-lg mt-3">
                    Kenali Lebih Dekat<i class="fas fa-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Newsletter -->
<section class="newsletter-section py-5">
    <div class="container">
        <div class="newsletter-box" data-aos="zoom-in">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <h3>Subscribe to Our Newsletter</h3>
                    <p>Get the latest updates on new products and exclusive offers!</p>
                </div>
                <div class="col-lg-6">
                    <form action="{{ route('subscribe') }}" method="POST">
                        @csrf
                        <div class="input-group input-group-lg">
                            <input type="email" name="email" class="form-control" 
                                   placeholder="Enter your email" required>
                            <button class="btn btn-primary" type="submit">
                                Subscribe <i class="fas fa-paper-plane ms-2"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css">
<style>
/* Hero Section */
.hero-section {
    position: relative;
    background: linear-gradient(135deg, var(--light-color) 0%, #fff 100%);
    overflow: hidden;
}

.hero-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('{{ asset("assets/images/batik-pattern.png") }}') repeat;
    opacity: 0.05;
}

.hero-title {
    font-size: 3.5rem;
    font-weight: 700;
    line-height: 1.2;
    margin-bottom: 20px;
}

.text-gradient {
    background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.hero-subtitle {
    font-size: 1.2rem;
    color: #666;
    margin-bottom: 30px;
}

.hero-image-wrapper {
    position: relative;
    animation: float 6s ease-in-out infinite;
}

@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-20px); }
}

/* Features */
.feature-card {
    padding: 30px 20px;
    transition: all 0.3s;
}

.feature-card:hover {
    transform: translateY(-10px);
}

.feature-icon {
    width: 80px;
    height: 80px;
    margin: 0 auto 20px;
    background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    color: white;
}

.feature-card h5 {
    font-size: 1.1rem;
    margin-bottom: 10px;
}

.feature-card p {
    color: #666;
    font-size: 0.9rem;
    margin: 0;
}

/* Section Headers */
.section-badge {
    display: inline-block;
    padding: 8px 20px;
    background: var(--primary-color);
    color: white;
    border-radius: 20px;
    font-size: 0.9rem;
    font-weight: 500;
    margin-bottom: 15px;
}

.section-title {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 15px;
}

.section-subtitle {
    font-size: 1.1rem;
    color: #666;
}

/* Categories */
.category-card {
    display: block;
    position: relative;
    border-radius: 15px;
    overflow: hidden;
    height: 400px;
    text-decoration: none;
}

.category-image {
    width: 100%;
    height: 100%;
}

.category-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s;
}

.category-overlay {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);
    padding: 30px 20px;
    color: white;
    transition: all 0.3s;
}

.category-card:hover .category-image img {
    transform: scale(1.1);
}

.category-card:hover .category-overlay {
    background: linear-gradient(to top, var(--primary-color), transparent);
}

.category-overlay h4 {
    font-size: 1.5rem;
    margin-bottom: 5px;
}

.category-overlay p {
    margin: 0;
    font-size: 0.9rem;
    opacity: 0.9;
}

/* Newsletter */
.newsletter-box {
    background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
    padding: 50px;
    border-radius: 20px;
    color: white;
}

.newsletter-box h3 {
    font-size: 2rem;
    margin-bottom: 10px;
}

.newsletter-box p {
    font-size: 1.1rem;
    opacity: 0.9;
}

.newsletter-box .input-group .form-control {
    border: none;
    padding: 15px 20px;
    border-radius: 10px 0 0 10px;
}

.newsletter-box .btn {
    border-radius: 0 10px 10px 0;
    background: white;
    color: var(--primary-color);
    font-weight: 600;
}

.newsletter-box .btn:hover {
    background: var(--light-color);
}

/* Responsive */
@media (max-width: 768px) {
    .hero-title {
        font-size: 2rem;
    }
    
    .section-title {
        font-size: 1.8rem;
    }
    
    .category-card {
        height: 250px;
    }
    
    .newsletter-box {
        padding: 30px 20px;
    }
}
</style>
@endpush

@push('scripts')
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({
        duration: 800,
        once: true
    });
</script>
@endpush