@extends('layouts.app')

@section('title', 'Shipping Information - Batik Pudjangga')

@section('content')
<!-- Page Header -->
<section class="page-header-shipping">
    <div class="header-overlay"></div>
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-lg-8 text-center">
                <div class="header-icon" data-aos="zoom-in">
                    <i class="fas fa-shipping-fast"></i>
                </div>
                <h1 class="page-title" data-aos="fade-up" data-aos-delay="100">
                    Informasi Pengiriman
                </h1>
                <p class="page-subtitle" data-aos="fade-up" data-aos-delay="200">
                    Semua yang perlu Anda ketahui tentang pengiriman produk kami
                </p>
                <nav aria-label="breadcrumb" data-aos="fade-up" data-aos-delay="300">
                    <ol class="breadcrumb justify-content-center">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fas fa-home me-1"></i>Home</a></li>
                        <li class="breadcrumb-item active">Shipping Info</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>

<!-- Shipping Content -->
<section class="shipping-content py-5">
    <div class="container">
        <div class="row g-4">
            <!-- Estimasi Waktu -->
            <div class="col-lg-6" data-aos="fade-up">
                <div class="info-card time-card">
                    <div class="card-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <h3 class="card-title">Estimasi Waktu Pengiriman</h3>
                    <div class="card-content">
                        <p class="highlight-text">
                            <i class="fas fa-info-circle me-2"></i>
                            Karena semua produk <strong>pre-order & handmade</strong>, 
                            proses produksi membutuhkan waktu khusus
                        </p>
                        
                        <div class="timeline-box">
                            <div class="timeline-item">
                                <div class="timeline-icon">
                                    <i class="fas fa-cut"></i>
                                </div>
                                <div class="timeline-content">
                                    <h5>Persiapan & Jahit</h5>
                                    <p>2-3 hari kerja</p>
                                </div>
                            </div>
                            
                            <div class="timeline-item">
                                <div class="timeline-icon express">
                                    <i class="fas fa-bolt"></i>
                                </div>
                                <div class="timeline-content">
                                    <h5>Express Service</h5>
                                    <p>1 hari kerja</p>
                                    <span class="badge-price">+Rp 15.000 - Rp 25.000</span>
                                </div>
                            </div>
                            
                            <div class="timeline-item">
                                <div class="timeline-icon">
                                    <i class="fas fa-truck"></i>
                                </div>
                                <div class="timeline-content">
                                    <h5>Pengiriman</h5>
                                    <ul class="shipping-times">
                                        <li><i class="fas fa-map-marker-alt"></i> Jawa Tengah: 1-2 hari</li>
                                        <li><i class="fas fa-map-marker-alt"></i> Jakarta: 1-2 hari</li>
                                        <li><i class="fas fa-map-marker-alt"></i> Jawa Barat: 2-3 hari</li>
                                        <li><i class="fas fa-map-marker-alt"></i> Luar Jawa: 7-10 hari</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        
                        <div class="alert-box">
                            <i class="fas fa-calendar-check"></i>
                            <div>
                                <strong>Total Estimasi:</strong>
                                <p>7-14 hari sejak pembayaran dikonfirmasi</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Ekspedisi -->
            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                <div class="info-card courier-card">
                    <div class="card-icon">
                        <i class="fas fa-box"></i>
                    </div>
                    <h3 class="card-title">Ekspedisi yang Kami Gunakan</h3>
                    <div class="card-content">
                        <p class="mb-4">Kami bekerja sama dengan ekspedisi terpercaya untuk memastikan pesanan Anda sampai dengan aman:</p>
                        
                        <div class="courier-list">
                            <div class="courier-item">
                                <div class="courier-logo">
                                    <i class="fas fa-truck-loading"></i>
                                </div>
                                <div class="courier-info">
                                    <h5>Wahana Express</h5>
                                    <p>Pengiriman cepat dan terpercaya</p>
                                </div>
                            </div>
                            
                            <div class="courier-item">
                                <div class="courier-logo">
                                    <i class="fas fa-shipping-fast"></i>
                                </div>
                                <div class="courier-info">
                                    <h5>J&T Express</h5>
                                    <p>Layanan reguler nationwide</p>
                                </div>
                            </div>
                            
                            <div class="courier-item">
                                <div class="courier-logo">
                                    <i class="fas fa-box-open"></i>
                                </div>
                                <div class="courier-info">
                                    <h5>Leon Parcel</h5>
                                    <p>Pengiriman ekonomis</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="tracking-info">
                            <i class="fab fa-whatsapp"></i>
                            <div>
                                <strong>Tracking Number</strong>
                                <p>Nomor resi akan dikirim via WhatsApp setelah pesanan dikemas dan dikirim</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Ongkos Kirim -->
            <div class="col-12" data-aos="fade-up" data-aos-delay="200">
                <div class="info-card pricing-card">
                    <div class="card-icon">
                        <i class="fas fa-money-bill-wave"></i>
                    </div>
                    <h3 class="card-title">Ongkos Kirim</h3>
                    <div class="card-content">
                        <p class="mb-4">Ongkir dihitung otomatis saat checkout berdasarkan zona dan provinsi tujuan Anda</p>
                        
                        <div class="pricing-table">
                            <div class="pricing-header">
                                <h5>Estimasi Biaya Pengiriman Reguler</h5>
                            </div>
                            <div class="table-responsive">
                                <table class="table custom-table">
                                    <thead>
                                        <tr>
                                            <th><i class="fas fa-map-marked-alt me-2"></i>Zona / Provinsi</th>
                                            <th class="text-end"><i class="fas fa-tag me-2"></i>Biaya Pengiriman</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="zone-row">
                                            <td colspan="2" class="zone-header">
                                                <i class="fas fa-circle zone-indicator zone-1"></i>
                                                Zona 1 - Jawa Bagian Barat
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>DKI Jakarta</td>
                                            <td class="text-end"><span class="price-tag">Rp 12.000 - Rp 22.000</span></td>
                                        </tr>
                                        <tr>
                                            <td>Jawa Barat</td>
                                            <td class="text-end"><span class="price-tag">Rp 12.000 - Rp 22.000</span></td>
                                        </tr>
                                        <tr>
                                            <td>Banten</td>
                                            <td class="text-end"><span class="price-tag">Rp 12.000 - Rp 22.000</span></td>
                                        </tr>
                                        
                                        <tr class="zone-row">
                                            <td colspan="2" class="zone-header">
                                                <i class="fas fa-circle zone-indicator zone-2"></i>
                                                Zona 2 - Jawa Bagian Tengah & Timur
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Jawa Tengah</td>
                                            <td class="text-end"><span class="price-tag">Rp 15.000 - Rp 25.000</span></td>
                                        </tr>
                                        <tr>
                                            <td>DI Yogyakarta</td>
                                            <td class="text-end"><span class="price-tag">Rp 15.000 - Rp 25.000</span></td>
                                        </tr>
                                        <tr>
                                            <td>Jawa Timur</td>
                                            <td class="text-end"><span class="price-tag">Rp 15.000 - Rp 25.000</span></td>
                                        </tr>
                                        
                                        <tr class="zone-row">
                                            <td colspan="2" class="zone-header">
                                                <i class="fas fa-circle zone-indicator zone-3"></i>
                                                Zona 3 - Sumatera, Bali, Nusa Tenggara
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Sumatera (All)</td>
                                            <td class="text-end"><span class="price-tag">Rp 25.000 - Rp 35.000</span></td>
                                        </tr>
                                        <tr>
                                            <td>Bali</td>
                                            <td class="text-end"><span class="price-tag">Rp 25.000 - Rp 35.000</span></td>
                                        </tr>
                                        <tr>
                                            <td>Nusa Tenggara</td>
                                            <td class="text-end"><span class="price-tag">Rp 25.000 - Rp 35.000</span></td>
                                        </tr>
                                        
                                        <tr class="zone-row">
                                            <td colspan="2" class="zone-header">
                                                <i class="fas fa-circle zone-indicator zone-4"></i>
                                                Zona 4 - Kalimantan & Sulawesi
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Kalimantan (All)</td>
                                            <td class="text-end"><span class="price-tag">Rp 35.000 - Rp 45.000</span></td>
                                        </tr>
                                        <tr>
                                            <td>Sulawesi (All)</td>
                                            <td class="text-end"><span class="price-tag">Rp 35.000 - Rp 45.000</span></td>
                                        </tr>
                                        
                                        <tr class="zone-row">
                                            <td colspan="2" class="zone-header">
                                                <i class="fas fa-circle zone-indicator zone-5"></i>
                                                Zona 5 - Maluku & Papua
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Maluku</td>
                                            <td class="text-end"><span class="price-tag">Rp 50.000 - Rp 65.000</span></td>
                                        </tr>
                                        <tr>
                                            <td>Papua</td>
                                            <td class="text-end"><span class="price-tag">Rp 50.000 - Rp 65.000</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            
                            <div class="pricing-note">
                                <i class="fas fa-info-circle"></i>
                                <p><strong>Catatan:</strong> Biaya akhir akan dihitung otomatis saat checkout berdasarkan alamat pengiriman Anda. Range harga mencerminkan layanan reguler dan express.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- CTA Contact -->
            <div class="col-12" data-aos="fade-up" data-aos-delay="300">
                <div class="cta-card">
                    <div class="cta-content">
                        <div class="cta-icon">
                            <i class="fas fa-headset"></i>
                        </div>
                        <div class="cta-text">
                            <h4>Masih Ada Pertanyaan?</h4>
                            <p>Tim customer service kami siap membantu Anda 24/7</p>
                        </div>
                        <div class="cta-buttons">
                            <a href="https://wa.me/6285930433717?text=Halo%2C%20saya%20ingin%20bertanya%20tentang%20pengiriman" 
                               target="_blank" 
                               class="btn btn-whatsapp">
                                <i class="fab fa-whatsapp me-2"></i>Chat WhatsApp
                            </a>
                            <a href="{{ route('contact') }}" class="btn btn-outline-primary">
                                <i class="fas fa-envelope me-2"></i>Contact Form
                            </a>
                        </div>
                    </div>
                </div>
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
    --accent-color: #d4a574;
    --light-color: #f8f4ed;
}

