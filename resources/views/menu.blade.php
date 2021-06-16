@extends('_layouts.main')
@push('head')
<style>
    a{
        display: block;
    }
    .card {
        height: 300px;
        position: relative;
        align-items: flex-end;
        transition: 0.5s;
        border-radius: 0;
        display: block;
    }

    .card:before {
        position: absolute;
        top: 0;
        left: 0;
        display: block;
        width: 100%;
        height: 100%;
        transition: 0.5s;
        opacity: 0;
    }
    .card:hover .info p{
        display: inline-flex;
    }
    .card:hover .title{
        display: none;
        transition: 0s;
    }

    .card .info {
        position: relative;
        color: white;
        opacity: 0;
        transform: translateY(100px);
        transition: 0.5s;
    }
    .card .info p{
        display:none;
        transition: 0.5s;
    }
    .card:hover .info {
        display: inline-block;
        opacity: 1;
        transform: translateY(-100px);
    }
    .card .title{
        display: inline-flex;
    }

    .card .title {
        position: relative;
        margin-top: 100px;
        transition: 0.5s;
    }

    .card:hover .title {
        display: block;
        color: white;
        opacity: 0;
        transform: translateY(-100px);
        transition: 0.5s;
    }
</style>
@endpush
@section('content')
@if(request()->routeIs('admin.data-store'))
@section('title', 'Data Master')
@push('breadcrumb')
<li class="breadcrumb-item active">Data Master</li>
@endpush

<section id="card-content-types">
    <div class="container">

        <div class="row">
            <div class="col-md-3 col-xl-3">
                <a href="{{ route('admin.kontak.index') }}">
                    <div class="card bg-danger border-0 text-white">
                        <div class="card-body">
                            <div class="title">
                                <h1 class="text-light">Kontak</h1>
                            </div>
                            <div class="info">
                                <p class="card-text">
                                    <h1 class="card-text display-5 text-white font-weight-bold">Data Kontak</h1>
                                </p>
                                <p class="card-text">
                                    This is a wider card with supporting text below as a natural lead-in to additional content. This content is
                                    a little bit longer.
                                </p>
                                <p class="card-text">
                                    <small class="text-light">Last updated 3 mins ago</small>
                                </p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-xl-3">
                <a href="{{ route('admin.akun.index') }}">
                    <div class="card bg-warning border-0 text-white">
                        <div class="card-body">
                            <div class="title">
                                <h1 class="text-light">Chart Of Account</h1>
                            </div>
                            <div class="info">
                                <p class="card-text">
                                <h1 class="card-text display-5 text-white font-weight-bold">Chart Of Account</h1>
                                </p>
                                <p class="card-text">
                                    This is a wider card with supporting text below as a natural lead-in to additional content. This content is
                                    a little bit longer.
                                </p>
                                <p class="card-text">
                                    <small class="text-light">Last updated 3 mins ago</small>
                                </p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-xl-3">
                <a href="{{ route('admin.subklasifikasi.index') }}">
                    <div class="card bg-info border-0 text-white">
                        <div class="card-body">
                            <div class="title">
                                <h1 class="text-light">Subklasifikasi Akun</h1>
                            </div>
                            <div class="info">
                                <p class="card-text">
                                <h1 class="card-text display-5 text-white font-weight-bold">Subklasifikasi Akun</h1>
                                </p>
                                <p class="card-text">
                                    This is a wider card with supporting text below as a natural lead-in to additional content. This content is
                                    a little bit longer.
                                </p>
                                <p class="card-text">
                                    <small class="text-light">Last updated 3 mins ago</small>
                                </p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-xl-3">
                <a href="{{ route('admin.bank.index') }}">
                    <div class="card bg-success border-0 text-white">
                        <div class="card-body">
                            <div class="title">
                                <h1 class="text-light">Bank</h1>
                            </div>
                            <div class="info">
                                <p class="card-text">
                                <h1 class="card-text display-5 text-white font-weight-bold">Bank</h1>
                                </p>
                                <p class="card-text">
                                    This is a wider card with supporting text below as a natural lead-in to additional content. This content is
                                    a little bit longer.
                                </p>
                                <p class="card-text">
                                    <small class="text-light">Last updated 3 mins ago</small>
                                </p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-xl-3">
                <a href="{{ route('admin.divisi.index') }}">
                    <div class="card bg-dark border-0 text-white">
                        <div class="card-body">
                            <div class="title">
                                <h1 class="text-light">Divisi</h1>
                            </div>
                            <div class="info">
                                <p class="card-text">
                                <h1 class="card-text display-5 text-white font-weight-bold">Divisi</h1>
                                </p>
                                <p class="card-text">
                                    This is a wider card with supporting text below as a natural lead-in to additional content. This content is
                                    a little bit longer.
                                </p>
                                <p class="card-text">
                                    <small class="text-light">Last updated 3 mins ago</small>
                                </p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-xl-3">
                <a href="{{ route('admin.unit.index') }}">
                    <div class="card bg-secondary border-0 text-white">
                        <div class="card-body">
                            <div class="title">
                                <h1 class="text-light">Unit</h1>
                            </div>
                            <div class="info">
                                <p class="card-text">
                                <h1 class="card-text display-5 text-white font-weight-bold">Unit</h1>
                                </p>
                                <p class="card-text">
                                    This is a wider card with supporting text below as a natural lead-in to additional content. This content is
                                    a little bit longer.
                                </p>
                                <p class="card-text">
                                    <small class="text-light">Last updated 3 mins ago</small>
                                </p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-xl-3">
                <a href="{{ route('admin.product.index') }}">
                    <div class="card bg-primary border-0 text-white">
                        <div class="card-body">
                            <div class="title">
                                <h1 class="text-light">Produk</h1>
                            </div>
                            <div class="info">
                                <p class="card-text">
                                <h1 class="card-text display-5 text-white font-weight-bold">Produk</h1>
                                </p>
                                <p class="card-text">
                                    This is a wider card with supporting text below as a natural lead-in to additional content. This content is
                                    a little bit longer.
                                </p>
                                <p class="card-text">
                                    <small class="text-light">Last updated 3 mins ago</small>
                                </p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>
