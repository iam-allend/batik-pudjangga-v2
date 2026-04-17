@extends('layouts.app')

@section('title', 'Shop All Products — Batik Pudjangga')

@push('styles')
<style>
/* ═══════════════════════════════════════════
   TOKENS (overrides/extensions — root already set in pudjangga.css)
═══════════════════════════════════════════ */
:root{
  --red-sale:#B84040;
}

/* ═══════════════════════════════════════════
   PAGE HEADER
═══════════════════════════════════════════ */
.page-header{
  position:relative;padding:100px 52px 52px;
  overflow:hidden;border-bottom:1px solid var(--border);
}
.ph-bg{
  position:absolute;inset:0;
  background:radial-gradient(ellipse 60% 100% at 20% 50%,rgba(60,40,8,.6) 0%,transparent 70%),var(--timber);
}
.ph-tex{
  position:absolute;inset:0;opacity:.03;
  background-image:
    repeating-linear-gradient(45deg,var(--gold) 0,var(--gold) 1px,transparent 0,transparent 50%),
    repeating-linear-gradient(-45deg,var(--gold) 0,var(--gold) 1px,transparent 0,transparent 50%);
  background-size:32px 32px;
}
.ph-inner{position:relative;z-index:2;display:flex;align-items:flex-end;justify-content:space-between;gap:32px;flex-wrap:wrap}
.ph-eyebrow{font-size:9px;letter-spacing:.5em;color:var(--gold);text-transform:uppercase;margin-bottom:14px;display:flex;align-items:center;gap:12px}
.ph-eyebrow::before{content:'';width:22px;height:1px;background:var(--gold)}
.ph-title{font-family:'Cormorant Garamond',serif;font-size:clamp(38px,5vw,64px);font-weight:300;line-height:.92;letter-spacing:-.018em;color:var(--cream)}
.ph-title em{font-style:italic;color:var(--gold-lt)}
.ph-breadcrumb{display:flex;align-items:center;gap:10px;margin-top:20px}
.ph-breadcrumb a{font-size:9.5px;letter-spacing:.18em;text-transform:uppercase;color:var(--cream-dim);transition:color .3s}
.ph-breadcrumb a:hover{color:var(--gold)}
.ph-breadcrumb span{font-size:9px;color:rgba(196,154,60,.3)}
.ph-breadcrumb .bc-cur{font-size:9.5px;letter-spacing:.18em;text-transform:uppercase;color:var(--gold)}
.ph-right{text-align:right}
.ph-count-num{font-family:'Cormorant Garamond',serif;font-size:52px;font-weight:300;color:var(--gold);line-height:1;display:block}
.ph-count-label{font-size:9.5px;letter-spacing:.22em;text-transform:uppercase;color:var(--cream-dim);margin-top:4px}

/* ═══════════════════════════════════════════
   SHOP LAYOUT
═══════════════════════════════════════════ */
.shop-layout{display:grid;grid-template-columns:272px 1fr;min-height:calc(100vh - 200px)}

/* ═══════════════════════════════════════════
   SIDEBAR
═══════════════════════════════════════════ */
.sidebar{
  background:var(--timber);border-right:1px solid var(--border);
  position:sticky;top:65px;height:calc(100vh - 65px);
  overflow-y:auto;display:flex;flex-direction:column;
  scrollbar-width:thin;scrollbar-color:rgba(196,154,60,.15) transparent;
}
.sidebar::-webkit-scrollbar{width:3px}
.sidebar::-webkit-scrollbar-thumb{background:rgba(196,154,60,.2)}

.sb-head{padding:28px 28px 22px;border-bottom:1px solid var(--border)}
.sb-head-row{display:flex;align-items:center;justify-content:space-between}
.sb-title{font-family:'Cormorant Garamond',serif;font-size:20px;font-weight:300;color:var(--cream);display:flex;align-items:center;gap:10px}
.sb-title i{font-size:13px;color:var(--gold)}
.sb-clear{font-size:9px;letter-spacing:.26em;text-transform:uppercase;color:rgba(196,154,60,.5);background:none;border:none;cursor:pointer;transition:color .3s;font-family:'Raleway',sans-serif}
.sb-clear:hover{color:var(--gold)}

.sb-section{padding:22px 28px;border-bottom:1px solid var(--border)}
.sb-section:last-child{border-bottom:none}
.sb-sec-title{font-size:8.5px;letter-spacing:.45em;text-transform:uppercase;color:var(--gold);margin-bottom:16px;display:flex;align-items:center;gap:9px}
.sb-sec-title i{font-size:10px;opacity:.8}

/* filter options */
.sb-opts{display:flex;flex-direction:column;gap:4px}
.sb-opt{
  display:flex;align-items:center;justify-content:space-between;
  padding:9px 12px;
  background:transparent;border:1px solid transparent;
  cursor:pointer;transition:all .22s;position:relative;
}
.sb-opt:hover{background:rgba(196,154,60,.06);border-color:rgba(196,154,60,.18)}
.sb-opt.is-active{background:rgba(196,154,60,.1);border-color:rgba(196,154,60,.3)}
.sb-opt input{position:absolute;opacity:0;pointer-events:none}
.sb-opt-label{display:flex;align-items:center;gap:9px;font-size:11.5px;color:var(--cream-dim);letter-spacing:.03em;transition:color .22s}
.sb-opt-label i{font-size:10px;width:13px;text-align:center;opacity:.7;color:var(--cream-dim)}
.sb-opt.is-active .sb-opt-label{color:var(--cream)}
.sb-opt-label .icon-active{display:none}
.sb-opt.is-active .icon-active{display:inline}
.sb-opt.is-active .icon-inactive{display:none}
.sb-opt-count{font-size:9px;color:rgba(196,154,60,.5);letter-spacing:.04em;min-width:20px;text-align:right}
.sb-opt.is-active .sb-opt-count{color:var(--gold)}
.sb-opt.is-active::before{content:'';position:absolute;left:0;top:50%;transform:translateY(-50%);width:2px;height:60%;background:var(--gold)}

