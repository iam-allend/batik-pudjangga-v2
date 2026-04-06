@extends('layouts.app')

@section('title', 'Return Policy - Batik Pudjangga')

@section('content')
<!-- Page Header -->
<section class="page-header-return">
    <div class="header-overlay"></div>
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-lg-8 text-center">
                <div class="header-icon" data-aos="zoom-in">
                    <i class="fas fa-undo-alt"></i>
                </div>
                <h1 class="page-title" data-aos="fade-up" data-aos-delay="100">
                    Kebijakan Pengembalian
                </h1>
                <p class="page-subtitle" data-aos="fade-up" data-aos-delay="200">
                    Kepuasan Anda adalah prioritas kami
                </p>
                <nav aria-label="breadcrumb" data-aos="fade-up" data-aos-delay="300">
                    <ol class="breadcrumb justify-content-center">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fas fa-home me-1"></i>Home</a></li>
                        <li class="breadcrumb-item active">Return Policy</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>

<!-- Return Policy Content -->
<section class="policy-content py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                
                <!-- Important Notice -->
                <div class="alert-card important" data-aos="fade-up">
                    <div class="alert-icon">
                        <i class="fas fa-exclamation-circle"></i>
                    </div>
                    <div class="alert-content">
                        <h4>Penting untuk Diketahui</h4>
                        <p>Karena produk kami adalah <strong>pre-order & handmade</strong>, setiap item dibuat khusus sesuai pesanan Anda. Mohon baca kebijakan ini dengan teliti sebelum melakukan pemesanan.</p>
                    </div>
                </div>

                <!-- Syarat & Ketentuan -->
                <div class="policy-card" data-aos="fade-up" data-aos-delay="100">
                    <div class="policy-icon">
                        <i class="fas fa-clipboard-check"></i>
                    </div>
                    <h3 class="policy-title">Syarat Pengembalian</h3>
                    <div class="policy-body">
                        <div class="condition-list">
                            <div class="condition-item accepted">
                                <div class="condition-icon">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <div class="condition-content">
                                    <h5>DITERIMA - Pengembalian</h5>
                                    <p>Pengembalian HANYA dapat dilakukan jika:</p>
                                    <ul>
                                        <li>Produk rusak atau cacat produksi</li>
                                        <li>Salah kirim item (berbeda dari pesanan)</li>
                                        <li>Ukuran tidak sesuai dengan yang dipesan</li>
                                        <li>Warna/motif tidak sesuai pesanan</li>
                                    </ul>
                                </div>
                            </div>
                            
                            <div class="condition-item rejected">
                                <div class="condition-icon">
                                    <i class="fas fa-times-circle"></i>
                                </div>
                                <div class="condition-content">
                                    <h5>TIDAK DITERIMA - Pengembalian</h5>
                                    <p>Pengembalian TIDAK dapat dilakukan jika:</p>
                                    <ul>
                                        <li>Pembeli berubah pikiran</li>
                                        <li>Ukuran salah pilih sendiri</li>
                                        <li>Tidak suka warna/motif (yang sudah sesuai deskripsi)</li>
                                        <li>Produk sudah dipakai atau dicuci</li>
                                        <li>Tag/label sudah dilepas</li>
                                        <li>Melewati batas waktu 3x24 jam</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Prosedur -->
                <div class="policy-card" data-aos="fade-up" data-aos-delay="200">
                    <div class="policy-icon">
                        <i class="fas fa-list-ol"></i>
                    </div>
                    <h3 class="policy-title">Prosedur Pengembalian</h3>
                    <div class="policy-body">
                        <div class="steps-container">
                            <div class="step-item">
                                <div class="step-number">1</div>
                                <div class="step-content">
                                    <h5>Hubungi Kami</h5>
                                    <p>Hubungi customer service dalam <strong>3x24 jam</strong> setelah barang diterima</p>
                                    <a href="https://wa.me/6285930433717?text=Halo%2C%20saya%20ingin%20melakukan%20pengembalian" 
                                       target="_blank" 
                                       class="btn-contact">
                                        <i class="fab fa-whatsapp me-2"></i>Chat WhatsApp
                                    </a>
                                </div>
                            </div>
                            
                            <div class="step-item">
                                <div class="step-number">2</div>
                                <div class="step-content">
                                    <h5>Kirim Bukti</h5>
                                    <p>Kirimkan foto/video sebagai bukti:</p>
                                    <ul>
                                        <li>Foto produk yang rusak/cacat</li>
                                        <li>Foto tag/label yang masih menempel</li>
                                        <li>Foto paket saat diterima (jika ada kerusakan)</li>
                                        <li>Video unboxing (sangat membantu)</li>
                                    </ul>
                                </div>
                            </div>
                            
                            <div class="step-item">
                                <div class="step-number">3</div>
                                <div class="step-content">
                                    <h5>Menunggu Verifikasi</h5>
                                    <p>Tim kami akan memverifikasi dalam 1x24 jam dan memberikan solusi:</p>
                                    <ul>
                                        <li><strong>Ganti Baru:</strong> Jika stok tersedia</li>
                                        <li><strong>Refund:</strong> Jika stok habis</li>
                                        <li><strong>Perbaikan:</strong> Untuk cacat minor</li>
                                    </ul>
                                </div>
                            </div>
                            
                            <div class="step-item">
                                <div class="step-number">4</div>
                                <div class="step-content">
                                    <h5>Kirim Kembali</h5>
                                    <p>Setelah disetujui, kirim produk kembali ke alamat kami. <strong>Ongkir ditanggung kami</strong> jika kesalahan dari pihak toko.</p>
                                </div>
                            </div>
                            
                            <div class="step-item">
                                <div class="step-number">5</div>
                                <div class="step-content">
                                    <h5>Proses Selesai</h5>
                                    <p>Setelah produk kami terima:</p>
                                    <ul>
                                        <li><strong>Ganti Baru:</strong> 3-5 hari kerja</li>
                                        <li><strong>Refund:</strong> 3-7 hari kerja ke rekening</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Biaya -->
                <div class="policy-card" data-aos="fade-up" data-aos-delay="300">
                    <div class="policy-icon">
                        <i class="fas fa-money-bill-wave"></i>
                    </div>
                    <h3 class="policy-title">Biaya Pengembalian</h3>
                    <div class="policy-body">
                        <div class="cost-table">
                            <div class="cost-row">
                                <div class="cost-label">
                                    <i class="fas fa-check text-success"></i>
                                    <strong>Kesalahan Toko</strong>
                                </div>
                                <div class="cost-value success">
                                    Gratis (Ditanggung Toko)
                                </div>
                            </div>
                            <div class="cost-row">
                                <div class="cost-label">
                                    <i class="fas fa-times text-danger"></i>
                                    <strong>Kesalahan Pembeli</strong>
                                </div>
                                <div class="cost-value danger">
                                    Ditanggung Pembeli
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- FAQ -->
                <div class="policy-card" data-aos="fade-up" data-aos-delay="400">
                    <div class="policy-icon">
                        <i class="fas fa-question-circle"></i>
                    </div>
                    <h3 class="policy-title">Pertanyaan Umum</h3>
                    <div class="policy-body">
                        <div class="accordion" id="faqAccordion">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                        Apakah bisa tukar ukuran jika salah pilih?
                                    </button>
                                </h2>
                                <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        <strong>Tidak bisa.</strong> Karena produk kami pre-order dan dibuat khusus sesuai pesanan. Pastikan ukuran yang Anda pilih sudah benar sebelum checkout. Kami menyediakan size chart untuk membantu Anda memilih ukuran yang tepat.
                                    </div>
                                </div>
                            </div>
                            
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                        Berapa lama proses refund?
                                    </button>
                                </h2>
                                <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        Setelah produk kami terima dan verifikasi, refund akan diproses dalam <strong>3-7 hari kerja</strong> ke rekening yang Anda daftarkan.
                                    </div>
                                </div>
                            </div>
                            
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                        Apakah bisa komplain jika warna berbeda dari foto?
                                    </button>
                                </h2>
                                <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        <strong>Bisa,</strong> jika perbedaan warna sangat signifikan. Namun perlu diketahui bahwa perbedaan warna ringan (5-10%) karena pencahayaan foto dan layar adalah normal. Untuk kasus ini, kirimkan foto perbandingan dan tim kami akan menilai.
                                    </div>
                                </div>
                            </div>
                            
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                                        Bagaimana jika barang hilang saat pengiriman?
                                    </button>
                                </h2>
                                <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        Semua paket kami diasuransikan. Jika terbukti hilang oleh ekspedisi, kami akan mengirimkan pengganti atau refund 100%. Hubungi kami segera jika status resi tidak update lebih dari 7 hari.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact CTA -->
                <div class="cta-card" data-aos="fade-up" data-aos-delay="500">
                    <div class="cta-content">
                        <div class="cta-icon">
                            <i class="fas fa-comments"></i>
                        </div>
                        <div class="cta-text">
                            <h4>Masih Punya Pertanyaan?</h4>
                            <p>Jangan ragu untuk menghubungi kami. Tim customer service kami siap membantu!</p>
                        </div>
                        <div class="cta-buttons">
                            <a href="https://wa.me/6285930433717" 
                               target="_blank" 
                               class="btn btn-whatsapp">
                                <i class="fab fa-whatsapp me-2"></i>Chat via WhatsApp
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
/* Use same styles as shipping-info page */
:root {
    --primary-color: #8B4513;
    --primary-dark: #6d3410;
    --primary-light: #a0522d;
    --accent-color: #d4a574;
    --light-color: #f8f4ed;
}

