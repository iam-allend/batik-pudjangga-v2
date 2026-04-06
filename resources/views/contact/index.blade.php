@extends('layouts.app')

@section('title', 'Contact Us - Batik Pudjangga')

@section('content')
<!-- Page Header -->
<section class="page-header">
    <div class="container">
        <h1 class="display-4 fw-bold text-center mb-3">Hubungi Kami</h1>
        <p class="lead text-center text-muted">
            Ada pertanyaan? Kami siap membantu Anda
        </p>
    </div>
</section>

<section class="contact-section py-5">
    <div class="container">
        <!-- Success/Error Messages -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show">
                <i class="fas fa-exclamation-circle me-2"></i>
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row">
            <!-- Contact Information -->
            <div class="col-lg-4 mb-4">
                <div class="contact-info">
                    <!-- Office Address -->
                    <div class="info-card mb-4">
                        <div class="icon-box">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="info-content">
                            <h5>Alamat Kantor</h5>
                            <p>
                                Jl. Cengkeh No.11<br>
                                 Medono, Kec. Pekalongan Bar.<br>
                                 Kota Pekalongan, Jawa Tengah 51111
                            </p>
                        </div>
                    </div>

                    <!-- Phone -->
                    <div class="info-card mb-4">
                        <div class="icon-box">
                            <i class="fas fa-phone-alt"></i>
                        </div>
                        <div class="info-content">
                            <h5>Telepon</h5>
                            <p>
                                <a href="tel:+6285930433717">+62 859 3043 3717</a><br>
                                <a href="tel:+6285742977510">+62 857 4297 7510</a>
                            </p>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="info-card mb-4">
                        <div class="icon-box">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="info-content">
                            <h5>Email</h5>
                            <p>
                                <a href="mailto:faradisaolshop1@gmail.com">faradisaolshop1@gmail.com</a><br>
                                <a href="mailto:sahda5824@gmail.com">support@batikpudjangga.com</a>
                            </p>
                        </div>
                    </div>

                    <!-- Working Hours -->
                    <div class="info-card mb-4">
                        <div class="icon-box">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="info-content">
                            <h5>Jam Operasional</h5>
                            <p>
                                Senin - Kamis: 09:00 - 17:00<br>
                                Sabtu - Minggu: 09:00 - 17:00<br>
                                Jumat & Hari Libur: Tutup
                            </p>
                        </div>
                    </div>

                    <!-- Social Media -->
                    <div class="info-card">
                        <div class="icon-box">
                            <i class="fas fa-share-alt"></i>
                        </div>
                        <div class="info-content">
                            <h5>Ikuti Kami</h5>
                            <div class="social-links">
                                <a href="https://www.instagram.com/shopfaradisa?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" class="social-link" title="Instagram">
                                    <i class="fab fa-instagram"></i>
                                </a>
                                </a>
                                <a href="https://wa.me/6285930433717" class="social-link" title="WhatsApp">
                                    <i class="fab fa-whatsapp"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="col-lg-8">
                <div class="contact-form-wrapper">
                    <h3 class="mb-4">Kirim Pesan</h3>
                    <form action="{{ route('contact.store') }}" method="POST" id="contactForm">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" 
                                       class="form-control @error('name') is-invalid @enderror" 
                                       id="name" 
                                       name="name" 
                                       value="{{ old('name') }}"
                                       placeholder="Masukkan nama Anda" 
                                       required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" 
                                       class="form-control @error('email') is-invalid @enderror" 
                                       id="email" 
                                       name="email" 
                                       value="{{ old('email') }}"
                                       placeholder="email@example.com" 
                                       required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="message" class="form-label">Pesan <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('message') is-invalid @enderror" 
                                      id="message" 
                                      name="message" 
                                      rows="6" 
                                      placeholder="Tulis pesan Anda di sini..."
                                      required>{{ old('message') }}</textarea>
                            @error('message')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">
                                <i class="fas fa-info-circle me-1"></i>
                                Maksimal 2000 karakter
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-paper-plane me-2"></i>Kirim Pesan
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Map Section -->
        <div class="map-section mt-5">
            <h3 class="text-center mb-4">Lokasi Kami</h3>
            <div class="map-wrapper">
                <!-- Google Maps Embed -->
                 <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2856.6086070852543!2d109.66032671984651!3d-6.901007293098295!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e70269dc3a784c1%3A0x9aba6a265bee9faf!2sJl.%20Cengkeh%20No.11%2C%20Medono%2C%20Kec.%20Pekalongan%20Bar.%2C%20Kota%20Pekalongan%2C%20Jawa%20Tengah%2051111!5e0!3m2!1sid!2sid!4v1767168321334!5m2!1sid!2sid" 
                    width="100%" height="450" style="border:0; border-radius: 10px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>

        <!-- FAQ Section -->
        <div class="faq-section mt-5">
            <h3 class="text-center mb-4">Pertanyaan yang Sering Diajukan</h3>
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="accordion" id="faqAccordion">
                        <!-- FAQ 1 -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                    Berapa lama pengiriman pesanan?
                                </button>
                            </h2>
                            <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Pengiriman reguler membutuhkan waktu 3-5 hari kerja, sedangkan pengiriman express 1-2 hari kerja tergantung lokasi tujuan.
                                </div>
                            </div>
                        </div>

                        <!-- FAQ 2 -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                    Apakah produk bisa diretur?
                                </button>
                            </h2>
                            <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Ya, kami menerima retur dalam waktu 7 hari setelah produk diterima dengan syarat produk dalam kondisi baik dan belum dipakai.
                                </div>
                            </div>
                        </div>

                        <!-- FAQ 3 -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                    Apakah batik yang dijual asli?
                                </button>
                            </h2>
                            <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Ya, semua batik kami adalah batik asli buatan tangan oleh pengrajin lokal dengan kualitas terjamin.
                                </div>
                            </div>
                        </div>

                        <!-- FAQ 4 -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                                    Bagaimana cara pembayaran?
                                </button>
                            </h2>
                            <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Kami menerima pembayaran melalui transfer bank dan Cash on Delivery (COD) untuk wilayah tertentu.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
