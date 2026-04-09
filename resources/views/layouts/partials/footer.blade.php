<footer class="pudjangga-footer">

    <!-- Decorative wave top -->
    <div class="footer-wave-top" aria-hidden="true">
        <svg viewBox="0 0 1200 80" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0,40 C200,80 400,0 600,40 C800,80 1000,0 1200,40 L1200,80 L0,80 Z"
                  fill="var(--bark)"/>
        </svg>
    </div>

    <!-- Batik pattern overlay -->
    <div class="footer-batik-bg" aria-hidden="true">
        <svg style="position:absolute;inset:0;width:100%;height:100%;opacity:.05" viewBox="0 0 400 400" preserveAspectRatio="xMidYMid slice">
            <defs>
                <pattern id="fp" x="0" y="0" width="60" height="60" patternUnits="userSpaceOnUse">
                    <circle cx="30" cy="30" r="14" fill="none" stroke="rgba(196,154,60,1)" stroke-width=".8"/>
                    <circle cx="30" cy="30" r="7"  fill="none" stroke="rgba(196,154,60,1)" stroke-width=".5"/>
                    <circle cx="30" cy="30" r="2"  fill="rgba(196,154,60,1)"/>
                    <circle cx="0"  cy="0"  r="2"  fill="rgba(196,154,60,.6)"/>
                    <circle cx="60" cy="0"  r="2"  fill="rgba(196,154,60,.6)"/>
                    <circle cx="0"  cy="60" r="2"  fill="rgba(196,154,60,.6)"/>
                    <circle cx="60" cy="60" r="2"  fill="rgba(196,154,60,.6)"/>
                </pattern>
            </defs>
            <rect width="400" height="400" fill="url(#fp)"/>
        </svg>
    </div>

    <!-- Main Content -->
    <div class="footer-body">
        <div class="container">
            <div class="row g-5">

                <!-- Brand -->
                <div class="col-lg-4 col-md-6">
                    <div class="footer-brand">
                        <img src="{{ asset('assets/img/logo.png') }}" alt="Batik Pudjangga" class="footer-logo">
                        <h4 class="footer-brand-name">Batik Pudj<em>angga</em></h4>
                        <p class="footer-brand-desc">
                            Batik lukis dan tenun karya tangan yang dikerjakan dengan penuh dedikasi. Setiap motif
                            adalah mahakarya eksklusif yang tak akan Anda temui di tempat lain.
                        </p>
                        <div class="footer-social">
                            <a href="https://www.instagram.com/shopfaradisa?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw=="
                               class="footer-social-link" title="Instagram" target="_blank" rel="noopener">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a href="https://wa.me/6285930433717"
                               class="footer-social-link" title="WhatsApp" target="_blank" rel="noopener">
                                <i class="fab fa-whatsapp"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Shop Links -->
                <div class="col-lg-2 col-md-6 col-6">
                    <div class="footer-col">
                        <h5 class="footer-col-title">Belanja</h5>
                        <ul class="footer-link-list">
                            <li><a href="{{ route('shop.men') }}">Koleksi Pria</a></li>
                            <li><a href="{{ route('shop.women') }}">Koleksi Wanita</a></li>
                            <li><a href="{{ route('shop.pants') }}">Pants</a></li>
                            <li><a href="{{ route('shop.oneset') }}">One Set</a></li>
                            <li><a href="{{ route('shop.new') }}">Produk Terbaru</a></li>
                            <li><a href="{{ route('shop.sale') }}">Diskon</a></li>
                        </ul>
                    </div>
                </div>

                <!-- Support Links -->
                <div class="col-lg-2 col-md-6 col-6">
                    <div class="footer-col">
                        <h5 class="footer-col-title">Support</h5>
                        <ul class="footer-link-list">
                            <li><a href="{{ route('about') }}">Tentang Kami</a></li>
                            <li><a href="{{ route('contact') }}">Kontak</a></li>
                            <li><a href="{{ route('shipping.info') }}">Info Pengiriman</a></li>
                            <li><a href="{{ route('return.policy') }}">Kebijakan Retur</a></li>
                            @auth
                                <li><a href="{{ route('orders.index') }}">Lacak Pesanan</a></li>
                                <li><a href="{{ route('profile.index') }}">Akun Saya</a></li>
                            @else
                                <li><a href="{{ route('login') }}">Masuk</a></li>
                            @endauth
                        </ul>
                    </div>
                </div>

                <!-- Contact + Newsletter -->
                <div class="col-lg-4 col-md-6">
                    <div class="footer-col">
                        <h5 class="footer-col-title">Hubungi Kami</h5>

                        <div class="footer-contacts">
                            <div class="footer-contact-row">
                                <div class="footer-contact-icon"><i class="fas fa-map-marker-alt"></i></div>
                                <p>Pekalongan, Jawa Tengah<br>Indonesia 51113</p>
                            </div>
                            <div class="footer-contact-row">
                                <div class="footer-contact-icon"><i class="fas fa-phone-alt"></i></div>
                                <a href="tel:+6285930433717">+62 859 3043 3717</a>
                            </div>
                            <div class="footer-contact-row">
                                <div class="footer-contact-icon"><i class="fas fa-envelope"></i></div>
                                <a href="mailto:faradisaolshop1@gmail.com">faradisaolshop1@gmail.com</a>
                            </div>
                        </div>

                        <!-- Newsletter -->
                        <div class="footer-newsletter">
                            <p class="footer-newsletter-label">
                                <i class="fas fa-bell me-2"></i>Subscribe Newsletter
                            </p>
                            <p class="footer-newsletter-sub">Dapatkan penawaran eksklusif & koleksi terbaru.</p>
                            <form action="{{ route('subscribe') }}" method="POST" class="footer-newsletter-form">
                                @csrf
                                <div class="footer-newsletter-group">
                                    <input type="email" name="email" placeholder="Email Anda…" required>
                                    <button type="submit">
                                        <i class="fas fa-paper-plane"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div><!-- /row -->
        </div>
    </div>

    <!-- Bottom Bar -->
    <div class="footer-bottom">
        <div class="container">
            <div class="footer-bottom-inner">
                <p>&copy; {{ date('Y') }} <strong>Batik Pudjangga</strong>. All rights reserved.</p>
                <p class="footer-bottom-tagline">Future of Heritage</p>
            </div>
        </div>
    </div>

