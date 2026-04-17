<nav class="pudjangga-nav" id="mainNav">
    <div class="container-fluid px-4 px-lg-5">
        <div class="nav-inner">

            <!-- Brand -->
            <a class="nav-logo" href="{{ route('home') }}">
                <img src="{{ asset('assets/img/logo.png') }}" width="36" alt="Pudjangga" class="nav-logo-img">
                Pudj<span class="nav-logo-accent">angga</span>
            </a>

            <!-- Center Links (desktop) -->
            <ul class="nav-links d-none d-lg-flex">
                <li>
                    <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">
                        Beranda
                    </a>
                </li>
                <li class="nav-dropdown-wrap">
                    <a href="#" class="nav-dropdown-toggle {{ request()->routeIs('shop.*') ? 'active' : '' }}">
                        Belanja
                    </a>
                    <ul class="nav-dropdown" style="margin-top: -20px;">
                        <li><a href="{{ route('shop.index') }}">Semua Produk</a></li>
                        <li class="nav-dropdown-divider"></li>
                        <li><a href="{{ route('shop.men') }}">
                            <i class="fas fa-male me-2"></i>Koleksi Pria
                        </a></li>
                        <li><a href="{{ route('shop.women') }}">
                            <i class="fas fa-female me-2"></i>Koleksi Wanita
                        </a></li>
                        <li><a href="{{ route('shop.pants') }}">
                            <i class="fas fa-tshirt me-2"></i>Pants
                        </a></li>
                        <li><a href="{{ route('shop.oneset') }}">
                            <i class="fas fa-vest me-2"></i>One Set
                        </a></li>
                        <li class="nav-dropdown-divider"></li>
                        <li><a href="{{ route('shop.new') }}">
                            <span class="nav-dd-badge">Baru</span>Produk Terbaru
                        </a></li>
                        <li><a href="{{ route('shop.sale') }}">
                            <span class="nav-dd-badge nav-dd-badge--sale">Sale</span>Diskon
                        </a></li>
                    </ul>
                </li>
                <li>
                    <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">
                        Tentang Kami
                    </a>
                </li>
                <li>
                    <a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'active' : '' }}">
                        Kontak
                    </a>
                </li>
            </ul>

            <!-- Right side -->
            <div class="nav-right">
                <!-- Search -->
                <form action="{{ route('shop.search') }}" method="GET" class="nav-search d-none d-lg-flex">
                    <input type="text" name="q" placeholder="Cari produk…" value="{{ request('q') }}">
                    <button type="submit"><i class="fas fa-search"></i></button>
                </form>

                @auth
                    <!-- Wishlist -->
                    <a href="{{ route('wishlist.index') }}" class="nav-icon-btn" title="Wishlist">
                        <i class="fas fa-heart"></i>
                        @if(auth()->user()->wishlists->count() > 0)
                            <span class="nav-badge">{{ auth()->user()->wishlists->count() }}</span>
                        @endif
                    </a>

                    <!-- Cart -->
                    <a href="{{ route('cart.index') }}" class="nav-icon-btn" title="Keranjang">
                        <i class="fas fa-shopping-bag"></i>
                        <span class="nav-badge" id="cartCount"
                              style="display:{{ auth()->user()->carts->count() > 0 ? 'flex' : 'none' }}">
                            {{ auth()->user()->carts->count() }}
                        </span>
                    </a>

                    <!-- User Dropdown -->
                    <div class="nav-dropdown-wrap">
                        <button class="nav-user-btn">
                            <i class="fas fa-user-circle"></i>
                            <span class="d-none d-xl-inline ms-1">{{ auth()->user()->name }}</span>
                        </button>
                        <ul class="nav-dropdown nav-dropdown--right">
                            <li><a href="{{ route('dashboard') }}">
                                <i class="fas fa-user me-2"></i>Profil Saya
                            </a></li>
                            <li><a href="{{ route('orders.index') }}">
                                <i class="fas fa-shopping-bag me-2"></i>Pesanan Saya
                            </a></li>
                            <li><a href="{{ route('address.index') }}">
                                <i class="fas fa-map-marker-alt me-2"></i>Alamat Saya
                            </a></li>
                            <li class="nav-dropdown-divider"></li>
                            @if(auth()->user()->is_admin)
                                <li><a href="{{ route('admin.dashboard') }}" target="_blank">
                                    <i class="fas fa-cog me-2"></i>Admin Panel
                                </a></li>
                                <li class="nav-dropdown-divider"></li>
                            @endif
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="nav-logout-btn">
                                        <i class="fas fa-sign-out-alt me-2"></i>Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    <a class="nav-cta-outline" href="{{ route('login') }}">Masuk</a>
                    <a class="nav-cta" href="{{ route('register') }}">Daftar</a>
                @endauth

                <!-- Mobile Toggle -->
                <button class="nav-mobile-toggle d-lg-none" id="mobileToggle" aria-label="Menu">
                    <span></span><span></span><span></span>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div class="nav-mobile-menu" id="mobileMenu">
        <div class="nav-mobile-search">
            <form action="{{ route('shop.search') }}" method="GET">
                <input type="text" name="q" placeholder="Cari produk…" value="{{ request('q') }}">
                <button type="submit"><i class="fas fa-search"></i></button>
            </form>
        </div>
        <ul>
            <li><a href="{{ route('home') }}">Beranda</a></li>
            <li><a href="{{ route('shop.index') }}">Semua Produk</a></li>
            <li><a href="{{ route('shop.men') }}">Koleksi Pria</a></li>
            <li><a href="{{ route('shop.women') }}">Koleksi Wanita</a></li>
            <li><a href="{{ route('shop.pants') }}">Pants</a></li>
            <li><a href="{{ route('shop.oneset') }}">One Set</a></li>
            <li><a href="{{ route('shop.new') }}">Produk Terbaru</a></li>
            <li><a href="{{ route('shop.sale') }}">Sale</a></li>
            <li><a href="{{ route('about') }}">Tentang Kami</a></li>
            <li><a href="{{ route('contact') }}">Kontak</a></li>
        </ul>
        @auth
            <div class="nav-mobile-actions">
                <a href="{{ route('dashboard') }}" class="nav-cta-outline">Profil</a>
                <a href="{{ route('cart.index') }}" class="nav-cta">Keranjang</a>
            </div>
        @else
            <div class="nav-mobile-actions">
                <a href="{{ route('login') }}"    class="nav-cta-outline">Masuk</a>
                <a href="{{ route('register') }}" class="nav-cta">Daftar</a>
            </div>
        @endauth
    </div>
