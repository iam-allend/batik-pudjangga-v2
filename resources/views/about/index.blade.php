@extends('layouts.app')

@section('title', 'Tentang Kami — Batik Pudjangga')

@push('styles')
<style>
/* ═══════════════════════════════════════════
   ABOUT PAGE — Batik Pudjangga
   Mengikuti tema: pudjangga.css + shop/home
═══════════════════════════════════════════ */

/* ── PAGE HEADER ── */
.about-page-header {
    position: relative;
    padding: 110px 0 64px;
    overflow: hidden;
    border-bottom: 1px solid var(--border);
}
.aph-bg {
    position: absolute; inset: 0;
    background:
        radial-gradient(ellipse 55% 80% at 15% 60%, rgba(60,44,26,.7) 0%, transparent 65%),
        radial-gradient(ellipse 40% 60% at 80% 30%, rgba(44,31,20,.5) 0%, transparent 60%),
        var(--timber);
}
.aph-tex {
    position: absolute; inset: 0; opacity: .035;
    background-image:
        repeating-linear-gradient(45deg, var(--gold) 0, var(--gold) 1px, transparent 0, transparent 50%),
        repeating-linear-gradient(-45deg, var(--gold) 0, var(--gold) 1px, transparent 0, transparent 50%);
    background-size: 28px 28px;
}
.aph-inner {
    position: relative; z-index: 2;
    display: flex; align-items: flex-end; justify-content: space-between;
    gap: 32px; flex-wrap: wrap;
}
.aph-eyebrow {
    font-family: 'Raleway', sans-serif;
    font-size: 9px; letter-spacing: .52em; color: var(--gold);
    text-transform: uppercase; margin-bottom: 16px;
    display: flex; align-items: center; gap: 14px;
}
.aph-eyebrow::before { content: ''; width: 24px; height: 1px; background: var(--gold); }
.aph-title {
    font-family: 'Playfair Display', serif;
    font-size: clamp(40px, 5.5vw, 72px);
    font-weight: 400; line-height: .92; letter-spacing: -.018em;
    color: var(--parchment);
}
.aph-title em { font-style: italic; color: var(--gold); }
.aph-breadcrumb {
    display: flex; align-items: center; gap: 10px; margin-top: 22px;
}
.aph-breadcrumb a {
    font-family: 'Raleway', sans-serif;
    font-size: 9.5px; letter-spacing: .18em; text-transform: uppercase;
    color: var(--parchment-dim); text-decoration: none; transition: color .25s;
}
.aph-breadcrumb a:hover { color: var(--gold); }
.aph-breadcrumb span { font-size: 9px; color: rgba(196,154,60,.3); }
.aph-breadcrumb .bc-cur {
    font-family: 'Raleway', sans-serif;
    font-size: 9.5px; letter-spacing: .18em; text-transform: uppercase; color: var(--gold);
}
.aph-est {
    text-align: right; flex-shrink: 0;
}
.aph-est-num {
    font-family: 'Playfair Display', serif;
    font-size: 64px; font-weight: 400; color: var(--gold);
    line-height: 1; display: block; letter-spacing: -.02em;
}
.aph-est-label {
    font-family: 'Raleway', sans-serif;
    font-size: 9px; letter-spacing: .28em; text-transform: uppercase;
    color: var(--parchment-faint); margin-top: 4px;
}

