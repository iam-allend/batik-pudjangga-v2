@extends('layouts.app')

@section('title', 'About Us - Batik Pudjangga')

@section('content')
<!-- Hero Section -->
<section class="about-hero">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <h1 class="display-4 fw-bold mb-3">Tentang Batik Pudjangga</h1>
                <p class="lead text-muted">
                    Melestarikan Warisan Budaya Indonesia melalui Batik Berkualitas Tinggi
                </p>
                <div class="divider"></div>
            </div>
            <div class="col-lg-6">
                <img src="{{ asset('assets\img\pj_banner.png')}}"  alt="Batik Pudjangga" class="img-fluid rounded shadow">
            </div>
        </div>
    </div>
</section>

<!-- Our Story Section -->
<section class="our-story py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center mb-5">
                <h2 class="section-title">Kisah Kami</h2>
                <p class="lead">
                    Batik Pudjangga lahir dari kecintaan mendalam terhadap warisan budaya Indonesia
                </p>
            </div>
        </div>
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4">
                <div class="story-content">
                    <h3 class="mb-3">Perjalanan Kami</h3>
                    <p>
                        berdiri tahun 2004 bermula hanya memproduksi kain tenun dengan nama "Djingga Collection" karena ada kain yg pada riject akhirnya kami memutuskan untuk 
                        membbuat baju dari kain riject tersebut kita desain waktu itu khusus untuk pria saja, tapi sering waktu berjalan banyak yang minta untuk memproduksi buat wanita juga, 
                        akhirnya kami mencoba memproduksinya dan kami ganti nama Pudjangga batik dan sampai sekarang kami memproduksi baju untuk pria dan wanita.
                    </p>
                    <p>
                        Tanggapan pasar yang positif mendorong perluasan ini konsumen perempuan mulai berdatangan dan meminta versi yang disesuaikan untuk mereka. Permintaan ini mendorong manajemen untuk merambah pasar wanita,
                        sekaligus melakukan rebranding menjadi “Pudjangga Batik” agar nama mencerminkan nuansa klasik, budaya, dan inklusivitas gender.
                    </p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="row g-3">
                    <div class="col-6">
                        <img src="{{ asset('assets\img\lucu.png') }}" alt="Batik Process" class="img-fluid rounded">
                    </div>
                    <div class="col-6">
                        <img src="{{ asset('assets\img\gemes.png') }}" alt="Batik Craftsman" class="img-fluid rounded">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Our Values Section -->
<section class="our-values py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center mb-5">
                <h2 class="section-title">Nilai-Nilai Kami</h2>
                <p class="lead">
                    Prinsip yang kami pegang teguh dalam setiap langkah perjalanan kami
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="value-card">
                    <div class="icon-wrapper">
                        <i class="fas fa-heart"></i>
                    </div>
                    <h4>Kualitas Premium</h4>
                    <p>
                        Setiap produk dipilih dengan standar kualitas tertinggi,
                        dari bahan hingga proses pembuatan.
                    </p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="value-card">
                    <div class="icon-wrapper">
                        <i class="fas fa-hands-helping"></i>
                    </div>
                    <h4>Pemberdayaan Lokal</h4>
                    <p>
                        Kami bermitra dengan pengrajin lokal untuk mendukung
                        ekonomi dan melestarikan tradisi batik.
                    </p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="value-card">
                    <div class="icon-wrapper">
                        <i class="fas fa-leaf"></i>
                    </div>
                    <h4>Ramah Lingkungan</h4>
                    <p>
                        Menggunakan bahan-bahan alami dan proses produksi
                        yang berkelanjutan.
                    </p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="value-card">
                    <div class="icon-wrapper">
                        <i class="fas fa-palette"></i>
                    </div>
                    <h4>Desain Inovatif</h4>
                    <p>
                        Menggabungkan motif tradisional dengan desain modern
                        yang sesuai dengan gaya hidup masa kini.
                    </p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="value-card">
                    <div class="icon-wrapper">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h4>Kepercayaan Pelanggan</h4>
                    <p>
                        Memberikan pelayanan terbaik dan menjamin kepuasan
                        setiap pelanggan kami.
                    </p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="value-card">
                    <div class="icon-wrapper">
                        <i class="fas fa-star"></i>
                    </div>
                    <h4>Authenticity</h4>
                    <p>
                        Setiap produk adalah batik asli Indonesia dengan
                        keaslian yang terjamin.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Statistics Section -->