</footer>

<style>
.pudjangga-footer {
    position: relative;
    background: var(--void);
    border-top: 1px solid var(--border);
    margin-top: 100px;
    overflow: hidden;
}

/* Wave top */
.footer-wave-top {
    width: 100%; line-height: 0; margin-bottom: -2px;
    /* The wave fills from above — pointing downward into footer */
}
.footer-wave-top svg { display: block; width: 100%; height: 60px; }

/* Background batik */
.footer-batik-bg { position: absolute; inset: 0; pointer-events: none; z-index: 0; }

/* Body */
.footer-body {
    position: relative; z-index: 1;
    padding: 64px 0 52px;
}

/* Brand */
.footer-brand { padding-right: 20px; }
.footer-logo {
    width: 48px; margin-bottom: 16px;
    filter: brightness(0) invert(1); opacity: .7;
}
.footer-brand-name {
    font-family: 'Playfair Display', serif;
    font-size: 22px; font-weight: 400; margin-bottom: 14px;
    color: var(--parchment);
}
.footer-brand-name em { font-style: italic; color: var(--gold); }
.footer-brand-desc {
    font-family: 'Raleway', sans-serif;
    font-size: 13px; line-height: 1.85;
    color: var(--parchment-dim); margin-bottom: 24px;
}

/* Social */
.footer-social { display: flex; gap: 10px; }
.footer-social-link {
    width: 40px; height: 40px;
    display: flex; align-items: center; justify-content: center;
    border: 1px solid var(--border); border-radius: 1px;
    color: var(--parchment-dim); text-decoration: none;
    font-size: 14px; transition: all .3s;
}
.footer-social-link:hover {
    background: var(--gold); border-color: var(--gold);
    color: var(--void); transform: translateY(-3px);
}