/* ── STORY SECTION ── */
.story-section {
    padding: 80px 0;
    border-bottom: 1px solid var(--border);
}
.story-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 0;
    border: 1px solid var(--border);
    border-radius: 2px;
    overflow: hidden;
    min-height: 520px;
}
.story-visual {
    position: relative; overflow: hidden; background: var(--void);
}
.story-visual-inner {
    display: grid;
    grid-template-columns: 1fr 1fr;
    grid-template-rows: 1fr 1fr;
    gap: 3px;
    height: 100%; min-height: 480px;
}
.story-img-wrap {
    position: relative; overflow: hidden; background: var(--timber);
}
.story-img-wrap img {
    position: absolute; inset: 0;
    width: 100%; height: 100%; object-fit: cover;
    filter: brightness(.62) saturate(.8) sepia(.2);
    transition: transform .8s cubic-bezier(.25,.46,.45,.94), filter .4s;
}
.story-img-wrap:hover img {
    transform: scale(1.06);
    filter: brightness(.72) saturate(.9) sepia(.1);
}
.story-img-wrap:first-child {
    grid-row: span 2;
}
.story-img-pat {
    position: absolute; inset: 0; z-index: 1; pointer-events: none; opacity: .08;
    background-image:
        repeating-linear-gradient(45deg, var(--gold) 0, var(--gold) .5px, transparent 0, transparent 50%),
        repeating-linear-gradient(-45deg, var(--gold) 0, var(--gold) .5px, transparent 0, transparent 50%);
    background-size: 18px 18px;
}
.story-img-num {
    position: absolute; bottom: 12px; left: 50%; transform: translateX(-50%); z-index: 2;
    font-family: 'Raleway', sans-serif;
    font-size: 8px; letter-spacing: .38em; color: rgba(196,154,60,.45);
    text-transform: uppercase; white-space: nowrap;
}
.story-content {
    padding: 56px; background: var(--bark);
    border-left: 1px solid var(--border);
    display: flex; flex-direction: column; justify-content: center;
}
.story-kicker {
    font-family: 'Raleway', sans-serif;
    font-size: 9px; letter-spacing: .5em; color: var(--gold);
    text-transform: uppercase; font-weight: 500; margin-bottom: 20px;
    display: flex; align-items: center; gap: 14px;
}
.story-kicker::before { content: ''; width: 22px; height: 1px; background: var(--gold); }
.story-title {
    font-family: 'Playfair Display', serif;
    font-size: clamp(28px, 2.8vw, 40px); font-weight: 400;
    line-height: 1.12; color: var(--parchment); margin-bottom: 22px;
}
.story-title em { font-style: italic; color: var(--gold); }
.story-quote {
    border-left: 2px solid var(--gold); padding-left: 20px;
    font-family: 'Playfair Display', serif;
    font-size: 16px; font-style: italic;
    color: rgba(240,230,204,.55); line-height: 1.7; margin-bottom: 24px;
}
.story-body {
    font-family: 'Raleway', sans-serif;
    font-size: 13px; line-height: 1.92; color: var(--parchment-dim);
    margin-bottom: 16px;
}
.story-year-badge {
    display: inline-flex; align-items: center; gap: 10px;
    background: var(--gold-whisper); border: 1px solid var(--border-strong);
    padding: 8px 18px; font-family: 'Raleway', sans-serif;
    font-size: 9px; letter-spacing: .32em; text-transform: uppercase; color: var(--gold);
    margin-top: 8px;
}

/* ── STATISTICS ── */
.stats-section {
    padding: 72px 0;
    background: var(--bark);
    border-top: 1px solid var(--border);
    border-bottom: 1px solid var(--border);
}
.stats-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 0;
}
.stat-item {
    padding: 36px 28px;
    border-right: 1px solid var(--border);
    text-align: center;
    transition: background .3s;
    position: relative;
}
.stat-item:last-child { border-right: none; }
.stat-item::after {
    content: ''; position: absolute; bottom: 0; left: 50%;
    transform: translateX(-50%);
    width: 0; height: 2px; background: var(--gold);
    transition: width .4s cubic-bezier(.25,.46,.45,.94);
}
.stat-item:hover { background: var(--gold-whisper); }
.stat-item:hover::after { width: 60%; }
.stat-num {
    font-family: 'Playfair Display', serif;
    font-size: clamp(36px, 3.5vw, 52px); font-weight: 400;
    color: var(--gold); display: block; line-height: 1;
    margin-bottom: 10px;
}
.stat-label {
    font-family: 'Raleway', sans-serif;
    font-size: 9.5px; letter-spacing: .3em; text-transform: uppercase;
    color: var(--parchment-dim);
}

