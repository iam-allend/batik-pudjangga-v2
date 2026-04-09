@extends('layouts.app')

@section('title', 'Batik Pudjangga — Future of Heritage')

@section('content')

{{-- ═══════════════════════════════════════════
     HERO — full-screen, no body-wrap
═══════════════════════════════════════════ --}}
<section class="hero">
    <div class="hero-base"></div>

    <div class="batik-canvas" id="batikRings" aria-hidden="true"></div>
    <div id="batikDiamonds" aria-hidden="true" style="position:absolute;inset:0;pointer-events:none;z-index:1;overflow:hidden"></div>

    <div class="hero-panels" aria-hidden="true">
        <div class="hero-panel">
            <img src="{{ asset('assets/img/cowok.png') }}" alt="Batik Pria"
                 onerror="this.closest('.hero-panel').style.background='var(--timber)'">
            <div class="hero-panel-veil"></div>
            <div class="hero-panel-batik"></div>
            <div class="hero-panel-num">01</div>
        </div>
        <div class="hero-panel">
            <img src="{{ asset('assets/img/wanita.png') }}" alt="Batik Wanita"
                 onerror="this.closest('.hero-panel').style.background='var(--timber)'">
            <div class="hero-panel-veil"></div>
            <div class="hero-panel-batik"></div>
            <div class="hero-panel-num">02</div>
        </div>
        <div class="hero-panel">
            <img src="{{ asset('assets/img/onesett.png') }}" alt="One Set"
                 onerror="this.closest('.hero-panel').style.background='var(--timber)'">
            <div class="hero-panel-veil"></div>
            <div class="hero-panel-batik"></div>
            <div class="hero-panel-num">03</div>
        </div>
    </div>

    <div class="hero-left-fade"></div>

    <div class="hero-content">
        <div class="hero-eyebrow">Future of Heritage</div>
        <h1 class="hero-title">
            Sentuhan Seni<br>dalam Setiap<br><em>Helai Kain</em>
        </h1>
        <p class="hero-sub">
            Batik lukis dan tenun karya tangan yang dikerjakan dengan penuh dedikasi.
            Setiap motif adalah mahakarya eksklusif yang tak akan Anda temui di tempat lain.
        </p>
        <div class="hero-actions">
            <a href="{{ route('shop.index') }}" class="btn-gold">
                Belanja Sekarang <span style="font-size:15px;margin-left:4px">→</span>
            </a>
            <a href="{{ route('about') }}" class="btn-ghost">Tentang Kami →</a>
        </div>
    </div>

    <div class="scroll-indicator" aria-hidden="true">
        <div class="scroll-line"></div>
        <span class="scroll-label">Scroll</span>
    </div>
</section>

{{-- ═══════════════════════════════════════════
     MARQUEE — full-width strip
═══════════════════════════════════════════ --}}
<div class="marquee">
    <div class="marquee-track" id="mtrack">
        <div class="marquee-item">Batik Lukis Handmade <span class="marquee-sep"></span></div>
        <div class="marquee-item">Free Ongkir &gt; Rp 900.000 <span class="marquee-sep"></span></div>
        <div class="marquee-item">Warisan Nusantara <span class="marquee-sep"></span></div>
        <div class="marquee-item">100% Pembayaran Aman <span class="marquee-sep"></span></div>
        <div class="marquee-item">Retur 7 Hari <span class="marquee-sep"></span></div>
        <div class="marquee-item">24/7 Customer Service <span class="marquee-sep"></span></div>
        <div class="marquee-item">Batik Lukis Handmade <span class="marquee-sep"></span></div>
        <div class="marquee-item">Free Ongkir &gt; Rp 900.000 <span class="marquee-sep"></span></div>
        <div class="marquee-item">Warisan Nusantara <span class="marquee-sep"></span></div>
        <div class="marquee-item">100% Pembayaran Aman <span class="marquee-sep"></span></div>
        <div class="marquee-item">Retur 7 Hari <span class="marquee-sep"></span></div>
        <div class="marquee-item">24/7 Customer Service <span class="marquee-sep"></span></div>
    </div>
</div>