.page-header {
    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    padding: 60px 0;
}

.contact-info {
    position: sticky;
    top: 100px;
}

.info-card {
    background: white;
    padding: 25px;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.08);
    display: flex;
    gap: 20px;
}

.icon-box {
    width: 50px;
    height: 50px;
    background: #8B4513;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.icon-box i {
    font-size: 24px;
    color: white;
}

.info-content h5 {
    font-size: 1.1rem;
    font-weight: 600;
    margin-bottom: 10px;
    color: #333;
}

.info-content p {
    margin: 0;
    color: #666;
    line-height: 1.8;
}

.info-content a {
    color: var(--primary-color, #0d6efd);
    text-decoration: none;
}

.info-content a:hover {
    text-decoration: underline;
}

.social-links {
    display: flex;
    gap: 10px;
}

.social-link {
    width: 40px;
    height: 40px;
    background: var(--primary-color, #0d6efd);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    text-decoration: none;
    transition: all 0.3s;
}

.social-link:hover {
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    color: white;
}

.contact-form-wrapper {
    background: white;
    padding: 40px;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.08);
}

.contact-form-wrapper h3 {
    color: #333;
    font-weight: 600;
}

.form-label {
    font-weight: 500;
    color: #333;
}

.form-control {
    padding: 12px;
    border: 2px solid #e0e0e0;
    border-radius: 8px;
    transition: all 0.3s;
}

.form-control:focus {
    border-color: var(--primary-color, #0d6efd);
    box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.15);
}

.btn-primary {
    padding: 12px 40px;
    border-radius: 8px;
    font-weight: 500;
}

.map-wrapper {
    box-shadow: 0 2px 20px rgba(0,0,0,0.1);
    border-radius: 10px;
    overflow: hidden;
}

.accordion-item {
    border: none;
    margin-bottom: 15px;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
}

.accordion-button {
    background: white;
    color: #333;
    font-weight: 500;
    padding: 20px;
}

.accordion-button:not(.collapsed) {
    background: var(--primary-color, #0d6efd);
    color: white;
}

.accordion-button:focus {
    box-shadow: none;
}

.accordion-body {
    padding: 20px;
    background: #f8f9fa;
}
</style>
@endpush