/* ── VALUES ── */
.values-section {
    padding: 80px 0;
    border-bottom: 1px solid var(--border);
}
.values-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 14px;
    margin-top: 48px;
}
.value-card {
    background: var(--timber); border: 1px solid var(--border);
    padding: 36px 28px; border-radius: 2px;
    transition: border-color .3s, transform .35s, box-shadow .4s;
    position: relative; overflow: hidden;
}
.value-card::before {
    content: ''; position: absolute;
    top: 0; left: 0; right: 0; height: 2px;
    background: var(--gold); transform: scaleX(0);
    transition: transform .4s cubic-bezier(.25,.46,.45,.94);
}
.value-card:hover {
    border-color: var(--border-strong);
    transform: translateY(-6px);
    box-shadow: 0 16px 48px rgba(0,0,0,.45);
}
.value-card:hover::before { transform: scaleX(1); }
.value-icon {
    width: 56px; height: 56px; margin-bottom: 22px;
    background: var(--gold-whisper); border: 1px solid var(--border);
    display: flex; align-items: center; justify-content: center;
    font-size: 1.3rem; color: var(--gold);
    transition: background .3s;
}
.value-card:hover .value-icon { background: var(--gold-glow); }
.value-title {
    font-family: 'Playfair Display', serif;
    font-size: 18px; font-weight: 400; color: var(--parchment); margin-bottom: 12px;
}
.value-desc {
    font-family: 'Raleway', sans-serif;
    font-size: 12.5px; line-height: 1.85; color: var(--parchment-dim); margin: 0;
}

/* ── WHY CHOOSE US ── */
.why-section {
    padding: 80px 0;
    border-bottom: 1px solid var(--border);
    background: var(--bark);
}
.why-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 3px;
    margin-top: 48px;
    background: rgba(196,154,60,.06);
    border: 1px solid var(--border);
}
.why-item {
    display: flex; align-items: flex-start; gap: 20px;
    padding: 28px 30px;
    background: var(--timber);
    transition: background .3s;
}
.why-item:hover { background: var(--wood); }
.why-check {
    width: 36px; height: 36px; flex-shrink: 0;
    background: var(--gold-whisper); border: 1px solid var(--border-strong);
    display: flex; align-items: center; justify-content: center;
    color: var(--gold); font-size: 13px;
    transition: background .3s;
}
.why-item:hover .why-check { background: var(--gold-glow); }
.why-item-title {
    font-family: 'Playfair Display', serif;
    font-size: 16px; font-weight: 400; color: var(--parchment); margin-bottom: 6px;
}
.why-item-desc {
    font-family: 'Raleway', sans-serif;
    font-size: 12px; line-height: 1.8; color: var(--parchment-dim); margin: 0;
}

/* ── CTA SECTION ── */
.about-cta {
    padding: 80px 0;
    position: relative; overflow: hidden;
    text-align: center;
}
.about-cta-bg {
    position: absolute; inset: 0;
    background:
        radial-gradient(ellipse 60% 80% at 50% 50%, rgba(60,44,26,.55) 0%, transparent 70%),
        var(--timber);
}
.about-cta-tex {
    position: absolute; inset: 0; opacity: .04;
    background-image:
        repeating-linear-gradient(30deg, var(--gold) 0, var(--gold) .5px, transparent 0, transparent 50%),
        repeating-linear-gradient(-30deg, var(--gold) 0, var(--gold) .5px, transparent 0, transparent 50%);
    background-size: 22px 22px;
}
.about-cta-inner { position: relative; z-index: 1; }
.about-cta-eyebrow {
    font-family: 'Raleway', sans-serif;
    font-size: 9px; letter-spacing: .52em; color: var(--gold);
    text-transform: uppercase; margin-bottom: 18px;
    display: flex; align-items: center; justify-content: center; gap: 14px;
}
.about-cta-eyebrow::before,
.about-cta-eyebrow::after { content: ''; width: 32px; height: 1px; background: var(--gold); }
.about-cta-title {
    font-family: 'Playfair Display', serif;
    font-size: clamp(28px, 3.5vw, 46px); font-weight: 400;
    color: var(--parchment); margin-bottom: 16px;
}
.about-cta-title em { font-style: italic; color: var(--gold); }
.about-cta-sub {
    font-family: 'Raleway', sans-serif;
    font-size: 13px; color: var(--parchment-dim); margin-bottom: 36px;
    max-width: 460px; margin-left: auto; margin-right: auto;
    line-height: 1.9;
}
.about-cta-actions {
    display: flex; align-items: center; justify-content: center; gap: 20px; flex-wrap: wrap;
}