</nav>

<style>
/* ── NAV SHELL ── */
.pudjangga-nav {
    position: fixed; top: 0; left: 0; right: 0; z-index: 500;
    background: linear-gradient(to bottom, rgba(16,13,8,.97) 0%, rgba(16,13,8,.82) 100%);
    backdrop-filter: blur(14px);
    border-bottom: 1px solid var(--border);
    transition: background .4s;
}
.pudjangga-nav.scrolled {
    background: rgba(16,13,8,.98);
}
.nav-inner {
    display: flex; align-items: center;
    justify-content: space-between;
    height: 70px;
}

/* ── LOGO ── */
.nav-logo {
    font-family: 'Playfair Display', serif;
    font-size: 20px; font-weight: 400; letter-spacing: .06em;
    color: var(--parchment); text-decoration: none;
    display: flex; align-items: center; gap: 8px;
    transition: color .3s;
}
.nav-logo:hover { color: var(--gold); }
.nav-logo-img {
    filter: brightness(0) invert(1);
    opacity: .85;
    transition: opacity .3s;
}
.nav-logo:hover .nav-logo-img { opacity: 1; }
.nav-logo-accent { color: var(--gold); font-style: italic; }

/* ── CENTER LINKS ── */
.nav-links {
    list-style: none; margin: 0; padding: 0;
    display: flex; gap: 40px; align-items: center;
}
.nav-links > li { position: relative; }
.nav-links a {
    font-family: 'Raleway', sans-serif;
    font-size: 10.5px; font-weight: 400;
    letter-spacing: .22em; text-transform: uppercase;
    color: var(--parchment-dim); text-decoration: none;
    transition: color .3s;
    position: relative;
}
.nav-links a::after {
    content: ''; position: absolute; left: 0; bottom: -3px;
    width: 0; height: 1px; background: var(--gold);
    transition: width .35s cubic-bezier(.76,0,.24,1);
}
.nav-links a:hover,
.nav-links a.active { color: var(--gold); }
.nav-links a:hover::after,
.nav-links a.active::after { width: 100%; }

