@extends('_layouts.main')
@push('head')
<style>
    a {
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

    .card:hover .info p {
        display: inline-flex;
        transition: 0.5s;
    }

    .card:hover .title {
        display: none;
        transition: 0s;
    }

    .card .info {
        position: absolute;
        color: white;
        margin-top: 100px;
        opacity: 0;
        transform: translateY(100px);
        transition: 0.5s;
    }

    .card .info p {
        display: none;
        transition: 0.5s;
    }

    .card:hover .info {
        display: inline-block;
        opacity: 1;
        transform: translateY(-100px);
        transition: 0.5s;
    }

    .card .title {
        display: inline-flex;
    }

    .card .title {
        position: absolute;
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
                    <div class="card border-0 text-white" style="background-color: #542E71;">
                        <div class="card-body">
                            <div class="title">
                                <div class="row">
                                    <div class="col">
                                        <h1 class="text-light">Kontak</h1>
                                    </div>
                                    <div class="col">
                                        <i class="fa fa-users fa-lg fa-5x"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="info">
                                <p class="card-text">
                                <h1 class="card-text display-5 text-white font-weight-bold">Data Kontak</h1>
                                <i class="fa fa-users"></i>
                                </p>
                                <hr class="mr-1">
                                <p class="card-text">
                                    Membuat dan menyunting data pelanggan, pemasok, dan karyawan.
                                </p>
                                <p class="card-text">
                                    <small class="text-light"></small>
                                </p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-xl-3">
                <a href="{{ route('admin.akun.index') }}">
                    <div class="card border-0 text-white" style="background-color: #FB3640;">
                        <div class="card-body">
                            <div class="title">
                                <div class="row">
                                    <div class="col">
                                        <h1 class="text-light">Chart Of Account</h1>
                                    </div>
                                    <div class="col">
                                        <i class="fa fa-clipboard-list fa-lg fa-5x"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="info">
                                <p class="card-text">
                                <h1 class="card-text display-5 text-white font-weight-bold">Chart Of Account</h1>
                                <i class="fa fa-clipboard-list"></i>
                                </p>
                                <hr class="mr-1">
                                <p class="card-text">
                                    Membuat dan menyunting data rekening
                                </p>
                                <p class="card-text">
                                    <small class="text-light"></small>
                                </p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-xl-3">
                <a href="{{ route('admin.subklasifikasi.index') }}">
                    <div class="card border-0 text-white" style="background-color: #FDCA40;">
                        <div class="card-body">
                            <div class="title">
                                <div class="row">
                                    <div class="col">
                                        <h1 class="text-light">Akun</h1>
                                    </div>
                                    <div class="col">
                                        <i class="fa fa-check-square fa-lg fa-5x"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="info">
                                <p class="card-text">
                                <h1 class="card-text display-5 text-white font-weight-bold">Subklasifikasi Akun</h1>
                                <i class="fa fa-check-square"></i>
                                </p>
                                <hr class="mr-1">
                                <p class="card-text">
                                    Mengelola klasifikasi akun
                                </p>
                                <p class="card-text">
                                    <small class="text-light"></small>
                                </p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-xl-3">
                <a href="{{ route('admin.bank.index') }}">
                    <div class="card border-0 text-white" style="background-color: #A799B7;">
                        <div class="card-body">
                            <div class="title">
                                <div class="row">
                                    <div class="col">
                                        <h1 class="text-light">Bank</h1>
                                    </div>
                                    <div class="col">
                                        <i class="fa fa-money-bill-alt fa-lg fa-5x"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="info">
                                <p class="card-text">
                                <h1 class="card-text display-5 text-white font-weight-bold">Bank</h1>
                                <i class="fa fa-money-bill-alt"></i>
                                </p>
                                <hr class="mr-1">
                                <p class="card-text">
                                    Mengelola data bank
                                </p>
                                <p class="card-text">
                                    <small class="text-light"></small>
                                </p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-xl-3">
                <a href="{{ route('admin.divisi.index') }}">
                    <div class="card border-0 text-white" style="background-color: #194350;">
                        <div class="card-body">
                            <div class="title">
                                <div class="row">
                                    <div class="col">
                                        <h1 class="text-light">Divisi</h1>
                                    </div>
                                    <div class="col">
                                        <i class="fa fa-divide fa-lg fa-5x"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="info">
                                <p class="card-text">
                                <h1 class="card-text display-5 text-white font-weight-bold">Divisi</h1>
                                <i class="fa fa-divide"></i>
                                </p>
                                <hr class="mr-1">
                                <p class="card-text">
                                    Mengelola data divisi
                                </p>
                                <p class="card-text">
                                    <small class="text-light"></small>
                                </p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-xl-3">
                <a href="{{ route('admin.unit.index') }}">
                    <div class="card border-0 text-white" style="background-color: #FF8882;">
                        <div class="card-body">
                            <div class="title">
                                <div class="row">
                                    <div class="col">

                                        <h1 class="text-light">Unit</h1>
                                    </div>
                                    <div class="col">
                                        <i class="fa fa-address-book fa-lg fa-5x"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="info">
                                <p class="card-text">
                                <h1 class="card-text display-5 text-white font-weight-bold">Unit</h1>
                                <i class="fa fa-address-book"></i>
                                </p>
                                <hr class="mr-1">
                                <p class="card-text">
                                    Mengelola data unit
                                </p>
                                <p class="card-text">
                                    <small class="text-light"></small>
                                </p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-xl-3">
                <a href="{{ route('admin.product.index') }}">
                    <div class="card border-0 text-white" style="background-color: #008891;">
                        <div class="card-body">
                            <div class="title">
                                <div class="row">
                                    <div class="col">
                                        <h1 class="text-light">Produk</h1>
                                    </div>
                                    <div class="col">
                                        <i class="fa fa-chart-line fa-lg fa-5x"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="info">
                                <p class="card-text">
                                <h1 class="card-text display-5 text-white font-weight-bold">Produk</h1>
                                <i class="fa fa-chart-line"></i>
                                </p>
                                <hr class="mr-1">
                                <p class="card-text">
                                    Mengelola data barang
                                </p>
                                <p class="card-text">
                                    <small class="text-light"></small>
                                </p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-xl-3">
                <a href="{{ route('admin.category.index') }}">
                    <div class="card border-0 text-white" style="background-color: #7952B3;">
                        <div class="card-body">
                            <div class="title">
                                <div class="row">
                                    <div class="col">
                                        <h1 class="text-light">Category</h1>
                                    </div>
                                    <div class="col">
                                        <i class="fa fa-box fa-lg fa-5x"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="info">
                                <p class="card-text">
                                <h1 class="card-text display-5 text-white font-weight-bold">Category</h1>
                                <i class="fa fa-box"></i>
                                </p>
                                <hr class="mr-1">
                                <p class="card-text">
                                    Mengelola data Category
                                </p>
                                <p class="card-text">
                                    <small class="text-light"></small>
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
                <div class="card bg-primary border-0 text-white">
                    <div class="card-body">
                        <div class="title">
                            <div class="row">
                                <div class="col">
                                    <h1 class="text-light">Buku Besar</h1>
                                </div>
                                <div class="col">
                                    <i class="fa fa-book-open fa-lg fa-5x"></i>
                                </div>
                            </div>
                        </div>
                        <div class="info">
                            <p class="card-text">
                            <h1 class="card-text display-5 text-white font-weight-bold">Buku Besar</h1>
                            <i class="fa fa-book-open"></i>
                            </p>
                            <hr class="mr-1">
                            <p class="card-text">
                                Menampilkan ikhtisar jurnal
                            </p>
                            <p class="card-text">
                                <small class="text-light"></small>
                            </p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3 col-xl-3">
            <a href="{{ route('admin.jurnalumum.index') }}">
                <div class="card bg-warning border-0 text-white">
                    <div class="card-body">
                        <div class="title">
                            <div class="row">
                                <div class="col">
                                    <h1 class="text-light">Jurnal Umum</h1>
                                </div>
                                <div class="col">
                                    <i class="fa fa-book fa-lg fa-5x"></i>
                                </div>
                            </div>
                        </div>
                        <div class="info">
                            <p class="card-text">
                            <h1 class="card-text display-5 text-white font-weight-bold">Jurnal Umum</h1>
                            <i class="fa fa-book"></i>
                            </p>
                            <hr class="mr-1">
                            <p class="card-text">
                                Mencatat transaksi keuangan dan menetapkan kredit dan debit
                            </p>
                            <p class="card-text">
                                <small class="text-light"> </small>
                            </p>
                        </div>
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
                <div class="card bg-success border-0 text-white shadow">
                    <div class="card-body">
                        <div class="title">
                            <div class="row">
                                <div class="col">
                                    <h1 class="text-light">Penawaran Harga</h1>
                                </div>
                                <div class="col">
                                    <i class="fa fa-chart-line fa-lg fa-5x"></i>
                                </div>
                            </div>
                        </div>
                        <div class="info">
                            <p class="card-text">
                            <h1 class="card-text display-5 text-white font-weight-bold">Penawaran Harga</h1>
                            <i class="fa fa-chart-line"></i>
                            </p>
                            <hr class="mr-1">
                            <p class="card-text">
                                Membuat penawaran harga untuk pelanggan
                            </p>
                            <p class="card-text">
                                <small class="text-light"></small>
                            </p>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-3 col-xl-3">
            <a href="{{ route('admin.pesanan.index') }}">
                <div class="card bg-warning border-0 text-white shadow">
                    <div class="card-body">
                        <div class="title">
                            <div class="row">
                                <div class="col">
                                    <h1 class="text-light">Pesanan Penjualan</h1>
                                </div>
                                <div class="col">
                                    <i class="fa fa-hand-holding-usd fa-lg fa-5x"></i>
                                </div>
                            </div>
                        </div>
                        <div class="info">
                            <p class="card-text">
                            <h1 class="card-text display-5 text-white font-weight-bold">Pesanan Penjualan</h1>
                            <i class="fa fa-chart-line"></i>
                            </p>
                            <hr class="mr-1">
                            <p class="card-text">
                                Membuat pesanan penjualan untuk pelanggan
                            </p>
                            <p class="card-text">
                                <small class="text-light"></small>
                            </p>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-3 col-xl-3">
            <a href="{{ route('admin.pengiriman.index') }}">
                <div class="card bg-primary border-0 text-white shadow">
                    <div class="card-body">
                        <div class="title">
                            <div class="row">
                                <div class="col">
                                    <h1 class="text-light">Pengiriman Barang</h1>
                                </div>
                                <div class="col">
                                    <i class="fa fa-truck fa-lg fa-4x"></i>
                                </div>
                            </div>
                        </div>
                        <div class="info">
                            <p class="card-text">
                            <h1 class="card-text display-5 text-white font-weight-bold">Pengiriman Barang</h1>
                            <i class="fa fa-truck"></i>
                            </p>
                            <hr class="mr-1">
                            <p class="card-text">
                                Membuat pesanan pengiriman barang untuk pelanggan
                            </p>
                            <p class="card-text">
                                <small class="text-light"></small>
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
        <div class="col-md-4">
            <a href="{{ route('admin.bkk.index') }}">
                <div class="card bg-warning border-0 text-white">
                    <div class="card-body">
                        <div class="title">
                            <div class="row">
                                <div class="col-md-10">
                                    <h1 class="text-light">Pengeluaran</h1>
                                </div>
                                <div class="col-md-2">
                                    <i class="fa fa-hand-holding-usd fa-lg fa-5x"></i>
                                </div>
                            </div>
                        </div>
                        <div class="info">
                            <p class="card-text">
                            <h1 class="card-text display-5 text-white font-weight-bold">Pengeluaran</h1>
                            <i class="fa fa-hand-holding-usd"></i>
                            </p>
                            <hr class="mr-1">
                            <p class="card-text">
                                Mencatat pengeluaran kas/bank
                            </p>
                            <p class="card-text">
                                <small class="text-light"></small>
                            </p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('admin.bkm.index') }}">
                <div class="card bg-success border-0 text-white">
                    <div class="card-body">
                        <div class="title">
                            <div class="row">
                                <div class="col-md-10">
                                    <h1 class="text-light">Pemasukan</h1>
                                </div>
                                <div class="col-md-2">
                                    <i class="fa fa-hand-holding-usd fa-lg fa-5x"></i>
                                </div>
                            </div>
                        </div>
                        <div class="info">
                            <p class="card-text">
                            <h1 class="card-text display-5 text-white font-weight-bold">Pemasukan</h1>
                            <i class="fa fa-hand-holding-usd"></i>
                            </p>
                            <hr class="mr-1">
                            <p class="card-text">
                                Mencatat pemasukan kas/bank
                            </p>
                            <p class="card-text">
                                <small class="text-light"></small>
                            </p>
                        </div>
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
@if(request()->routeIs('admin.report.menu'))
@section('title', 'Report')
@push('breadcrumb')
<li class="breadcrumb-item active">Report</li>
@endpush
<section id="card-content-types">
    <div class="row">
        <div class="col-md-3 col-xl-3">
            <a href="{{ route('admin.report.keuangan.menu') }}">
                <div class="card border-0 text-white" style="background-color: #72147E;">
                    <div class="card-body">
                        <div class="title">
                            <div class="row">
                                <div class="col">
                                    <h1 class="text-light">Laporan Keuangan</h1>
                                </div>
                                <div class="col">
                                    <i class="fa fa-trello fa-lg fa-5x"></i>
                                </div>
                            </div>
                        </div>
                        <div class="info">
                            <p class="card-text">
                            <h1 class="card-text display-5 text-white font-weight-bold">Laporan Keuangan</h1>
                            <i class="fa fa-hand-holding-usd"></i>
                            </p>
                            <hr class="mr-1">
                            <p class="card-text">
                                Laporan Keuangan
                            </p>
                            <p class="card-text">
                                <small class="text-light"></small>
                            </p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3 col-xl-3">
            <a href="{{ route('admin.report.penjualandanpiutang.menu') }}">
                <div class="card border-0 text-white" style="background-color : #F21170">
                    <div class="card-body">
                        <div class="title">
                            <div class="row">
                                <div class="col">
                                    <h1 class="text-light">Laporan Penjualan dan Piutang</h1>
                                </div>
                                <div class="col">
                                    <i class="fa fa-hand-holding-usd fa-lg fa-5x"></i>
                                </div>
                            </div>
                        </div>
                        <div class="info">
                            <p class="card-text">
                            <h1 class="card-text display-5 text-white font-weight-bold">Laporan Penjualan dan Piutang</h1>
                            <i class="fa fa-hand-holding-usd"></i>
                            </p>
                            <hr class="mr-1">
                            <p class="card-text">
                                Laporan Penjualan dan Piutang
                            </p>
                            <p class="card-text">
                                <small class="text-light"></small>
                            </p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3 col-xl-3">
            <a href="{{ route('admin.report.pembeliandanutang.menu') }}">
                <div class="card border-0 text-white" style="background-color: #FA9905;">
                    <div class="card-body">
                        <div class="title">
                            <div class="row">
                                <div class="col">
                                    <h1 class="text-light">Laporan Pembelian dan Utang</h1>
                                </div>
                                <div class="col">
                                    <i class="fa fa-hand-holding-usd fa-lg fa-5x"></i>
                                </div>
                            </div>
                        </div>
                        <div class="info">
                            <p class="card-text">
                            <h1 class="card-text display-5 text-white font-weight-bold">Laporan Pembelian dan Utang</h1>
                            <i class="fa fa-hand-holding-usd"></i>
                            </p>
                            <hr class="mr-1">
                            <p class="card-text">
                                Laporan Pembelian dan Utang
                            </p>
                            <p class="card-text">
                                <small class="text-light"></small>
                            </p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3 col-xl-3">
            <a href="{{ route('admin.report.produk.menu') }}">
                <div class="card border-0 text-white" style="background-color: #FF5200;">
                    <div class="card-body">
                        <div class="title">
                            <div class="row">
                                <div class="col">
                                    <h1 class="text-light">Laporan Produk</h1>
                                </div>
                                <div class="col">
                                    <i class="fa fa-hand-holding-usd fa-lg fa-5x"></i>
                                </div>
                            </div>
                        </div>
                        <div class="info">
                            <p class="card-text">
                            <h1 class="card-text display-5 text-white font-weight-bold">Laporan Produk</h1>
                            <i class="fa fa-hand-holding-usd"></i>
                            </p>
                            <hr class="mr-1">
                            <p class="card-text">
                                Laporan Produk
                            </p>
                            <p class="card-text">
                                <small class="text-light"></small>
                            </p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
</section>
@endif
@endsection
