@extends('_layouts.main')
@section('title', 'Data Product')
@push('breadcrumb')
<li class="breadcrumb-item">
    <a href="{{ route('admin.data-store') }}">Data Master</a>
</li>
<li class="breadcrumb-item">
    <a href="{{ route('admin.product.index') }}">Produk</a>
</li>
<li class="breadcrumb-item" aria-current="page">Show Produk</li>
@endpush
@section('content')

<div class="row">
    <div class="card">
        <!-- Product Details starts -->
        <div class="card-body">
            <div class="row my-2">
                <div class="col-12 col-md-12">
                    <h4>{{ $product->name }}</h4>
                    <span class="card-text item-company">Supplier <a href="javascript:void(0)"
                            class="company-name">{{ $product->supplier->nama }}</a></span>
                    <div class="ecommerce-details-price d-flex flex-wrap mt-1">
                        <h4 class="item-price mr-1">Harga Beli : {{ 'Rp. ' . number_format($product->price_buy, 0, ',', '.') }}</h4>
                        <h4 class="item-price mr-1">Harga Jual : {{ 'Rp. ' . number_format($product->price_sell, 0, ',', '.') }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