<section class="statistics py-5">
    <div class="container">
        <div class="row text-center">
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="stat-card">
                    <h2 class="stat-number">20+</h2>
                    <p class="stat-label">Tahun Pengalaman</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="stat-card">
                    <h2 class="stat-number">30K+</h2>
                    <p class="stat-label">Pelanggan Puas</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="stat-card">
                    <h2 class="stat-number">150+</h2>
                    <p class="stat-label">Koleksi Batik</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="stat-card">
                    <h2 class="stat-number">5</h2>
                    <p class="stat-label">Mitra Pengrajin</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Why Choose Us Section -->
<section class="why-choose-us py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center mb-5">
                <h2 class="section-title">Mengapa Memilih Batik Pudjangga?</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 mb-4">
                <div class="feature-item">
                    <i class="fas fa-check-circle text-success"></i>
                    <div>
                        <h5>Batik Asli Buatan Tangan</h5>
                        <p>Setiap batik dibuat dengan teknik tradisional oleh pengrajin berpengalaman</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mb-4">
                <div class="feature-item">
                    <i class="fas fa-check-circle text-success"></i>
                    <div>
                        <h5>Bahan Berkualitas Premium</h5>
                        <p>Menggunakan kain katun dan sutra berkualitas tinggi yang nyaman dipakai</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mb-4">
                <div class="feature-item">
                    <i class="fas fa-check-circle text-success"></i>
                    <div>
                        <h5>Desain Eksklusif</h5>
                        <p>Koleksi desain unik yang tidak tersedia di tempat lain</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mb-4">
                <div class="feature-item">
                    <i class="fas fa-check-circle text-success"></i>
                    <div>
                        <h5>Harga Terjangkau</h5>
                        <p>Kualitas premium dengan harga yang kompetitif dan fair</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mb-4">
                <div class="feature-item">
                    <i class="fas fa-check-circle text-success"></i>
                    <div>
                        <h5>Pengiriman Aman</h5>
                        <p>Produk dikemas dengan baik dan dikirim ke seluruh Indonesia</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mb-4">
                <div class="feature-item">
                    <i class="fas fa-check-circle text-success"></i>
                    <div>
                        <h5>Customer Service Responsif</h5>
                        <p>Tim kami siap membantu Anda dengan pelayanan terbaik</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section py-5 text-center">
    <div class="container">
        <h2 class="mb-3">Siap Menemukan Batik Favorit Anda?</h2>
        <p class="lead mb-4">Jelajahi koleksi batik premium kami sekarang</p>
        <a href="{{ route('shop.index') }}" class="btn btn-primary btn-lg">
            <i class="fas fa-shopping-bag me-2"></i>Belanja Sekarang
        </a>
    </div>
</section>
@endsection

@push('styles')
<style>
    .about-hero {
        padding: 80px 0;
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    }

    .divider {
        width: 80px;
        height: 4px;
        background: var(--primary-color, #0d6efd);
        margin: 20px 0;
    }

    .section-title {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 1rem;
        color: #333;
    }

    .value-card {
        background: white;
        padding: 30px;
        border-radius: 10px;
        text-align: center;
        transition: all 0.3s;
        height: 100%;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    .value-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    .icon-wrapper {
        width: 80px;
        height: 80px;
        margin: 0 auto 20px;
        background: #8B4513;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .icon-wrapper i {
        font-size: 32px;
        color: white;
    }

    .value-card h4 {
        font-size: 1.25rem;
        font-weight: 600;
        margin-bottom: 15px;
        color: #333;
    }

    .value-card p {
        color: #666;
        margin: 0;
    }

    .stat-card {
        padding: 30px;
    }

    .stat-number {
        font-size: 3rem;
        font-weight: 700;
        color: var(--primary-color, #0d6efd);
        margin-bottom: 10px;
    }

    .stat-label {
        font-size: 1.1rem;
        color: #666;
        margin: 0;
    }

    .feature-item {
        display: flex;
        gap: 15px;
        padding: 20px;
        background: white;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    .feature-item i {
        font-size: 24px;
        flex-shrink: 0;
    }

    .feature-item h5 {
        margin-bottom: 8px;
        color: #333;
    }

    .feature-item p {
        margin: 0;
        color: #666;
    }

    .cta-section {
        background: #8B4513;
        color: white;
    }

    .cta-section .btn-primary {
        background: white;
        color: var(--primary-color, #0d6efd);
        border: none;
    }

    .cta-section .btn-primary:hover {
        background: #f8f9fa;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }
</style>
@endpush