/* Page Header */
.page-header-shipping {
    position: relative;
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
    padding: 120px 0 80px;
    overflow: hidden;
}

.header-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><rect width="100" height="100" fill="%238B4513"/><circle cx="50" cy="50" r="30" fill="none" stroke="%23ffffff" stroke-width="0.5" opacity="0.1"/></svg>') repeat;
    opacity: 0.1;
}

.header-icon {
    width: 100px;
    height: 100px;
    margin: 0 auto 30px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    backdrop-filter: blur(10px);
    border: 2px solid rgba(255, 255, 255, 0.2);
}

.header-icon i {
    font-size: 3rem;
    color: white;
}

.page-title {
    color: white;
    font-size: 3rem;
    font-weight: 700;
    margin-bottom: 15px;
}

.page-subtitle {
    color: rgba(255, 255, 255, 0.9);
    font-size: 1.2rem;
    margin-bottom: 30px;
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
}

.breadcrumb-item.active {
    color: white;
}

/* Info Cards */
.info-card {
    background: white;
    border-radius: 20px;
    padding: 40px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
    height: 100%;
    transition: all 0.3s;
}

.info-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.12);
}

.card-icon {
    width: 70px;
    height: 70px;
    background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
    border-radius: 15px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 25px;
}

.card-icon i {
    font-size: 2rem;
    color: white;
}

