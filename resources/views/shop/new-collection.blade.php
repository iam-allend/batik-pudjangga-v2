@extends('layouts.app')

@section('title', 'Koleksi Terbaru - Batik Pudjangga')

@section('content')
<section class="page-header">
    <div class="container">
        <h1 class="page-title">Koleksi Terbaru</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ route('shop.index') }}">Belanja</a></li>
                <li class="breadcrumb-item active">Koleksi Terbaru</li>
            </ol>
        </nav>
    </div>
</section>

<section class="shop-section py-5">
    <div class="container">
        @if($products->count() > 0)
            <div class="row g-4">
                @foreach($products as $product)
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        @include('components.product-card', ['product' => $product])
                    </div>
                @endforeach
            </div>
            <div class="mt-5">
                {{ $products->links() }}
            </div>
        @else
            <div class="empty-state text-center py-5">
                <i class="fas fa-box-open fa-5x text-muted mb-4"></i>
                <h3>Tidak Tersedia Produk Terbaru</h3>
                <p class="text-muted">Silahkan Priksa Kembali Nanti Untuk Melihat Produk Baru</p>
            </div>
        @endif
    </div>
</section>
@endsection