/* select */
.sb-select-wrap{position:relative}
.sb-select{
  width:100%;background:rgba(255,255,255,.03);border:1px solid rgba(196,154,60,.2);
  color:var(--cream);padding:10px 36px 10px 12px;
  font-size:11.5px;font-family:'Raleway',sans-serif;font-weight:300;letter-spacing:.04em;
  outline:none;appearance:none;cursor:pointer;transition:border-color .25s;
}
.sb-select:focus{border-color:rgba(196,154,60,.45)}
.sb-select option{background:var(--timber);color:var(--cream)}
.sb-select-ico{position:absolute;right:12px;top:50%;transform:translateY(-50%);font-size:9px;color:rgba(196,154,60,.5);pointer-events:none}

/* price range */
.price-boxes{display:flex;gap:4px;align-items:center}
.price-box{flex:1;background:rgba(255,255,255,.03);border:1px solid rgba(196,154,60,.2);padding:8px 10px;font-size:10px;font-family:'Raleway',sans-serif;color:var(--cream);letter-spacing:.03em;outline:none;cursor:pointer}
.price-box:focus{border-color:rgba(196,154,60,.45)}
.price-box::placeholder{color:rgba(201,185,158,.3)}
.price-sep{font-size:10px;color:rgba(196,154,60,.4)}

.sb-apply{
  width:100%;margin-top:12px;padding:10px;
  background:transparent;border:1px solid rgba(196,154,60,.3);
  font-size:9px;letter-spacing:.32em;text-transform:uppercase;color:var(--cream-dim);
  cursor:pointer;transition:all .25s;font-family:'Raleway',sans-serif;
}
.sb-apply:hover{background:var(--gold-pale);border-color:rgba(196,154,60,.5);color:var(--gold)}

/* ═══════════════════════════════════════════
   MAIN PRODUCTS AREA
═══════════════════════════════════════════ */
.shop-main{padding:32px 44px 64px;min-width:0}

/* toolbar */
.toolbar{
  display:flex;align-items:center;justify-content:space-between;
  margin-bottom:28px;padding-bottom:20px;border-bottom:1px solid var(--border);
  gap:16px;flex-wrap:wrap;
}
.toolbar-left{display:flex;align-items:center;gap:20px;flex-wrap:wrap}
.toolbar-count{font-family:'Cormorant Garamond',serif;font-size:18px;font-weight:300;color:var(--cream-dim)}
.toolbar-count strong{color:var(--gold);font-weight:300}

/* chips */
.chips{display:flex;gap:6px;flex-wrap:wrap}
.chip{
  display:inline-flex;align-items:center;gap:7px;
  background:rgba(196,154,60,.08);border:1px solid rgba(196,154,60,.22);
  padding:4px 10px;font-size:9px;letter-spacing:.18em;text-transform:uppercase;color:var(--gold);
  cursor:pointer;transition:all .22s;
}
.chip:hover{background:rgba(196,154,60,.15)}
.chip-x{opacity:.55;font-size:9px;transition:opacity .2s}
.chip:hover .chip-x{opacity:1}

.toolbar-right{display:flex;align-items:center;gap:12px}
.sort-wrap{position:relative}
.sort-sel{
  background:rgba(255,255,255,.03);border:1px solid rgba(196,154,60,.2);
  color:var(--cream);padding:8px 30px 8px 14px;
  font-size:10px;letter-spacing:.15em;font-family:'Raleway',sans-serif;
  outline:none;appearance:none;cursor:pointer;transition:border-color .25s;
}
.sort-sel:focus{border-color:rgba(196,154,60,.45)}
.sort-sel option{background:var(--timber);color:var(--cream)}
.sort-ico{position:absolute;right:10px;top:50%;transform:translateY(-50%);font-size:8px;color:rgba(196,154,60,.5);pointer-events:none}

.view-btns{display:flex;gap:2px}
.vbtn{
  width:32px;height:32px;border:1px solid rgba(196,154,60,.18);
  background:transparent;display:flex;align-items:center;justify-content:center;
  cursor:pointer;transition:all .22s;color:var(--cream-dim);
}
.vbtn:hover,.vbtn.is-active{border-color:rgba(196,154,60,.4);color:var(--gold);background:rgba(196,154,60,.07)}

/* ═══════════════════════════════════════════
   PRODUCT GRID
═══════════════════════════════════════════ */
.prod-grid{
  display:grid;gap:2px;
  grid-template-columns:repeat(3,1fr);
  background:rgba(196,154,60,.07);
}
.prod-grid.cols-2{grid-template-columns:repeat(2,1fr)}
.prod-grid.cols-4{grid-template-columns:repeat(4,1fr)}