.card-title {
    font-size: 1.8rem;
    font-weight: 700;
    color: #333;
    margin-bottom: 20px;
}

.highlight-text {
    background: var(--light-color);
    padding: 15px 20px;
    border-radius: 10px;
    border-left: 4px solid var(--primary-color);
    margin-bottom: 25px;
}

/* Timeline */
.timeline-box {
    margin: 30px 0;
}

.timeline-item {
    display: flex;
    gap: 20px;
    margin-bottom: 25px;
    padding-bottom: 25px;
    border-bottom: 2px dashed #e0e0e0;
}

.timeline-item:last-child {
    border-bottom: none;
}

.timeline-icon {
    width: 50px;
    height: 50px;
    background: var(--light-color);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.timeline-icon i {
    color: var(--primary-color);
    font-size: 1.3rem;
}

.timeline-icon.express {
    background: linear-gradient(135deg, #ffd700, #ffed4e);
}

.timeline-icon.express i {
    color: #333;
}

.timeline-content h5 {
    font-size: 1.1rem;
    font-weight: 600;
    color: #333;
    margin-bottom: 5px;
}

.timeline-content p {
    color: #666;
    margin-bottom: 8px;
}

.badge-price {
    display: inline-block;
    background: #fff3cd;
    color: #856404;
    padding: 4px 12px;
    border-radius: 15px;
    font-size: 0.85rem;
    font-weight: 600;
}

.shipping-times {
    list-style: none;
    padding: 0;
    margin: 10px 0 0 0;
}

.shipping-times li {
    padding: 8px 0;
    color: #666;
}

.shipping-times i {
    color: var(--primary-color);
    margin-right: 8px;
}

.alert-box {
    background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
    padding: 20px;
    border-radius: 12px;
    display: flex;
    gap: 15px;
    align-items: start;
    border: 2px solid #b1dfbb;
}

.alert-box i {
    font-size: 1.5rem;
    color: #155724;
    margin-top: 3px;
}

.alert-box strong {
    color: #155724;
    display: block;
    margin-bottom: 5px;
}

.alert-box p {
    color: #155724;
    margin: 0;
}

/* Courier List */
.courier-list {
    margin: 25px 0;
}

.courier-item {
    display: flex;
    gap: 20px;
    padding: 20px;
    background: var(--light-color);
    border-radius: 12px;
    margin-bottom: 15px;
    transition: all 0.3s;
}

.courier-item:hover {
    background: linear-gradient(135deg, var(--light-color), #fff);
    transform: translateX(5px);
}

.courier-logo {
    width: 60px;
    height: 60px;
    background: white;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.courier-logo i {
    font-size: 1.8rem;
    color: var(--primary-color);
}

.courier-info h5 {
    font-size: 1.1rem;
    font-weight: 600;
    color: #333;
    margin-bottom: 5px;
}

.courier-info p {
    color: #666;
    margin: 0;
    font-size: 0.9rem;
}

.tracking-info {
    background: linear-gradient(135deg, #d1ecf1, #bee5eb);
    padding: 20px;
    border-radius: 12px;
    display: flex;
    gap: 15px;
    margin-top: 20px;
    border: 2px solid #b8daff;
}

.tracking-info i {
    font-size: 2rem;
    color: #25D366;
}

.tracking-info strong {
    color: #0c5460;
    display: block;
    margin-bottom: 5px;
}

.tracking-info p {
    color: #0c5460;
    margin: 0;
}

/* Pricing Table */
.pricing-table {
    background: white;
}

.pricing-header {
    background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
    padding: 20px;
    border-radius: 12px 12px 0 0;
    text-align: center;
}

.pricing-header h5 {
    color: white;
    margin: 0;
    font-size: 1.3rem;
    font-weight: 600;
}

.custom-table {
    margin: 0;
    background: white;
}

.custom-table thead {
    background: var(--light-color);
}

.custom-table th {
    padding: 15px 20px;
    font-weight: 600;
    color: var(--primary-dark);
    border: none;
}

.custom-table td {
    padding: 12px 20px;
    color: #555;
    border-bottom: 1px solid #f0f0f0;
}

.zone-row {
    background: transparent;
}

.zone-header {
    background: var(--light-color) !important;
    padding: 12px 20px !important;
    font-weight: 600;
    color: var(--primary-dark) !important;
}

.zone-indicator {
    font-size: 0.6rem;
    margin-right: 8px;
}

.zone-1 { color: #28a745; }
.zone-2 { color: #17a2b8; }
.zone-3 { color: #ffc107; }
.zone-4 { color: #fd7e14; }
.zone-5 { color: #dc3545; }

.price-tag {
    display: inline-block;
    background: linear-gradient(135deg, var(--accent-color), #e0c097);
    color: #333;
    padding: 6px 15px;
    border-radius: 20px;
    font-weight: 600;
    font-size: 0.95rem;
}

.pricing-note {
    background: #fff3cd;
    padding: 15px 20px;
    display: flex;
    gap: 12px;
    border-radius: 0 0 12px 12px;
    border-top: 2px solid #ffeaa7;
}

.pricing-note i {
    color: #856404;
    font-size: 1.2rem;
    margin-top: 2px;
}

.pricing-note p {
    color: #856404;
    margin: 0;
    font-size: 0.9rem;
}

/* CTA Card */
.cta-card {
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
    border-radius: 20px;
    padding: 50px;
    position: relative;
    overflow: hidden;
}

.cta-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><circle cx="50" cy="50" r="40" fill="none" stroke="%23ffffff" stroke-width="0.5"/></svg>') repeat;
    opacity: 0.1;
}

.cta-content {
    position: relative;
    display: flex;
    align-items: center;
    gap: 30px;
    flex-wrap: wrap;
}

.cta-icon {
    width: 80px;
    height: 80px;
    background: rgba(255, 255, 255, 0.15);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    backdrop-filter: blur(10px);
}

.cta-icon i {
    font-size: 2.5rem;
    color: white;
}

.cta-text {
    flex: 1;
    color: white;
}

.cta-text h4 {
    font-size: 1.8rem;
    font-weight: 700;
    margin-bottom: 10px;
}

.cta-text p {
    margin: 0;
    opacity: 0.9;
}

.cta-buttons {
    display: flex;
    gap: 15px;
    flex-wrap: wrap;
}

.btn-whatsapp {
    background: #25D366;
    color: white;
    padding: 12px 30px;
    border-radius: 10px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s;
    border: 2px solid #25D366;
}

.btn-whatsapp:hover {
    background: #128C7E;
    border-color: #128C7E;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(37, 211, 102, 0.4);
}

.btn-outline-primary {
    background: transparent;
    color: white;
    padding: 12px 30px;
    border-radius: 10px;
    font-weight: 600;
    text-decoration: none;
    border: 2px solid white;
    transition: all 0.3s;
}

.btn-outline-primary:hover {
    background: white;
    color: var(--primary-color);
    transform: translateY(-2px);
}

/* Responsive */
@media (max-width: 991px) {
    .page-title {
        font-size: 2.2rem;
    }
    
    .info-card {
        padding: 30px;
    }
    
    .cta-content {
        text-align: center;
        justify-content: center;
    }
    
    .cta-buttons {
        width: 100%;
        justify-content: center;
    }
}

@media (max-width: 768px) {
    .page-header-shipping {
        padding: 100px 0 60px;
    }
    
    .page-title {
        font-size: 1.8rem;
    }
    
    .cta-card {
        padding: 30px 20px;
    }
    
    .cta-text h4 {
        font-size: 1.4rem;
    }
    
    .btn-whatsapp,
    .btn-outline-primary {
        width: 100%;
        text-align: center;
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