{{-- ═══════════════════════════════════════════
     ALL BODY CONTENT — constrained via body-wrap
═══════════════════════════════════════════ --}}
<div class="body-wrap">

    {{-- FEATURES --}}
    <section class="features-section">
        <div class="row g-4">
            <div class="col-md-3 col-6 reveal">
                <div class="feature-card text-center">
                    <div class="feature-icon"><i class="fas fa-shipping-fast"></i></div>
                    <h5>Free Ongkir</h5>
                    <p>Untuk order diatas Rp 900.000</p>
                </div>
            </div>
            <div class="col-md-3 col-6 reveal rd1">
                <div class="feature-card text-center">
                    <div class="feature-icon"><i class="fas fa-shield-alt"></i></div>
                    <h5>Keamanan Pembayaran</h5>
                    <p>100% Transaksi Aman</p>
                </div>
            </div>
            <div class="col-md-3 col-6 reveal rd2">
                <div class="feature-card text-center">
                    <div class="feature-icon"><i class="fas fa-undo"></i></div>
                    <h5>Pengembalian Mudah</h5>
                    <p>7 Hari Kebijakan Pengembalian</p>
                </div>
            </div>
            <div class="col-md-3 col-6 reveal rd3">
                <div class="feature-card text-center">
                    <div class="feature-icon"><i class="fas fa-headset"></i></div>
                    <h5>24/7 Support</h5>
                    <p>Dedikasi Customer Service</p>
                </div>
            </div>
        </div>
    </section>

    {{-- NEW ARRIVALS --}}
    @if($newProducts->count() > 0)
    <section style="padding: 56px 0; border-top: 1px solid var(--border);">
        <div class="sec-header reveal">
            <div>
                <p class="sec-tag">Koleksi Terbaru</p>
                <h2 class="sec-title">Produk Terbaru</h2>
            </div>
            <a href="{{ route('shop.new') }}" class="sec-link">Lihat Semua →</a>
        </div>

        <div class="grid-products reveal">
            @foreach($newProducts->take(5) as $product)
            <div class="pcard">
                <div class="pcard-img">
                    <div class="pcard-fill">
                        @if($product->image)
                            <img src="{{ asset('storage/products/'.$product->image) }}" alt="{{ $product->name }}" loading="lazy">
                        @else
                            <img src="{{ asset('assets/img/logo.png') }}" alt="{{ $product->name }}" loading="lazy">
                        @endif
                        <div class="pcard-veil"></div>
                    </div>
                    <div class="pcard-pat"></div>
                    <span class="pcard-badge">Baru</span>
                    <button class="pcard-cta" onclick="addToCart({{ $product->id }})">
                        Tambah ke Keranjang
                    </button>
                </div>
                <div class="pcard-info">
                    <div>
                        <p class="pcard-name">
                            <a href="{{ route('shop.show', $product->slug ?? $product->id) }}"
                               style="color:inherit;text-decoration:none;">{{ $product->name }}</a>
                        </p>
                        <p class="pcard-cat">{{ $product->category->name ?? 'Koleksi' }}</p>
                    </div>
                    <div class="pcard-price">
                        <small>Mulai dari</small>
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>
    @endif

    {{-- SALE PRODUCTS --}}
    @if($saleProducts->count() > 0)
    <section style="padding: 56px 0; border-top: 1px solid var(--border);">
        <div class="sec-header reveal">
            <div>
                <p class="sec-tag" style="color:#e07070">Special Offer</p>
                <h2 class="sec-title">Hot Sale!</h2>
            </div>
            <a href="{{ route('shop.sale') }}" class="sec-link" style="color:#e07070;border-color:rgba(224,112,112,.4)">
                Lihat Semua →
            </a>
        </div>

        <div class="grid-products reveal">
            @foreach($saleProducts->take(5) as $product)
            <div class="pcard">
                <div class="pcard-img">
                    <div class="pcard-fill">
                        @if($product->image)
                            <img src="{{ asset('storage/products/'.$product->image) }}" alt="{{ $product->name }}" loading="lazy">
                        @else
                            <img src="{{ asset('assets/img/logo.png') }}" alt="{{ $product->name }}" loading="lazy">
                        @endif
                        <div class="pcard-veil"></div>
                    </div>
                    <div class="pcard-pat"></div>
                    @if($product->discount_percent)
                        <span class="pcard-badge pcard-badge--sale">-{{ $product->discount_percent }}%</span>
                    @else
                        <span class="pcard-badge pcard-badge--sale">Sale</span>
                    @endif
                    <button class="pcard-cta" onclick="addToCart({{ $product->id }})">
                        Tambah ke Keranjang
                    </button>
                </div>
                <div class="pcard-info">
                    <div>
                        <p class="pcard-name">
                            <a href="{{ route('shop.show', $product->slug ?? $product->id) }}"
                               style="color:inherit;text-decoration:none;">{{ $product->name }}</a>
                        </p>
                        <p class="pcard-cat">{{ $product->category->name ?? 'Koleksi' }}</p>
                    </div>
                    <div class="pcard-price">
                        <small>Harga Diskon</small>
                        Rp {{ number_format($product->sale_price ?? $product->price, 0, ',', '.') }}
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>
    @endif

    {{-- CATEGORIES --}}
    <section class="categories-section" style="border-top: 1px solid var(--border);">
        <div class="sec-header reveal">
            <div>
                <p class="sec-tag">Belanja Berdasarkan Kategori</p>
                <h2 class="sec-title">Koleksi Kami</h2>
            </div>
        </div>

        <div class="row g-3">
            <div class="col-md-3 col-6 reveal">
                <a href="{{ route('shop.men') }}" class="category-card">
                    <div class="category-image">
                        <img src="{{ asset('assets/img/cowok.png') }}" alt="Koleksi Pria"
                             onerror="this.src='{{ asset('assets/img/logo.png') }}'">
                    </div>
                    <div class="category-overlay">
                        <div class="category-pat"></div>
                        <h4>Koleksi Pria</h4>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-6 reveal rd1">
                <a href="{{ route('shop.women') }}" class="category-card">
                    <div class="category-image">
                        <img src="{{ asset('assets/img/wanita.png') }}" alt="Koleksi Wanita"
                             onerror="this.src='{{ asset('assets/img/logo.png') }}'">
                    </div>
                    <div class="category-overlay">
                        <div class="category-pat"></div>
                        <h4>Koleksi Wanita</h4>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-6 reveal rd2">
                <a href="{{ route('shop.pants') }}" class="category-card">
                    <div class="category-image">
                        <img src="{{ asset('assets/img/celanaoi.png') }}" alt="Koleksi Celana"
                             onerror="this.src='{{ asset('assets/img/logo.png') }}'">
                    </div>
                    <div class="category-overlay">
                        <div class="category-pat"></div>
                        <h4>Koleksi Celana</h4>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-6 reveal rd3">
                <a href="{{ route('shop.oneset') }}" class="category-card">
                    <div class="category-image">
                        <img src="{{ asset('assets/img/onesett.png') }}" alt="One Set"
                             onerror="this.src='{{ asset('assets/img/logo.png') }}'">
                    </div>
                    <div class="category-overlay">
                        <div class="category-pat"></div>
                        <h4>One Set</h4>
                    </div>
                </a>
            </div>
        </div>
    </section>

    {{-- ABOUT EDITORIAL --}}
    <section class="about-editorial reveal">
        <div class="editorial-grid">
            <div class="ed-visual">
                <img src="{{ asset('assets/images/about-preview.jpg') }}" alt="Tentang Kami"
                     onerror="this.src='{{ asset('assets/img/logo.png') }}'">
                <div class="ed-visual-veil"></div>
                <div class="ed-batik" aria-hidden="true">
                    <svg viewBox="0 0 500 520" preserveAspectRatio="xMidYMid slice">
                        <defs>
                            <pattern id="kawung" x="0" y="0" width="60" height="60" patternUnits="userSpaceOnUse">
                                <circle cx="30" cy="30" r="16" fill="none" stroke="rgba(196,154,60,1)" stroke-width=".8">
                                    <animate attributeName="r" values="16;18;16" dur="6s" repeatCount="indefinite"/>
                                </circle>
                                <circle cx="30" cy="30" r="9" fill="none" stroke="rgba(196,154,60,1)" stroke-width=".5"/>
                                <circle cx="30" cy="30" r="3" fill="rgba(196,154,60,.8)">
                                    <animate attributeName="r" values="3;4;3" dur="6s" repeatCount="indefinite"/>
                                </circle>
                                <circle cx="0" cy="0" r="3" fill="rgba(196,154,60,.6)"/>
                                <circle cx="60" cy="0" r="3" fill="rgba(196,154,60,.6)"/>
                                <circle cx="0" cy="60" r="3" fill="rgba(196,154,60,.6)"/>
                                <circle cx="60" cy="60" r="3" fill="rgba(196,154,60,.6)"/>
                            </pattern>
                        </defs>
                        <rect width="500" height="520" fill="url(#kawung)"/>
                    </svg>
                </div>
                <div class="ed-label">Tentang Kami</div>
            </div>
            <div class="ed-content">
                <p class="ed-kicker">Seni Batik Lukis &amp; Tenun</p>
                <h2 class="ed-title">Karya yang<br>tak <em>tergantikan</em></h2>
                <blockquote class="ed-quote">
                    "Batik bukan hanya kain — ia adalah jiwa yang menjaga ingatan leluhur tetap hidup."
                </blockquote>
                <p class="ed-body">
                    Batik Pudjangga menghadirkan batik lukis dan tenun handmade yang dikerjakan oleh seniman
                    terampil dengan dedikasi tinggi. Setiap karya menggabungkan teknik tradisional dengan
                    sentuhan desain kontemporer.
                </p>
                <ul class="ed-checklist">
                    <li><i class="fas fa-check-circle me-2"></i>100% Batik Lukis &amp; Tenun Handmade</li>
                    <li><i class="fas fa-check-circle me-2"></i>Karya Seniman Lokal Berpengalaman</li>
                    <li><i class="fas fa-check-circle me-2"></i>Material Premium Berkualitas Tinggi</li>
                    <li><i class="fas fa-check-circle me-2"></i>Desain Eksklusif &amp; Tidak Pasaran</li>
                </ul>
                <a href="{{ route('about') }}" class="btn-gold" style="align-self:flex-start">
                    Kenali Lebih Dekat <span style="font-size:15px;margin-left:4px">→</span>
                </a>
            </div>
        </div>
    </section>

    {{-- NEWSLETTER --}}
    <section class="newsletter-section">
        <div class="newsletter-box reveal">
            <div class="newsletter-batik" aria-hidden="true">
                <svg style="position:absolute;inset:0;width:100%;height:100%" viewBox="0 0 800 200" preserveAspectRatio="xMidYMid slice">
                    <defs>
                        <pattern id="nlp" x="0" y="0" width="50" height="50" patternUnits="userSpaceOnUse">
                            <path d="M0 50 L50 0" stroke="rgba(196,154,60,1)" stroke-width=".6" fill="none"/>
                            <circle cx="0" cy="50" r="2.5" fill="rgba(196,154,60,.5)"/>
                            <circle cx="50" cy="0" r="2.5" fill="rgba(196,154,60,.5)"/>
                            <circle cx="25" cy="25" r="1.5" fill="rgba(196,154,60,.3)"/>
                        </pattern>
                    </defs>
                    <rect width="800" height="200" fill="url(#nlp)"/>
                </svg>
            </div>
            <div class="row align-items-center position-relative" style="z-index:1">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <p class="newsletter-eyebrow">Stay Updated</p>
                    <h3 class="newsletter-title">Subscribe to Our Newsletter</h3>
                    <p class="newsletter-sub">Dapatkan update produk terbaru dan penawaran eksklusif!</p>
                </div>
                <div class="col-lg-6">
                    <form action="{{ route('subscribe') }}" method="POST">
                        @csrf
                        <div class="newsletter-form-group">
                            <input type="email" name="email" placeholder="Masukkan email Anda…" required>
                            <button type="submit">
                                Subscribe <i class="fas fa-paper-plane ms-2"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