/* ── RESPONSIVE ── */
@media (max-width: 1199px) {
    .values-grid { grid-template-columns: repeat(2, 1fr); }
    .stats-grid  { grid-template-columns: repeat(2, 1fr); }
    .stats-grid .stat-item:nth-child(2) { border-right: none; }
    .stats-grid .stat-item:nth-child(3) { border-top: 1px solid var(--border); }
    .stats-grid .stat-item:nth-child(4) { border-top: 1px solid var(--border); border-right: none; }
}
@media (max-width: 991px) {
    .story-grid { grid-template-columns: 1fr; }
    .story-visual-inner { min-height: 300px; }
    .story-content { padding: 40px 32px; border-left: none; border-top: 1px solid var(--border); }
    .aph-est { display: none; }
    .about-page-header { padding: 90px 0 48px; }
}
@media (max-width: 767px) {
    .values-grid { grid-template-columns: 1fr; }
    .why-grid    { grid-template-columns: 1fr; }
    .stats-grid  { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 576px) {
    .stats-grid { grid-template-columns: 1fr; }
    .stats-grid .stat-item { border-right: none; border-bottom: 1px solid var(--border); }
}
</style>
@endpush

@section('content')

{{-- ═══════════════════════════════════════════
     PAGE HEADER
═══════════════════════════════════════════ --}}
<section class="about-page-header">
    <div class="aph-bg"></div>
    <div class="aph-tex"></div>
    <div class="body-wrap">
        <div class="aph-inner">
            <div>
                <div class="aph-eyebrow">Batik Pudjangga</div>
                <h1 class="aph-title">Tentang <em>Kami</em></h1>
                <div class="aph-breadcrumb">
                    <a href="{{ route('home') }}"><i class="fas fa-home" style="font-size:9px;margin-right:5px"></i>Home</a>
                    <span>/</span>
                    <span class="bc-cur">Tentang Kami</span>
                </div>
            </div>
            <div class="aph-est">
                <span class="aph-est-num">2004</span>
                <p class="aph-est-label">Berdiri sejak</p>
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════
     KISAH KAMI — Editorial Split
═══════════════════════════════════════════ --}}
<section class="story-section">
    <div class="body-wrap">
        <div class="story-grid reveal">
            {{-- Visual: mosaic of images --}}
            <div class="story-visual">
                <div class="story-visual-inner">
                    <div class="story-img-wrap">
                        <img src="{{ asset('assets/img/cowok.png') }}" alt="Batik Pria"
                             onerror="this.closest('.story-img-wrap').style.background='var(--wood)'">
                        <div class="story-img-pat"></div>
                        <div class="story-img-num">01</div>
                    </div>
                    <div class="story-img-wrap">
                        <img src="{{ asset('assets/img/wanita.png') }}" alt="Batik Wanita"
                             onerror="this.closest('.story-img-wrap').style.background='var(--wood)'">
                        <div class="story-img-pat"></div>
                        <div class="story-img-num">02</div>
                    </div>
                    <div class="story-img-wrap">
                        <img src="{{ asset('assets/img/onesett.png') }}" alt="One Set"
                             onerror="this.closest('.story-img-wrap').style.background='var(--wood)'">
                        <div class="story-img-pat"></div>
                        <div class="story-img-num">03</div>
                    </div>
                </div>
            </div>

            {{-- Content --}}
            <div class="story-content">
                <p class="story-kicker">Perjalanan Kami</p>
                <h2 class="story-title">Dari Kain Tenun<br>hingga <em>Warisan</em></h2>
                <blockquote class="story-quote">
                    "Batik bukan hanya kain — ia adalah jiwa yang menjaga ingatan leluhur tetap hidup."
                </blockquote>
                <p class="story-body">
                    Berdiri tahun 2004 dengan nama <em style="color:var(--gold);font-family:'Playfair Display',serif">"Djingga Collection"</em>,
                    kami bermula hanya memproduksi kain tenun. Ketika ada kain yang direja, daripada terbuang,
                    kami mengolahnya menjadi pakaian — saat itu khusus untuk pria.
                </p>
                <p class="story-body">
                    Seiring waktu, permintaan datang dari kalangan wanita. Kami menerima tantangan itu, merambah pasar
                    wanita, dan melakukan rebranding menjadi <em style="color:var(--gold);font-family:'Playfair Display',serif">"Pudjangga Batik"</em>
                    — nama yang mencerminkan nuansa klasik, budaya, dan inklusivitas. Hingga kini, kami terus
                    menghadirkan batik berkualitas untuk pria dan wanita.
                </p>
                <div class="story-year-badge">
                    <i class="fas fa-star" style="font-size:9px"></i>
                    Berdiri sejak 2004 · 20+ tahun pengalaman
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════
     STATISTIK