.page-header-return {
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
    background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><path d="M50 0L100 50L50 100L0 50Z" fill="%23ffffff" opacity="0.05"/></svg>') repeat;
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

/* Alert Card */
.alert-card {
    background: white;
    border-radius: 15px;
    padding: 30px;
    margin-bottom: 30px;
    display: flex;
    gap: 20px;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
}

.alert-card.important {
    border-left: 5px solid #dc3545;
    background: linear-gradient(135deg, #fff5f5, white);
}

.alert-icon {
    width: 60px;
    height: 60px;
    background: #dc3545;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.alert-icon i {
    font-size: 1.8rem;
    color: white;
}

.alert-content h4 {
    color: #dc3545;
    font-weight: 700;
    margin-bottom: 10px;
}

.alert-content p {
    color: #666;
    margin: 0;
    line-height: 1.6;
}

/* Policy Card */
.policy-card {
    background: white;
    border-radius: 20px;
    padding: 40px;
    margin-bottom: 30px;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
}

.policy-icon {
    width: 70px;
    height: 70px;
    background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
    border-radius: 15px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 25px;
}

.policy-icon i {
    font-size: 2rem;
    color: white;
}

.policy-title {
    font-size: 1.8rem;
    font-weight: 700;
    color: #333;
    margin-bottom: 25px;
}

/* Condition List */
.condition-list {
    display: flex;
    flex-direction: column;
    gap: 25px;
}

.condition-item {
    padding: 25px;
    border-radius: 15px;
    display: flex;
    gap: 20px;
}

.condition-item.accepted {
    background: linear-gradient(135deg, #d4edda, #c3e6cb);
    border: 2px solid #b1dfbb;
}

.condition-item.rejected {
    background: linear-gradient(135deg, #f8d7da, #f5c6cb);
    border: 2px solid #f1b0b7;
}

.condition-icon {
    width: 50px;
    height: 50px;
    background: white;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.condition-item.accepted .condition-icon i {
    color: #28a745;
    font-size: 1.5rem;
}

.condition-item.rejected .condition-icon i {
    color: #dc3545;
    font-size: 1.5rem;
}

.condition-content h5 {
    font-weight: 700;
    margin-bottom: 10px;
}

.condition-item.accepted h5 {
    color: #155724;
}

.condition-item.rejected h5 {
    color: #721c24;
}

.condition-content p {
    margin-bottom: 12px;
}

.condition-content ul {
    margin: 0;
    padding-left: 20px;
}

.condition-content li {
    margin-bottom: 8px;
}

/* Steps */
.steps-container {
    display: flex;
    flex-direction: column;
    gap: 25px;
}

.step-item {
    display: flex;
    gap: 20px;
    padding: 25px;
    background: var(--light-color);
    border-radius: 15px;
    position: relative;
}

.step-number {
    width: 50px;
    height: 50px;
    background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    font-weight: 700;
    flex-shrink: 0;
}

.step-content h5 {
    font-weight: 700;
    color: #333;
    margin-bottom: 10px;
}

.step-content p {
    color: #666;
    margin-bottom: 12px;
}

.step-content ul {
    padding-left: 20px;
    margin: 10px 0;
}

.step-content li {
    margin-bottom: 8px;
    color: #666;
}

.btn-contact {
    display: inline-block;
    background: #25D366;
    color: white;
    padding: 10px 20px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 600;
    margin-top: 10px;
    transition: all 0.3s;
}

.btn-contact:hover {
    background: #128C7E;
    transform: translateY(-2px);
}

/* Cost Table */
.cost-table {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.cost-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px;
    background: var(--light-color);
    border-radius: 12px;
}

.cost-label {
    display: flex;
    align-items: center;
    gap: 12px;
}

.cost-label i {
    font-size: 1.3rem;
}

.cost-value {
    padding: 8px 20px;
    border-radius: 20px;
    font-weight: 700;
}

.cost-value.success {
    background: #28a745;
    color: white;
}

.cost-value.danger {
    background: #dc3545;
    color: white;
}

/* Accordion */
.accordion-item {
    border: none;
    margin-bottom: 15px;
    border-radius: 12px !important;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
}

.accordion-button {
    background: var(--light-color);
    color: #333;
    font-weight: 600;
    padding: 18px 24px;
}

.accordion-button:not(.collapsed) {
    background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
    color: white;
}

.accordion-button:focus {
    box-shadow: none;
}

.accordion-body {
    padding: 20px 24px;
    line-height: 1.8;
}

/* CTA Card */
.cta-card {
    background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
    border-radius: 20px;
    padding: 50px;
    position: relative;
    overflow: hidden;
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
    border: 2px solid #25D366;
    transition: all 0.3s;
}

.btn-whatsapp:hover {
    background: #128C7E;
    border-color: #128C7E;
    transform: translateY(-2px);
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
}

/* Responsive */
@media (max-width: 768px) {
    .page-header-return {
        padding: 100px 0 60px;
    }
    
    .page-title {
        font-size: 2rem;
    }
    
    .policy-card {
        padding: 25px 20px;
    }
    
    .alert-card {
        flex-direction: column;
        text-align: center;
    }
    
    .step-item {
        flex-direction: column;
        text-align: center;
    }
    
    .cost-row {
        flex-direction: column;
        gap: 15px;
        text-align: center;
    }
    
    .cta-content {
        text-align: center;
        justify-content: center;
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