</div>{{-- /body-wrap --}}

@endsection

@push('scripts')
<script>
(function(){
    /* ── MARQUEE CLONE ── */
    const mt=document.getElementById('mtrack');
    if(mt){mt.parentElement.appendChild(mt.cloneNode(true));}

    /* ── HERO BATIK RINGS ── */
    const rEl=document.getElementById('batikRings');
    if(rEl){
        const svg=document.createElementNS('http://www.w3.org/2000/svg','svg');
        svg.setAttribute('viewBox','0 0 1600 900');
        svg.style.cssText='position:absolute;inset:0;width:100%;height:100%';
        [[280,580,120,0],[240,540,180,1],[200,500,260,2],[600,700,90,.5],[560,660,150,1.5],[380,400,70,1]].forEach(([cx,cy,r,d])=>{
            const c=document.createElementNS('http://www.w3.org/2000/svg','circle');
            c.setAttribute('cx',cx);c.setAttribute('cy',cy);c.setAttribute('r',r);
            c.setAttribute('fill','none');c.setAttribute('stroke','rgba(196,154,60,0.1)');c.setAttribute('stroke-width','1');
            const a=document.createElementNS('http://www.w3.org/2000/svg','animate');
            a.setAttribute('attributeName','r');a.setAttribute('values',`${r};${r*1.07};${r}`);
            a.setAttribute('dur','7s');a.setAttribute('begin',d+'s');a.setAttribute('repeatCount','indefinite');
            c.appendChild(a);svg.appendChild(c);
        });
        rEl.appendChild(svg);
    }

    /* ── FLOATING DIAMONDS ── */
    const dEl=document.getElementById('batikDiamonds');
    if(dEl){
        [[72,68,52],[200,140,36],[110,290,64],[260,90,44],[48,380,38],[180,340,56]].forEach(([l,t,s],i)=>{
            const d=document.createElement('div');
            d.style.cssText=`position:absolute;left:${l}px;top:${t}px;width:${s}px;height:${s}px;border:1px solid rgba(196,154,60,${.08+i*.015});animation:floatDrift ${9+i*1.5}s ease-in-out ${i*.8}s infinite`;
            const di=document.createElement('div');
            di.style.cssText=`position:absolute;inset:${s*.22}px;border:1px solid rgba(196,154,60,${.05+i*.01})`;
            d.appendChild(di);dEl.appendChild(d);
        });
    }
})();
</script>
@endpush