═══════════════════════════════════════════ --}}
<section class="stats-section">
    <div class="body-wrap">
        <div class="stats-grid">
            <div class="stat-item reveal">
                <span class="stat-num">20+</span>
                <p class="stat-label">Tahun Pengalaman</p>
            </div>
            <div class="stat-item reveal rd1">
                <span class="stat-num">30K+</span>
                <p class="stat-label">Pelanggan Puas</p>
            </div>
            <div class="stat-item reveal rd2">
                <span class="stat-num">150+</span>
                <p class="stat-label">Koleksi Batik</p>
            </div>
            <div class="stat-item reveal rd3">
                <span class="stat-num">5</span>
                <p class="stat-label">Mitra Pengrajin</p>
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════
     NILAI-NILAI KAMI
═══════════════════════════════════════════ --}}
<section class="values-section">
    <div class="body-wrap">
        <div class="sec-header reveal">
            <div>
                <p class="sec-tag">Apa yang Kami Pegang</p>
                <h2 class="sec-title">Nilai-Nilai Kami</h2>
            </div>
        </div>

        <div class="values-grid">
            <div class="value-card reveal">
                <div class="value-icon"><i class="fas fa-gem"></i></div>
                <h4 class="value-title">Kualitas Premium</h4>
                <p class="value-desc">
                    Setiap produk dipilih dengan standar kualitas tertinggi — dari pemilihan bahan baku
                    hingga sentuhan akhir proses pembuatan.
                </p>
            </div>
            <div class="value-card reveal rd1">
                <div class="value-icon"><i class="fas fa-hands-helping"></i></div>
                <h4 class="value-title">Pemberdayaan Lokal</h4>
                <p class="value-desc">
                    Kami bermitra langsung dengan pengrajin lokal berpengalaman, mendukung ekosistem
                    ekonomi dan melestarikan tradisi batik Nusantara.
                </p>
            </div>
            <div class="value-card reveal rd2">
                <div class="value-icon"><i class="fas fa-leaf"></i></div>
                <h4 class="value-title">Ramah Lingkungan</h4>
                <p class="value-desc">
                    Menggunakan bahan-bahan alami pilihan dan menerapkan proses produksi
                    yang berkelanjutan demi generasi mendatang.
                </p>
            </div>
            <div class="value-card reveal">
                <div class="value-icon"><i class="fas fa-palette"></i></div>
                <h4 class="value-title">Desain Inovatif</h4>
                <p class="value-desc">
                    Menggabungkan motif batik tradisional dengan estetika kontemporer yang
                    relevan dengan gaya hidup masa kini.
                </p>
            </div>
            <div class="value-card reveal rd1">
                <div class="value-icon"><i class="fas fa-shield-alt"></i></div>
                <h4 class="value-title">Kepercayaan Pelanggan</h4>
                <p class="value-desc">
                    Memberikan pelayanan terbaik di setiap titik perjalanan pelanggan —
                    dari pemilihan produk hingga setelah pembelian.
                </p>
            </div>
            <div class="value-card reveal rd2">
                <div class="value-icon"><i class="fas fa-certificate"></i></div>
                <h4 class="value-title">Keaslian Terjamin</h4>
                <p class="value-desc">
                    Setiap produk adalah batik asli Indonesia dengan keaslian motif dan
                    teknik yang dapat dipertanggungjawabkan.
                </p>
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════
     MENGAPA MEMILIH KAMI
