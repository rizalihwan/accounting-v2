@extends('_layouts.main')

@push('head')
    <style>
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
    @if (request()->routeIs('admin.data-store'))
        @include('menus.data-master')
    @endif

    @if (request()->routeIs('admin.ledger'))
        @include('menus.jurnal')
    @endif

    @if(request()->routeIs('admin.sales.'))
        @include('menus.penjualan')
    @endif

    @if (request()->routeIs('admin.purchase.'))
        @include('menus.pembelian')
    @endif

    @if (request()->routeIs('admin.cash-bank'))
        @include('menus.kas-bank')
    @endif

    @if (request()->routeIs('admin.simpanpinjam'))
        @section('title', 'Simpan Pinjam')
        @push('breadcrumb')
            <li class="breadcrumb-item active">Simpan Pinjam</li>
        @endpush
        @include('menus.simpan-pinjam')
    @endif

    @if (request()->routeIs('admin.report.menu'))
        @include('menus.laporan')
    @endif
@endsection