/* ── DROPDOWN ── */
.nav-dropdown-wrap { position: relative; }
.nav-dropdown-toggle { cursor: pointer; }
.nav-dropdown {
    position: absolute; top: calc(100% + 18px); left: 50%;
    transform: translateX(-50%) translateY(8px);
    background: var(--timber);
    border: 1px solid var(--border);
    border-radius: 2px;
    min-width: 200px;
    list-style: none; padding: 8px 0; margin: 0;
    opacity: 0; pointer-events: none;
    transition: opacity .25s, transform .25s;
    box-shadow: 0 16px 48px rgba(0,0,0,.5);
}
.nav-dropdown--right { left: auto; right: 0; transform: translateX(0) translateY(8px); }
.nav-dropdown-wrap:hover .nav-dropdown,
.nav-dropdown-wrap:focus-within .nav-dropdown {
    opacity: 1; pointer-events: all; transform: translateX(-50%) translateY(0);
}
.nav-dropdown--right:is(.nav-dropdown-wrap:hover .nav-dropdown),
.nav-dropdown--right:is(.nav-dropdown-wrap:focus-within .nav-dropdown) {
    transform: translateX(0) translateY(0);
}
.nav-dropdown li a,
.nav-logout-btn {
    display: block; padding: 10px 20px;
    font-family: 'Raleway', sans-serif;
    font-size: 11.5px; font-weight: 400; letter-spacing: .08em;
    color: var(--parchment-dim); text-decoration: none;
    transition: color .25s, padding-left .25s;
    background: none; border: none; width: 100%; text-align: left; cursor: none;
}
.nav-dropdown li a:hover,
.nav-logout-btn:hover {
    color: var(--gold); padding-left: 26px;
}
.nav-logout-btn { color: #e07070; }
.nav-logout-btn:hover { color: #ff8080; padding-left: 26px; }
.nav-dropdown-divider {
    height: 1px; background: var(--border); margin: 6px 0;
}
.nav-dd-badge {
    display: inline-block; margin-right: 8px;
    font-size: 7px; letter-spacing: .2em; text-transform: uppercase;
    font-weight: 700; padding: 2px 6px; border-radius: 1px;
    background: var(--gold); color: var(--void);
}
.nav-dd-badge--sale { background: var(--rust); color: var(--parchment); }

/* ── SEARCH ── */
.nav-search {
    display: flex; align-items: center;
    border: 1px solid var(--border); border-radius: 1px;
    overflow: hidden; transition: border-color .25s;
}
.nav-search:focus-within { border-color: var(--gold); }
.nav-search input {
    background: transparent; border: none; outline: none;
    color: var(--parchment); padding: 7px 12px;
    font-family: 'Raleway', sans-serif; font-size: 11px;
    width: 160px; transition: width .3s;
}
.nav-search input::placeholder { color: var(--parchment-faint); }
.nav-search input:focus { width: 200px; }
.nav-search button {
    background: var(--gold-whisper); border: none;
    color: var(--parchment-dim); padding: 7px 12px; cursor: none;
    transition: background .25s, color .25s;
}
.nav-search button:hover { background: var(--gold); color: var(--void); }

/* ── RIGHT ICONS ── */
.nav-right { display: flex; align-items: center; gap: 14px; }
.nav-icon-btn {
    position: relative; color: var(--parchment-dim);
    font-size: 15px; text-decoration: none;
    transition: color .25s;
}
.nav-icon-btn:hover { color: var(--gold); }
.nav-badge {
    position: absolute; top: -7px; right: -9px;
    background: var(--gold); color: var(--void);
    width: 16px; height: 16px; border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-size: 8px; font-weight: 700; font-family: 'Raleway', sans-serif;
}
.nav-user-btn {
    background: none; border: 1px solid var(--border);
    color: var(--parchment-dim); padding: 6px 14px;
    font-family: 'Raleway', sans-serif; font-size: 11px;
    letter-spacing: .1em; border-radius: 1px; cursor: none;
    transition: border-color .25s, color .25s;
}
.nav-user-btn:hover { border-color: var(--gold); color: var(--gold); }
.nav-cta {
    font-family: 'Raleway', sans-serif;
    font-size: 9.5px; font-weight: 600; letter-spacing: .22em; text-transform: uppercase;
    background: var(--gold); color: var(--void);
    padding: 9px 20px; text-decoration: none; border-radius: 1px;
    transition: background .25s, transform .2s;
}
.nav-cta:hover { background: var(--gold-bright); transform: translateY(-1px); color: var(--void); }
.nav-cta-outline {
    font-family: 'Raleway', sans-serif;
    font-size: 9.5px; font-weight: 500; letter-spacing: .22em; text-transform: uppercase;
    color: var(--parchment-dim); border: 1px solid var(--border);
    padding: 8px 18px; text-decoration: none; border-radius: 1px;
    transition: border-color .25s, color .25s;
}
.nav-cta-outline:hover { border-color: var(--gold); color: var(--gold); }

/* ── MOBILE TOGGLE ── */
.nav-mobile-toggle {
    background: none; border: none; cursor: none;
    display: flex; flex-direction: column; gap: 5px; padding: 4px;
}
.nav-mobile-toggle span {
    display: block; width: 22px; height: 1.5px;
    background: var(--parchment-dim);
    transition: all .3s;
}
.nav-mobile-toggle.open span:nth-child(1) { transform: rotate(45deg) translate(4.5px, 4.5px); }
.nav-mobile-toggle.open span:nth-child(2) { opacity: 0; }
.nav-mobile-toggle.open span:nth-child(3) { transform: rotate(-45deg) translate(4.5px,-4.5px); }

/* ── MOBILE MENU ── */
.nav-mobile-menu {
    display: none; background: var(--bark);
    border-top: 1px solid var(--border);
    padding: 20px 0;
}
.nav-mobile-menu.open { display: block; }
.nav-mobile-menu ul { list-style: none; padding: 0; margin: 0 0 12px; }
.nav-mobile-menu ul li a {
    display: block; padding: 11px 24px;
    font-family: 'Raleway', sans-serif;
    font-size: 12px; letter-spacing: .14em; text-transform: uppercase;
    color: var(--parchment-dim); text-decoration: none;
    border-bottom: 1px solid var(--border);
    transition: color .25s, padding-left .25s;
}
.nav-mobile-menu ul li a:hover { color: var(--gold); padding-left: 32px; }
.nav-mobile-search {
    padding: 12px 20px; border-bottom: 1px solid var(--border); margin-bottom: 8px;
}
.nav-mobile-search form {
    display: flex; border: 1px solid var(--border); overflow: hidden;
}
.nav-mobile-search input {
    flex: 1; background: transparent; border: none; outline: none;
    color: var(--parchment); padding: 8px 12px;
    font-family: 'Raleway', sans-serif; font-size: 12px;
}
.nav-mobile-search input::placeholder { color: var(--parchment-faint); }
.nav-mobile-search button {
    background: var(--gold-whisper); border: none;
    color: var(--parchment-dim); padding: 8px 14px; cursor: pointer;
}
.nav-mobile-actions {
    display: flex; gap: 10px; padding: 14px 20px;
}
.nav-mobile-actions .nav-cta,
.nav-mobile-actions .nav-cta-outline { flex: 1; text-align: center; }
</style>

<script>
(function(){
    /* Scrolled class */
    const nav = document.getElementById('mainNav');
    window.addEventListener('scroll', () => {
        nav.classList.toggle('scrolled', window.scrollY > 40);
    });

    /* Mobile toggle */
    const toggle = document.getElementById('mobileToggle');
    const menu   = document.getElementById('mobileMenu');
    if(toggle && menu){
        toggle.addEventListener('click', () => {
            toggle.classList.toggle('open');
            menu.classList.toggle('open');
        });
    }
})();
</script>