═══════════════════════════════════════════ --}}
<section class="why-section">
    <div class="body-wrap">
        <div class="sec-header reveal">
            <div>
                <p class="sec-tag">Keunggulan Kami</p>
                <h2 class="sec-title">Mengapa Memilih Pudjangga?</h2>
            </div>
        </div>

        <div class="why-grid reveal">
            <div class="why-item">
                <div class="why-check"><i class="fas fa-check"></i></div>
                <div>
                    <p class="why-item-title">Batik Asli Buatan Tangan</p>
                    <p class="why-item-desc">Setiap helai dikerjakan dengan teknik tradisional oleh pengrajin berpengalaman, bukan mesin.</p>
                </div>
            </div>
            <div class="why-item">
                <div class="why-check"><i class="fas fa-check"></i></div>
                <div>
                    <p class="why-item-title">Bahan Berkualitas Premium</p>
                    <p class="why-item-desc">Menggunakan kain katun dan tenun berkualitas tinggi yang nyaman, tahan lama, dan berwarna cemerlang.</p>
                </div>
            </div>
            <div class="why-item">
                <div class="why-check"><i class="fas fa-check"></i></div>
                <div>
                    <p class="why-item-title">Desain Eksklusif</p>
                    <p class="why-item-desc">Koleksi motif unik yang tidak tersedia di tempat lain — setiap karya adalah mahakarya tersendiri.</p>
                </div>
            </div>
            <div class="why-item">
                <div class="why-check"><i class="fas fa-check"></i></div>
                <div>
                    <p class="why-item-title">Harga yang Adil</p>
                    <p class="why-item-desc">Kualitas premium dengan harga yang kompetitif dan transparan tanpa biaya tersembunyi.</p>
                </div>
            </div>
            <div class="why-item">
                <div class="why-check"><i class="fas fa-check"></i></div>
                <div>
                    <p class="why-item-title">Pengiriman Aman ke Seluruh Indonesia</p>
                    <p class="why-item-desc">Produk dikemas dengan cermat dan dikirim dengan jasa ekspedisi terpercaya hingga ke tangan Anda.</p>
                </div>
            </div>
            <div class="why-item">
                <div class="why-check"><i class="fas fa-check"></i></div>
                <div>
                    <p class="why-item-title">Customer Service Responsif</p>
                    <p class="why-item-desc">Tim kami siap membantu Anda 24/7 — dari pertanyaan produk hingga penanganan pengembalian.</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════
     CTA — Shop Now
═══════════════════════════════════════════ --}}
<section class="about-cta">
    <div class="about-cta-bg"></div>
    <div class="about-cta-tex"></div>
    <div class="body-wrap">
        <div class="about-cta-inner reveal">
            <div class="about-cta-eyebrow">Mulai Perjalanan Anda</div>
            <h2 class="about-cta-title">
                Temukan Batik <em>Favorit</em> Anda
            </h2>
            <p class="about-cta-sub">
                Jelajahi koleksi batik lukis dan tenun handmade kami — setiap motif adalah
                cerita yang menunggu untuk dimiliki.
            </p>
            <div class="about-cta-actions">
                <a href="{{ route('shop.index') }}" class="btn-gold">
                    Belanja Sekarang <span style="font-size:15px;margin-left:4px">→</span>
                </a>
                <a href="{{ route('home') }}" class="btn-ghost">Kembali ke Beranda →</a>
            </div>
        </div>
    </div>
</section>

@endsection