/* Column title */
.footer-col-title {
    font-family: 'Raleway', sans-serif;
    font-size: 9px; font-weight: 600; letter-spacing: .45em;
    text-transform: uppercase; color: var(--gold);
    margin-bottom: 22px; padding-bottom: 14px;
    border-bottom: 1px solid var(--border);
}

/* Links */
.footer-link-list {
    list-style: none; padding: 0; margin: 0;
}
.footer-link-list li { margin-bottom: 11px; }
.footer-link-list a {
    font-family: 'Raleway', sans-serif;
    font-size: 12.5px; color: var(--parchment-dim); text-decoration: none;
    transition: color .25s, padding-left .25s;
    display: block;
}
.footer-link-list a:hover { color: var(--gold); padding-left: 6px; }

/* Contact rows */
.footer-contacts { margin-bottom: 28px; }
.footer-contact-row {
    display: flex; align-items: flex-start; gap: 12px;
    margin-bottom: 14px;
}
.footer-contact-icon {
    width: 32px; height: 32px; flex-shrink: 0;
    display: flex; align-items: center; justify-content: center;
    background: var(--gold-whisper);
    border: 1px solid var(--border); border-radius: 1px;
    color: var(--gold); font-size: 12px;
}
.footer-contact-row p,
.footer-contact-row a {
    font-family: 'Raleway', sans-serif;
    font-size: 12.5px; line-height: 1.7;
    color: var(--parchment-dim); text-decoration: none;
    transition: color .25s; margin: 0; padding-top: 5px;
}
.footer-contact-row a:hover { color: var(--gold); }

/* Newsletter */
.footer-newsletter {
    background: rgba(196,154,60,.05);
    border: 1px solid var(--border);
    padding: 20px; border-radius: 1px;
}
.footer-newsletter-label {
    font-family: 'Raleway', sans-serif;
    font-size: 10px; font-weight: 600; letter-spacing: .3em;
    text-transform: uppercase; color: var(--gold); margin-bottom: 6px;
}
.footer-newsletter-sub {
    font-family: 'Raleway', sans-serif;
    font-size: 11.5px; color: var(--parchment-faint); margin-bottom: 14px;
}
.footer-newsletter-group {
    display: flex; border: 1px solid var(--border); overflow: hidden;
    transition: border-color .25s;
}
.footer-newsletter-group:focus-within { border-color: var(--gold); }
.footer-newsletter-group input {
    flex: 1; background: transparent; border: none; outline: none;
    color: var(--parchment); padding: 10px 14px;
    font-family: 'Raleway', sans-serif; font-size: 12px;
}
.footer-newsletter-group input::placeholder { color: var(--parchment-faint); }
.footer-newsletter-group button {
    background: var(--gold); border: none; cursor: none;
    color: var(--void); padding: 10px 16px; font-size: 13px;
    transition: background .25s;
}
.footer-newsletter-group button:hover { background: var(--gold-bright); }

/* Bottom bar */
.footer-bottom {
    border-top: 1px solid var(--border);
    padding: 20px 0;
    position: relative; z-index: 1;
}
.footer-bottom-inner {
    display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 8px;
}
.footer-bottom-inner p {
    font-family: 'Raleway', sans-serif;
    font-size: 10.5px; letter-spacing: .12em;
    color: var(--parchment-faint); margin: 0;
}
.footer-bottom-inner strong { color: var(--gold); font-weight: 600; }
.footer-bottom-tagline {
    font-family: 'Playfair Display', serif;
    font-style: italic; color: var(--gold-muted) !important;
    font-size: 12px !important;
}

/* Responsive */
@media (max-width: 768px) {
    .pudjangga-footer { margin-top: 60px; }
    .footer-body { padding: 48px 0 36px; }
    .footer-bottom-inner { flex-direction: column; text-align: center; }
}
</style>

<script>
/* Newsletter loading feedback */
(function(){
    const form = document.querySelector('.footer-newsletter-form');
    if(!form) return;
    form.addEventListener('submit', function(){
        const btn = this.querySelector('button');
        btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
        btn.disabled = true;
        setTimeout(() => { btn.innerHTML='<i class="fas fa-paper-plane"></i>'; btn.disabled=false; }, 2200);
    });
})();
</script>