.pcard{background:var(--timber);display:flex;flex-direction:column;position:relative;overflow:hidden}
.pcard-img-wrap{position:relative;overflow:hidden;padding-bottom:125%}
.pcard-img-inner{position:absolute;inset:0}
.pcard-img-inner img{
  width:100%;height:100%;object-fit:cover;object-position:top center;
  filter:brightness(.76) saturate(.85) contrast(1.05);
  transition:transform .75s cubic-bezier(.25,.46,.45,.94),filter .4s;
}
.pcard:hover .pcard-img-inner img{transform:scale(1.055);filter:brightness(.82) saturate(.9) contrast(1.05)}
.pcard-veil{position:absolute;inset:0;background:linear-gradient(to top,rgba(12,11,9,.7) 0%,rgba(12,11,9,.1) 55%,transparent 100%)}
.pcard-tex{
  position:absolute;inset:0;pointer-events:none;opacity:.055;
  background-image:repeating-linear-gradient(30deg,var(--gold) 0,var(--gold) .5px,transparent 0,transparent 50%),
                   repeating-linear-gradient(-30deg,var(--gold) 0,var(--gold) .5px,transparent 0,transparent 50%);
  background-size:20px 20px;
}

/* badges */
.pcard-badge{
  position:absolute;top:14px;left:14px;z-index:3;
  font-size:7.5px;letter-spacing:.32em;text-transform:uppercase;font-family:'Raleway',sans-serif;
  padding:5px 11px;
}
.badge-new{background:var(--gold);color:var(--ink)}
.badge-sale{background:var(--red-sale);color:#fff}
.badge-exc{background:rgba(12,11,9,.7);color:var(--gold);border:1px solid rgba(196,154,60,.4)}
.badge-hot{background:#8B4513;color:#fff}

/* wishlist */
.pcard-wish{
  position:absolute;top:12px;right:12px;z-index:3;
  width:30px;height:30px;border:1px solid rgba(196,154,60,.25);
  background:rgba(12,11,9,.5);
  display:flex;align-items:center;justify-content:center;
  cursor:pointer;transition:all .25s;opacity:0;
}
.pcard:hover .pcard-wish{opacity:1}
.pcard-wish:hover{background:rgba(196,154,60,.15);border-color:rgba(196,154,60,.5)}
.pcard-wish i{font-size:11px;color:var(--cream-dim);transition:color .2s}
.pcard-wish:hover i{color:var(--gold)}
.pcard-wish.wishlisted i{color:var(--gold)}
.pcard-wish.wishlisted{opacity:1;background:rgba(196,154,60,.12);border-color:rgba(196,154,60,.4)}

/* hover CTA */
.pcard-cta-wrap{
  position:absolute;bottom:0;left:0;right:0;z-index:3;
  transform:translateY(100%);opacity:0;
  transition:transform .35s cubic-bezier(.25,.46,.45,.94),opacity .3s;
}
.pcard:hover .pcard-cta-wrap{transform:translateY(0);opacity:1}
.pcard-cta-shop{
  width:100%;padding:12px;background:var(--gold);color:var(--ink);
  font-size:8.5px;letter-spacing:.3em;text-transform:uppercase;font-family:'Raleway',sans-serif;
  border:none;cursor:pointer;transition:background .25s;font-weight:400;
}
.pcard-cta-shop:hover{background:var(--gold-lt)}

/* info */
.pcard-info{
  padding:16px 18px;border-top:1px solid rgba(196,154,60,.1);
  display:flex;justify-content:space-between;align-items:flex-end;
  gap:8px;flex-wrap:wrap;
}
.pcard-name{font-family:'Cormorant Garamond',serif;font-size:16px;font-weight:400;color:var(--cream);margin-bottom:2px;line-height:1.25;transition:color .25s}
.pcard:hover .pcard-name{color:var(--gold-lt)}
.pcard-cat{font-size:8px;letter-spacing:.28em;text-transform:uppercase;color:rgba(196,154,60,.6)}
.pcard-price{text-align:right;flex-shrink:0}
.pcard-price .old{font-size:11px;color:rgba(201,185,158,.35);text-decoration:line-through;display:block;margin-bottom:1px;font-family:'Raleway',sans-serif}
.pcard-price .current{font-family:'Cormorant Garamond',serif;font-size:18px;font-weight:300;color:var(--cream-dim)}
.pcard-price .price-label{font-size:7.5px;letter-spacing:.2em;text-transform:uppercase;color:rgba(196,154,60,.5);display:block;margin-bottom:1px;font-family:'Raleway',sans-serif}

/* ═══════════════════════════════════════════
   EMPTY STATE
═══════════════════════════════════════════ */
.empty{
  grid-column:1/-1;padding:80px 32px;text-align:center;
  background:var(--timber);border:1px solid var(--border);
}
.empty-ico{width:72px;height:72px;border:1px solid rgba(196,154,60,.2);display:flex;align-items:center;justify-content:center;margin:0 auto 24px;color:rgba(196,154,60,.4);font-size:24px}
.empty-title{font-family:'Cormorant Garamond',serif;font-size:28px;font-weight:300;color:var(--cream);margin-bottom:12px}
.empty-text{font-size:12.5px;color:var(--cream-dim);line-height:1.9;margin-bottom:28px}
.btn-ghost-gold{display:inline-flex;align-items:center;gap:10px;padding:11px 28px;border:1px solid rgba(196,154,60,.4);font-size:9px;letter-spacing:.3em;text-transform:uppercase;color:var(--gold);cursor:pointer;transition:all .3s;font-family:'Raleway',sans-serif;background:transparent}
.btn-ghost-gold:hover{background:rgba(196,154,60,.1);border-color:rgba(196,154,60,.6)}

/* ═══════════════════════════════════════════
   PAGINATION
═══════════════════════════════════════════ */
.pager{
  display:flex;align-items:center;justify-content:space-between;
  margin-top:48px;padding-top:28px;border-top:1px solid var(--border);
  flex-wrap:wrap;gap:16px;
}
.pager-info{font-size:10.5px;color:var(--cream-dim);letter-spacing:.08em}
.pager-info strong{color:var(--gold);font-weight:400}
.pager-btns{display:flex;gap:2px}
.pager-btn{
  min-width:38px;height:38px;padding:0 8px;
  display:flex;align-items:center;justify-content:center;
  border:1px solid rgba(196,154,60,.15);background:var(--timber);
  font-size:11px;color:var(--cream-dim);cursor:pointer;
  transition:all .22s;font-family:'Raleway',sans-serif;letter-spacing:.04em;
}
.pager-btn:hover{border-color:rgba(196,154,60,.4);color:var(--gold);background:rgba(196,154,60,.07)}
.pager-btn.is-active{background:var(--gold);color:var(--ink);border-color:var(--gold);font-weight:500}
.pager-btn:disabled,.pager-btn.disabled{opacity:.3;pointer-events:none}
.pager-btn i{font-size:9px}
.pager-dots{display:flex;align-items:center;padding:0 4px;color:rgba(196,154,60,.35);font-size:13px;letter-spacing:.1em}

/* ═══════════════════════════════════════════
   RESPONSIVE
═══════════════════════════════════════════ */
@media(max-width:1200px){
  .prod-grid{grid-template-columns:repeat(2,1fr)}
  .prod-grid.cols-4{grid-template-columns:repeat(3,1fr)}
}
@media(max-width:992px){
  .shop-layout{grid-template-columns:1fr}
  .sidebar{position:static;height:auto;border-right:none;border-bottom:1px solid var(--border)}
  .ph-right{display:none}
  .page-header{padding:90px 28px 40px}
  .shop-main{padding:24px 28px 52px}
}
@media(max-width:640px){
  .prod-grid,.prod-grid.cols-2,.prod-grid.cols-4{grid-template-columns:repeat(2,1fr)}
  .toolbar{flex-direction:column;align-items:flex-start}
  .pager{justify-content:center}
  .pager-info{display:none}
}
</style>
@endpush

@section('content')

{{-- PAGE HEADER --}}
<section class="page-header">
  <div class="ph-bg"></div>
  <div class="ph-tex"></div>
  <div class="ph-inner">
    <div class="ph-left">
      <div class="ph-eyebrow">Batik Pudjangga</div>
      <h1 class="ph-title">Shop <em>All</em><br>Products</h1>
      <div class="ph-breadcrumb">
        <a href="{{ route('home') }}"><i class="fas fa-home" style="font-size:9px;margin-right:5px"></i>Home</a>
        <span>/</span>
        <span class="bc-cur">Shop</span>
      </div>
    </div>
    <div class="ph-right">
      <span class="ph-count-num" id="headerCount">{{ $products->total() ?? 0 }}</span>
      <span class="ph-count-label">produk tersedia</span>
    </div>
  </div>
</section>

{{-- SHOP LAYOUT --}}
<div class="shop-layout">

  {{-- SIDEBAR --}}
  <aside class="sidebar">
    <div class="sb-head">
      <div class="sb-head-row">
        <h5 class="sb-title"><i class="fas fa-sliders-h"></i>Filter</h5>
        <button class="sb-clear" id="clearAllBtn">Reset Semua</button>
      </div>
    </div>

    {{-- KATEGORI --}}
    <div class="sb-section">
      <p class="sb-sec-title"><i class="fas fa-th-large"></i>Kategori</p>
      <div class="sb-opts" id="catFilter">
        <label class="sb-opt is-active" data-cat="all">
          <input type="radio" name="category" value="all" checked>
          <span class="sb-opt-label">
            <i class="icon-inactive fas fa-border-all"></i>
            <i class="icon-active fas fa-check" style="color:var(--gold)"></i>
            Semua Produk
          </span>
          <span class="sb-opt-count" id="cnt-all">—</span>
        </label>
        <label class="sb-opt" data-cat="men">
          <input type="radio" name="category" value="men">
          <span class="sb-opt-label">
            <i class="icon-inactive fas fa-male"></i>
            <i class="icon-active fas fa-check" style="color:var(--gold)"></i>
            Koleksi Pria
          </span>
          <span class="sb-opt-count" id="cnt-men">—</span>
        </label>
        <label class="sb-opt" data-cat="women">
          <input type="radio" name="category" value="women">
          <span class="sb-opt-label">
            <i class="icon-inactive fas fa-female"></i>
            <i class="icon-active fas fa-check" style="color:var(--gold)"></i>
            Koleksi Wanita
          </span>
          <span class="sb-opt-count" id="cnt-women">—</span>
        </label>
        <label class="sb-opt" data-cat="pants">
          <input type="radio" name="category" value="pants">
          <span class="sb-opt-label">
            <i class="icon-inactive fas fa-shoe-prints"></i>
            <i class="icon-active fas fa-check" style="color:var(--gold)"></i>
            Celana
          </span>
          <span class="sb-opt-count" id="cnt-pants">—</span>
        </label>
        <label class="sb-opt" data-cat="oneset">
          <input type="radio" name="category" value="oneset">
          <span class="sb-opt-label">
            <i class="icon-inactive fas fa-tshirt"></i>
            <i class="icon-active fas fa-check" style="color:var(--gold)"></i>
            One Set
          </span>
          <span class="sb-opt-count" id="cnt-oneset">—</span>
        </label>
      </div>
    </div>

    {{-- URUTKAN --}}
    <div class="sb-section">
      <p class="sb-sec-title"><i class="fas fa-sort-amount-down"></i>Urutkan</p>
      <div class="sb-select-wrap">
        <select class="sb-select" id="sortSel">
          <option value="default">Paling Relevan</option>
          <option value="newest">Terbaru Dulu</option>
          <option value="name_asc">Nama A–Z</option>
          <option value="name_desc">Nama Z–A</option>
          <option value="price_asc">Harga: Rendah → Tinggi</option>
          <option value="price_desc">Harga: Tinggi → Rendah</option>
        </select>
        <span class="sb-select-ico"><i class="fas fa-chevron-down"></i></span>
      </div>
    </div>

    {{-- RENTANG HARGA --}}
    <div class="sb-section">
      <p class="sb-sec-title"><i class="fas fa-tag"></i>Rentang Harga</p>
      <div class="sb-opts" id="priceFilter">
        <label class="sb-opt is-active" data-price="all">
          <input type="radio" name="price_range" value="all" checked>
          <span class="sb-opt-label">
            <i class="icon-inactive fas fa-circle" style="font-size:7px"></i>
            <i class="icon-active fas fa-check" style="color:var(--gold)"></i>
            Semua Harga
          </span>
        </label>
        <label class="sb-opt" data-price="0-150000">
          <input type="radio" name="price_range" value="0-150000">
          <span class="sb-opt-label">
            <i class="icon-inactive fas fa-circle" style="font-size:7px"></i>
            <i class="icon-active fas fa-check" style="color:var(--gold)"></i>
            Di bawah Rp 150.000
          </span>
        </label>
        <label class="sb-opt" data-price="150000-300000">
          <input type="radio" name="price_range" value="150000-300000">
          <span class="sb-opt-label">
            <i class="icon-inactive fas fa-circle" style="font-size:7px"></i>
            <i class="icon-active fas fa-check" style="color:var(--gold)"></i>
            Rp 150.000 – 300.000
          </span>
        </label>
        <label class="sb-opt" data-price="300000-500000">
          <input type="radio" name="price_range" value="300000-500000">
          <span class="sb-opt-label">
            <i class="icon-inactive fas fa-circle" style="font-size:7px"></i>
            <i class="icon-active fas fa-check" style="color:var(--gold)"></i>
            Rp 300.000 – 500.000
          </span>
        </label>
        <label class="sb-opt" data-price="500000-999999999">
          <input type="radio" name="price_range" value="500000-999999999">
          <span class="sb-opt-label">
            <i class="icon-inactive fas fa-circle" style="font-size:7px"></i>
            <i class="icon-active fas fa-check" style="color:var(--gold)"></i>
            Di atas Rp 500.000
          </span>
        </label>
      </div>
    </div>

    {{-- HARGA CUSTOM --}}
    <div class="sb-section">
      <p class="sb-sec-title"><i class="fas fa-keyboard"></i>Harga Custom</p>
      <div class="price-boxes">
        <input class="price-box" type="number" id="priceMin" placeholder="Min" min="0">
        <span class="price-sep">–</span>
        <input class="price-box" type="number" id="priceMax" placeholder="Max" min="0">
      </div>
      <button class="sb-apply" id="applyPrice">Terapkan Harga</button>
    </div>

    {{-- KETERSEDIAAN --}}
    <div class="sb-section">
      <p class="sb-sec-title"><i class="fas fa-boxes"></i>Ketersediaan</p>
      <div class="sb-opts" id="stockFilter">
        <label class="sb-opt is-active" data-stock="all">
          <input type="radio" name="stock" value="all" checked>
          <span class="sb-opt-label">
            <i class="icon-inactive fas fa-circle" style="font-size:7px"></i>
            <i class="icon-active fas fa-check" style="color:var(--gold)"></i>
            Semua
          </span>
        </label>
        <label class="sb-opt" data-stock="instock">
          <input type="radio" name="stock" value="instock">
          <span class="sb-opt-label">
            <i class="icon-inactive fas fa-check-circle" style="color:rgba(80,180,100,.5)"></i>
            <i class="icon-active fas fa-check" style="color:var(--gold)"></i>
            Stok Tersedia
          </span>
        </label>
        <label class="sb-opt" data-stock="sale">
          <input type="radio" name="stock" value="sale">
          <span class="sb-opt-label">
            <i class="icon-inactive fas fa-fire" style="color:rgba(200,80,60,.55)"></i>
            <i class="icon-active fas fa-check" style="color:var(--gold)"></i>
            Sedang Diskon
          </span>
        </label>
      </div>
    </div>
  </aside>{{-- /sidebar --}}

  {{-- MAIN --}}
  <main class="shop-main">

    {{-- TOOLBAR --}}
    <div class="toolbar">
      <div class="toolbar-left">
        <span class="toolbar-count">
          Menampilkan <strong id="showingCount">0</strong> dari <strong id="totalCount">0</strong> produk
        </span>
        <div class="chips" id="activeChips"></div>
      </div>
      <div class="toolbar-right">
        <div class="sort-wrap">
          <select class="sort-sel" id="sortSelTop">
            <option value="default">Paling Relevan</option>
            <option value="newest">Terbaru</option>
            <option value="name_asc">Nama A–Z</option>
            <option value="price_asc">Harga ↑</option>
            <option value="price_desc">Harga ↓</option>
          </select>
          <span class="sort-ico"><i class="fas fa-chevron-down"></i></span>
        </div>
        <div class="view-btns">
          <button class="vbtn is-active" data-cols="3" title="3 Kolom">
            <svg width="14" height="14" viewBox="0 0 15 15" fill="currentColor"><rect x="0" y="0" width="4" height="4"/><rect x="5.5" y="0" width="4" height="4"/><rect x="11" y="0" width="4" height="4"/><rect x="0" y="5.5" width="4" height="4"/><rect x="5.5" y="5.5" width="4" height="4"/><rect x="11" y="5.5" width="4" height="4"/><rect x="0" y="11" width="4" height="4"/><rect x="5.5" y="11" width="4" height="4"/><rect x="11" y="11" width="4" height="4"/></svg>
          </button>
          <button class="vbtn" data-cols="2" title="2 Kolom">
            <svg width="14" height="14" viewBox="0 0 15 15" fill="currentColor"><rect x="0" y="0" width="6" height="6"/><rect x="9" y="0" width="6" height="6"/><rect x="0" y="9" width="6" height="6"/><rect x="9" y="9" width="6" height="6"/></svg>
          </button>
          <button class="vbtn" data-cols="4" title="4 Kolom">
            <svg width="14" height="14" viewBox="0 0 17 17" fill="currentColor"><rect x="0" y="0" width="3.5" height="3.5"/><rect x="4.5" y="0" width="3.5" height="3.5"/><rect x="9" y="0" width="3.5" height="3.5"/><rect x="13.5" y="0" width="3.5" height="3.5"/><rect x="0" y="4.5" width="3.5" height="3.5"/><rect x="4.5" y="4.5" width="3.5" height="3.5"/><rect x="9" y="4.5" width="3.5" height="3.5"/><rect x="13.5" y="4.5" width="3.5" height="3.5"/></svg>
          </button>
        </div>
      </div>
    </div>

    {{-- PRODUCT GRID --}}
    <div class="prod-grid" id="prodGrid"></div>

    {{-- PAGINATION --}}
    <div class="pager" id="pager">
      <span class="pager-info" id="pagerInfo"></span>
      <div class="pager-btns" id="pagerBtns"></div>
    </div>

  </main>{{-- /shop-main --}}

</div>{{-- /shop-layout --}}

@endsection

@push('scripts')
<script>
/* ──────────────────────────────────────────
   PRODUCT DATA — injected from controller
   Ganti dengan data Blade dari controller Anda
────────────────────────────────────────── */
const PRODUCTS = @json($products->items() ?? []);

/* ──────────────────────────────────────────
   STATE
────────────────────────────────────────── */
const STATE = {
  cat: 'all',
  price: 'all',
  stock: 'all',
  sort: 'default',
  page: 1,
  perPage: 9,
  wishlist: new Set(),
};

/* ──────────────────────────────────────────
   FILTER LOGIC
────────────────────────────────────────── */
function getFiltered() {
  let data = [...PRODUCTS];

  if (STATE.cat !== 'all') data = data.filter(p => (p.category?.slug ?? p.cat) === STATE.cat);

  if (STATE.price !== 'all') {
    const [mn, mx] = STATE.price.split('-').map(Number);
    data = data.filter(p => {
      const eff = p.sale_price ?? p.price;
      return eff >= mn && eff <= mx;
    });
  }

  if (STATE.stock === 'instock') data = data.filter(p => p.stock > 0);
  if (STATE.stock === 'sale')    data = data.filter(p => p.sale_price !== null && p.sale_price !== undefined);

  if (STATE.sort === 'newest')     data.sort((a,b) => b.id - a.id);
  else if (STATE.sort === 'name_asc')   data.sort((a,b) => a.name.localeCompare(b.name));
  else if (STATE.sort === 'name_desc')  data.sort((a,b) => b.name.localeCompare(a.name));
  else if (STATE.sort === 'price_asc')  data.sort((a,b) => (a.sale_price??a.price) - (b.sale_price??b.price));
  else if (STATE.sort === 'price_desc') data.sort((a,b) => (b.sale_price??b.price) - (a.sale_price??a.price));

  return data;
}

/* ──────────────────────────────────────────
   FORMAT CURRENCY
────────────────────────────────────────── */
const fmt = n => 'Rp ' + parseInt(n).toLocaleString('id-ID');

/* ──────────────────────────────────────────
   BADGE MAP
────────────────────────────────────────── */
const BADGE_MAP   = { new:'Baru', sale:'Sale', exc:'Eksklusif', hot:'Terlaris' };
const BADGE_CLASS = { new:'badge-new', sale:'badge-sale', exc:'badge-exc', hot:'badge-hot' };

const CAT_LABEL = { all:'Semua', men:'Koleksi Pria', women:'Koleksi Wanita', pants:'Celana', oneset:'One Set' };

/* ──────────────────────────────────────────
   RENDER PRODUCTS
────────────────────────────────────────── */
function renderProducts() {
  const filtered = getFiltered();
  const total = filtered.length;
  const totalPages = Math.max(1, Math.ceil(total / STATE.perPage));
  if (STATE.page > totalPages) STATE.page = 1;

  const start = (STATE.page - 1) * STATE.perPage;
  const pageItems = filtered.slice(start, start + STATE.perPage);

  const grid = document.getElementById('prodGrid');
  grid.innerHTML = '';

  document.getElementById('headerCount').textContent = total;
  document.getElementById('showingCount').textContent = pageItems.length;
  document.getElementById('totalCount').textContent   = total;

  // update category counts
  ['all','men','women','pants','oneset'].forEach(cat => {
    const el = document.getElementById('cnt-' + cat);
    if (!el) return;
    const count = cat === 'all' ? PRODUCTS.length : PRODUCTS.filter(p => (p.category?.slug ?? p.cat) === cat).length;
    el.textContent = count;
  });

  if (pageItems.length === 0) {
    grid.innerHTML = `
      <div class="empty">
        <div class="empty-ico"><i class="fas fa-search"></i></div>
        <h3 class="empty-title">Produk Tidak Ditemukan</h3>
        <p class="empty-text">Tidak ada produk yang cocok dengan filter pilihan Anda.<br>Coba ubah atau reset filter.</p>
        <button class="btn-ghost-gold" id="emptyReset"><i class="fas fa-redo" style="margin-right:8px;font-size:10px"></i>Reset Filter</button>
      </div>`;
    document.getElementById('emptyReset')?.addEventListener('click', resetAll);
    renderPager(0, 1, 1);
    return;
  }

  pageItems.forEach((p, i) => {
    const effPrice  = p.sale_price ?? p.price;
    const hasSale   = p.sale_price !== null && p.sale_price !== undefined;
    const delayClass = ['','d1','d2','d3','d4','d5','d6'][i % 7] ?? '';
    const isWished  = STATE.wishlist.has(p.id);
    const badge     = p.badge ?? (hasSale ? 'sale' : null);
    const imgSrc    = p.image ? `/storage/products/${p.image}` : '/assets/img/logo.png';
    const catLabel  = p.category?.name ?? CAT_LABEL[p.cat] ?? 'Koleksi';
    const detailUrl = p.slug ? `/shop/${p.slug}` : `/shop/${p.id}`;

    const card = document.createElement('div');
    card.className = `pcard reveal ${delayClass}`;
    card.innerHTML = `
      <div class="pcard-img-wrap">
        <div class="pcard-img-inner">
          <img src="${imgSrc}" alt="${p.name}" loading="lazy" onerror="this.style.opacity='0'">
          <div class="pcard-veil"></div>
        </div>
        <div class="pcard-tex"></div>
        ${badge ? `<span class="pcard-badge ${BADGE_CLASS[badge] ?? ''}">${BADGE_MAP[badge] ?? badge}</span>` : ''}
        <button class="pcard-wish ${isWished ? 'wishlisted' : ''}" data-id="${p.id}" title="Wishlist">
          <i class="fa${isWished ? 's' : 'r'} fa-heart"></i>
        </button>
        <div class="pcard-cta-wrap">
          <button class="pcard-cta-shop" onclick="addToCart(${p.id})">Tambah ke Keranjang</button>
        </div>
      </div>
      <div class="pcard-info">
        <div>
          <p class="pcard-name"><a href="${detailUrl}" style="color:inherit;text-decoration:none">${p.name}</a></p>
          <p class="pcard-cat">${catLabel}</p>
        </div>
        <div class="pcard-price">
          ${hasSale ? `<span class="old">${fmt(p.price)}</span>` : `<span class="price-label">Mulai dari</span>`}
          <span class="current">${fmt(effPrice)}</span>
        </div>
      </div>`;
    grid.appendChild(card);
  });

  // wishlist toggle
  grid.querySelectorAll('.pcard-wish').forEach(btn => {
    btn.addEventListener('click', e => {
      e.stopPropagation();
      const id = +btn.dataset.id;
      if (STATE.wishlist.has(id)) {
        STATE.wishlist.delete(id);
        btn.classList.remove('wishlisted');
        btn.querySelector('i').className = 'far fa-heart';
      } else {
        STATE.wishlist.add(id);
        btn.classList.add('wishlisted');
        btn.querySelector('i').className = 'fas fa-heart';
      }
    });
  });

  // scroll reveal
  setTimeout(() => {
    const obs = new IntersectionObserver(en => en.forEach(e => {
      if (e.isIntersecting) { e.target.classList.add('vis'); obs.unobserve(e.target); }
    }), {threshold:.08});
    grid.querySelectorAll('.reveal').forEach(el => obs.observe(el));
  }, 50);

  renderPager(total, STATE.page, totalPages);
}

/* ──────────────────────────────────────────
   RENDER PAGINATION
────────────────────────────────────────── */
function renderPager(total, cur, totalPages) {
  const info = document.getElementById('pagerInfo');
  const btns = document.getElementById('pagerBtns');
  if (total === 0) { info.textContent=''; btns.innerHTML=''; return; }

  const start = (cur-1)*STATE.perPage+1;
  const end   = Math.min(cur*STATE.perPage, total);
  info.innerHTML = `Menampilkan <strong>${start}–${end}</strong> dari <strong>${total}</strong> produk`;
  btns.innerHTML = '';

  const make = (label, page, active=false, disabled=false) => {
    const b = document.createElement('button');
    b.className = 'pager-btn' + (active?' is-active':'') + (disabled?' disabled':'');
    b.innerHTML = label;
    if (!disabled && !active) b.addEventListener('click', () => {
      STATE.page = page;
      renderProducts();
      window.scrollTo({top:400, behavior:'smooth'});
    });
    return b;
  };

  btns.appendChild(make('<i class="fas fa-chevron-left"></i>', cur-1, false, cur===1));

  const maxBtn = 5;
  let pages = [];
  if (totalPages <= maxBtn + 2) {
    for (let i=1; i<=totalPages; i++) pages.push(i);
  } else {
    pages = [1];
    if (cur > 3) pages.push('…');
    for (let i=Math.max(2,cur-1); i<=Math.min(totalPages-1,cur+1); i++) pages.push(i);
    if (cur < totalPages-2) pages.push('…');
    pages.push(totalPages);
  }

  pages.forEach(p => {
    if (p === '…') {
      const d = document.createElement('span');
      d.className = 'pager-dots'; d.textContent = '···';
      btns.appendChild(d);
    } else {
      btns.appendChild(make(p, p, p===cur));
    }
  });

  btns.appendChild(make('<i class="fas fa-chevron-right"></i>', cur+1, false, cur===totalPages));
}

/* ──────────────────────────────────────────
   ACTIVE CHIPS
────────────────────────────────────────── */
function renderChips() {
  const chips = document.getElementById('activeChips');
  chips.innerHTML = '';

  const mk = (label, removeKey) => {
    const c = document.createElement('span');
    c.className = 'chip';
    c.innerHTML = `${label} <span class="chip-x">✕</span>`;
    c.addEventListener('click', () => {
      if (removeKey==='cat')   { STATE.cat='all';   syncSidebarRadio('catFilter','all'); }
      if (removeKey==='price') { STATE.price='all'; syncSidebarRadio('priceFilter','all'); }
      if (removeKey==='stock') { STATE.stock='all'; syncSidebarRadio('stockFilter','all'); }
      STATE.page=1; renderChips(); renderProducts();
    });
    return c;
  };

  if (STATE.cat   !== 'all')      chips.appendChild(mk(CAT_LABEL[STATE.cat] ?? STATE.cat, 'cat'));
  if (STATE.price !== 'all')      chips.appendChild(mk('Harga Custom', 'price'));
  if (STATE.stock === 'sale')     chips.appendChild(mk('Sedang Diskon', 'stock'));
  if (STATE.stock === 'instock')  chips.appendChild(mk('Stok Tersedia', 'stock'));
}

function syncSidebarRadio(groupId, val) {
  document.querySelectorAll(`#${groupId} .sb-opt`).forEach(el => {
    const key = groupId==='catFilter' ? 'cat' : groupId==='priceFilter' ? 'price' : 'stock';
    const match = el.dataset[key] === val;
    el.classList.toggle('is-active', match);
    if (match) el.querySelector('input').checked = true;
  });
}

/* ──────────────────────────────────────────
   RESET ALL
────────────────────────────────────────── */
function resetAll() {
  STATE.cat='all'; STATE.price='all'; STATE.stock='all'; STATE.sort='default'; STATE.page=1;
  syncSidebarRadio('catFilter','all');
  syncSidebarRadio('priceFilter','all');
  syncSidebarRadio('stockFilter','all');
  document.getElementById('sortSel').value    = 'default';
  document.getElementById('sortSelTop').value = 'default';
  document.getElementById('priceMin').value   = '';
  document.getElementById('priceMax').value   = '';
  renderChips(); renderProducts();
}

/* ──────────────────────────────────────────
   BINDINGS
────────────────────────────────────────── */
function bindFilter(groupId, stateKey) {
  document.querySelectorAll(`#${groupId} .sb-opt`).forEach(opt => {
    opt.addEventListener('click', () => {
      document.querySelectorAll(`#${groupId} .sb-opt`).forEach(o => o.classList.remove('is-active'));
      opt.classList.add('is-active');
      opt.querySelector('input').checked = true;
      const key = stateKey==='cat' ? 'cat' : stateKey==='price' ? 'price' : 'stock';
      STATE[stateKey] = opt.dataset[key];
      STATE.page = 1;
      renderChips(); renderProducts();
    });
  });
}

bindFilter('catFilter','cat');
bindFilter('priceFilter','price');
bindFilter('stockFilter','stock');

document.getElementById('sortSel').addEventListener('change', e => {
  STATE.sort = e.target.value;
  document.getElementById('sortSelTop').value = e.target.value;
  STATE.page = 1; renderProducts();
});

document.getElementById('sortSelTop').addEventListener('change', e => {
  STATE.sort = e.target.value;
  document.getElementById('sortSel').value = e.target.value;
  STATE.page = 1; renderProducts();
});

document.getElementById('applyPrice').addEventListener('click', () => {
  const mn = +document.getElementById('priceMin').value || 0;
  const mx = +document.getElementById('priceMax').value || 999999999;
  if (mn > mx) { alert('Harga minimum tidak boleh lebih besar dari harga maksimum'); return; }
  STATE.price = `${mn}-${mx}`;
  document.querySelectorAll('#priceFilter .sb-opt').forEach(o => o.classList.remove('is-active'));
  document.querySelectorAll('#priceFilter input').forEach(i => i.checked = false);
  STATE.page = 1; renderChips(); renderProducts();
});

document.getElementById('clearAllBtn').addEventListener('click', resetAll);

document.querySelectorAll('.vbtn').forEach(btn => {
  btn.addEventListener('click', () => {
    document.querySelectorAll('.vbtn').forEach(b => b.classList.remove('is-active'));
    btn.classList.add('is-active');
    document.getElementById('prodGrid').className = `prod-grid cols-${btn.dataset.cols}`;
  });
});

/* ──────────────────────────────────────────
   INIT
────────────────────────────────────────── */
renderChips();
renderProducts();
</script>
@endpush