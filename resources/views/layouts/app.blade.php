<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Batik Pudjangga — Future of Heritage')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts: Playfair Display + Raleway -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,700;1,400;1,500&family=Raleway:wght@200;300;400;500;600&display=swap" rel="stylesheet">

    <!-- ★ Pudjangga Theme — taruh di: public/assets/css/pudjangga.css ★ -->
    <link rel="stylesheet" href="{{ asset('assets/css/pudjangga.css') }}">

    @stack('styles')
</head>
<body>

<!-- Custom Cursor -->
<div class="cur" id="curDot"><div class="cur-dot"></div></div>
<div class="cur-ring" id="curRing"></div>

<!-- Loading Overlay -->
<div class="loading-overlay" id="loadingOverlay">
    <div class="spinner"></div>
</div>

<!-- Navigation -->
@include('layouts.partials.navbar')

<!-- Main Content -->
<main>
    @if(session('success'))
        <div class="container mt-4">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2" style="color:var(--gold)"></i>
                {{ session('success') }}
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
            </div>
        </div>
    @endif
    @if(session('error'))
        <div class="container mt-4">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i>
                {{ session('error') }}
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
            </div>
        </div>
    @endif
    @if(session('info'))
        <div class="container mt-4">
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                <i class="fas fa-info-circle me-2" style="color:var(--gold)"></i>
                {{ session('info') }}
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
            </div>
        </div>
    @endif
    @if($errors->any())
        <div class="container mt-4">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i>
                <strong>Whoops!</strong> Ada masalah dengan input Anda.
                <ul class="mb-0 mt-2">
                    @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                </ul>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
            </div>
        </div>
    @endif

    @yield('content')
</main>

<!-- Footer -->
@include('layouts.partials.footer')

<!-- Back to Top -->
<button class="back-to-top" id="backToTop" aria-label="Back to top">
    <i class="fas fa-arrow-up"></i>
</button>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    /* ── CURSOR ── */
    const curDot=document.getElementById('curDot'),curRing=document.getElementById('curRing');
    let mx=0,my=0,rx=0,ry=0;
    document.addEventListener('mousemove',e=>{mx=e.clientX;my=e.clientY;curDot.style.left=mx+'px';curDot.style.top=my+'px';});
    (function a(){rx+=(mx-rx)*.11;ry+=(my-ry)*.11;curRing.style.left=rx+'px';curRing.style.top=ry+'px';requestAnimationFrame(a);})();
    document.querySelectorAll('a,button').forEach(el=>{
        el.addEventListener('mouseenter',()=>document.body.classList.add('cursor-hover'));
        el.addEventListener('mouseleave',()=>document.body.classList.remove('cursor-hover'));
    });

    /* ── CSRF ── */
    $.ajaxSetup({headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}});

    /* ── AUTO DISMISS ── */
    setTimeout(()=>{$('.alert').fadeOut('slow');},5000);

    /* ── BACK TO TOP ── */
    $(window).scroll(function(){$(this).scrollTop()>300?$('#backToTop').addClass('show'):$('#backToTop').removeClass('show');});
    $('#backToTop').click(function(){$('html,body').animate({scrollTop:0},600);return false;});

    /* ── SCROLL REVEAL ── */
    const ro=new IntersectionObserver(entries=>{entries.forEach(e=>{if(e.isIntersecting)e.target.classList.add('vis');});},{threshold:.1});
    document.querySelectorAll('.reveal').forEach(el=>ro.observe(el));

    /* ── LOADING ── */
    window.showLoading=()=>$('#loadingOverlay').addClass('show');
    window.hideLoading=()=>$('#loadingOverlay').removeClass('show');

    /* ── ADD TO CART ── */
    window.addToCart=function(productId,size=null,notes=null){
        showLoading();
        $.ajax({url:'/api/cart/add',method:'POST',data:{product_id:productId,quantity:1,size,notes},
            success:function(r){hideLoading();if(r.success){updateCartCount();showToast('success',r.message);}},
            error:function(xhr){hideLoading();showToast('error',xhr.responseJSON?.message||'Gagal menambah ke keranjang');}
        });
    };

    /* ── WISHLIST ── */
    window.toggleWishlist=function(productId,element){
        if(!{{ auth()->check()?'true':'false' }}){window.location.href='/login';return;}
        $.ajax({url:'/api/wishlist/toggle/'+productId,method:'POST',
            success:function(r){if(r.success){$(element).toggleClass('active');$(element).html(r.data.in_wishlist?'<i class="fas fa-heart"></i>':'<i class="far fa-heart"></i>');showToast('success',r.message);}},
            error:()=>showToast('error','Gagal memperbarui wishlist')
        });
    };

    /* ── CART COUNT ── */
    function updateCartCount(){$.ajax({url:'/api/cart/count',method:'GET',success:r=>{if(r.success)$('#cartCount').text(r.data.count);}});}

    /* ── TOAST ── */
    function showToast(type,message){
        const bg=type==='success'?'var(--timber)':'rgba(139,58,42,.9)';
        const bc=type==='success'?'var(--border-strong)':'rgba(139,58,42,.6)';
        const icon=type==='success'?'fa-check-circle':'fa-exclamation-circle';
        const ic=type==='success'?'var(--gold)':'#e07070';
        const t=$(`<div style="position:fixed;top:88px;right:24px;background:${bg};border:1px solid ${bc};color:var(--parchment);padding:14px 20px;border-radius:2px;z-index:9999;min-width:280px;box-shadow:0 8px 32px rgba(0,0,0,.4);animation:toastIn .3s ease;font-family:'Raleway',sans-serif;font-size:13px;"><i class="fas ${icon} me-2" style="color:${ic}"></i>${message}</div>`);
        $('body').append(t);
        setTimeout(()=>t.fadeOut('slow',function(){$(this).remove();}),3200);
    }

    window.formatCurrency=amount=>'Rp '+parseInt(amount).toLocaleString('id-ID');
    $(document).ready(function(){@auth updateCartCount();@endauth});
</script>
@stack('scripts')
</body>
</html>