@endif

@if(request()->routeIs('admin.ledger'))
@section('title', 'Jurnal')
@push('breadcrumb')
<li class="breadcrumb-item active">Jurnal</li>
@endpush
<section>
    <div class="row">
        <div class="col-md-3 col-xl-3">
            <a href="{{ route('admin.bukubesar.index') }}">
                <div class="card border-0 text-white">
                    <img class="card-img" src="{{ asset('app-assets/images/slider/10.jpg') }}" alt="Buku Besar" />
                    <div class="card-img-overlay bg-overlay align-items-center d-flex justify-content-center">
                        <h1 class="card-text display-5 text-white font-weight-bold">Buku Besar</h1>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3 col-xl-3">
            <a href="{{ route('admin.jurnalumum.index') }}">
                <div class="card border-0 text-white">
                    <img class="card-img" src="{{ asset('app-assets/images/slider/10.jpg') }}" alt="Jurnal Umum" />
                    <div class="card-img-overlay bg-overlay align-items-center d-flex justify-content-center">
                        <h1 class="card-text display-5 text-white font-weight-bold">Jurnal Umum</h1>
                    </div>
                </div>
            </a>
        </div>
    </div>
</section>
@endif

    @if(request()->routeIs('admin.sales'))
        @section('title', 'Penjualan')
        @push('breadcrumb')
            <li class="breadcrumb-item active">Penjualan</li>
        @endpush
        <section>
            <div class="row">
                <div class="col-md-3 col-xl-3">
                    <a href="{{ route('admin.penawaran.index') }}">
                        <div class="card border-0 text-white shadow">
                            <img class="card-img" src="{{ asset('app-assets/images/slider/10.jpg') }}" alt="Buku Besar" />
                            <div class="card-img-overlay bg-overlay align-items-center d-flex justify-content-center">
                                <h1 class="card-text display-5 text-white font-weight-bold">Penawaran Harga</h1>
                            </div>
                        </div>
                    </a>
                </div>
                {{-- <div class="col-md-3 col-xl-3">
                    <a href="{{ route('admin.jurnalumum.index') }}">
                        <div class="card border-0 text-white shadow">
                            <img class="card-img" src="{{ asset('app-assets/images/slider/10.jpg') }}" alt="Jurnal Umum" />
                            <div class="card-img-overlay bg-overlay align-items-center d-flex justify-content-center">
                                <h1 class="card-text display-5 text-white font-weight-bold">Jurnal Umum</h1>
                            </div>
                        </div>
                    </a>
                </div> --}}
            </div>
        </section>
        {{--  --}}
    @endif

@if(request()->routeIs('admin.purchase'))
@section('title', 'Purchases')
@push('breadcrumb')
<li class="breadcrumb-item active">Purchase</li>
@endpush
{{-- --}}
@endif

@if(request()->routeIs('admin.cash-bank'))
@section('title', 'Cash & Bank')
@push('breadcrumb')
<li class="breadcrumb-item active">Cash & Bank</li>
@endpush
<section id="card-content-types">
    <div class="row">
        <div class="col-md-3 col-xl-3">
            <a href="{{ route('admin.bkk.index') }}">
                <div class="card border-0 text-white">
                    <img class="card-img" src="{{ asset('app-assets/images/slider/10.jpg') }}" alt="Category" />
                    <div class="card-img-overlay bg-overlay align-items-center d-flex justify-content-center">
                        <h1 class="card-text display-5 text-white font-weight-bold">Expense</h1>
                        {{-- <p class="card-text">
                                    This is a wider card with supporting text below as a natural lead-in to additional content. This content is
                                    a little bit longer.
                                </p>
                                <p class="card-text">
                                    <small class="text-muted">Last updated 3 mins ago</small>
                                </p> --}}
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3 col-xl-3">
            <a href="{{ route('admin.bkm.index') }}">
                <div class="card border-0 text-white">
                    <img class="card-img" src="{{ asset('app-assets/images/slider/10.jpg') }}" alt="Unit" />
                    <div class="card-img-overlay bg-overlay align-items-center d-flex justify-content-center">
                        <h1 class="card-text display-5 text-white font-weight-bold">Income</h1>
                    </div>
                </div>
            </a>
        </div>
    </div>
</section>
{{-- --}}
@endif
@if(request()->routeIs('admin.inventory'))
@section('title', 'Inventory')
@push('breadcrumb')
<li class="breadcrumb-item active">Inventory</li>
@endpush
{{-- --}}
@endif
@if(request()->routeIs('admin.report'))
@section('title', 'Report')
@push('breadcrumb')
<li class="breadcrumb-item active">Report</li>
@endpush
{{-- --}}
@endif
@endsection
