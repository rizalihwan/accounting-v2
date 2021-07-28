@extends('_layouts.main')
@section('title', 'Data Product')
@push('breadcrumb')
<li class="breadcrumb-item">
    <a href="{{ route('admin.data-store') }}">Data Master</a>
</li>
<li class="breadcrumb-item">
    <a href="{{ route('admin.product.index') }}">Produk</a>
</li>
<li class="breadcrumb-item" aria-current="page">Edit Produk</li>
@endpush
@section('content')

<div class="row">
    <div class="col-lg-12 col-md-12 col-12">
        <div class="card text-center mb-3">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs ml-0" id="nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                            aria-controls="home" aria-selected="false">Data</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#image" role="tab"
                            aria-controls="image" aria-selected="true">Gambar</a>
                    </li>
                </ul>
            </div>
            <form class="form form-horizontal" action="{{ route('admin.product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="card-body">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade active show" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-sm-2 col-form-label">
                                            <label for="name">Nama Produk</label>
                                        </div>
                                        <div class="col-sm-10">
                                            <input type="text" id="first-name"
                                                class="form-control @error('name') is-invalid @enderror" name="name"
                                                placeholder="Nama Produk" value="{{ $product->name }}">

                                            @error('name')
                                            <div class="d-block invalid-feedback"> {{ $message }} </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-sm-2 col-form-label">
                                            <label for="price_buy">Harga Beli</label>
                                        </div>
                                        <div class="col-sm-10">
                                            <input type="text" id="price_buy"
                                                class="form-control @error('price_buy') is-invalid @enderror"
                                                name="price_buy" placeholder="Harga Jual"
                                                value="{{ $product->price_buy }}">

                                            @error('price_buy')
                                            <span class="d-block invalid-feedback"> {{ $message }} </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-sm-2 col-form-label">
                                            <label for="price_sell">Harga Jual</label>
                                        </div>
                                        <div class="col-sm-10">
                                            <input type="text" id="price_sell"
                                                class="form-control @error('price_sell') is-invalid @enderror"
                                                name="price_sell" placeholder="Harga Jual"
                                                value="{{ $product->price_sell }}">

                                            @error('price_sell')
                                            <span class="d-block invalid-feedback"> {{ $message }} </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-sm-2 col-form-label">
                                            <label for="unit_id">Satuan Product</label>
                                        </div>
                                        <div class="col-sm-10">
                                            <select class="select2 form-control form-control" name="unit_id">
                                                @foreach ($units as $unit )
                                                    <option value="{{ $unit->id }}" {{$product->unit_id == $unit->id ? 'selected' : ''}}> {{ $unit->name }} </option>
                                                @endforeach
                                            </select>

                                            @error('unit_id')
                                            <div class="d-block invalid-feedback"> {{ $message }} </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-sm-2 col-form-label">
                                            <label for="category_id">Kategori Produk</label>
                                        </div>
                                        <div class="col-sm-10">
                                            <select class="select2 form-control form-control" name="category_id">
                                                @foreach ($categories as $category )
                                                    <option value="{{ $category->id }}" {{$product->category_id == $category->id ? 'selected' : ''}}> {{ $category->name }} </option>
                                                @endforeach
                                            </select>

                                            @error('category_id')
                                            <div class="d-block invalid-feedback"> {{ $message }} </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-sm-2 col-form-label">
                                            <label for="suppplier_id">Supplier</label>
                                        </div>
                                        <div class="col-sm-10">
                                            <select class="select2 form-control form-control" name="supplier_id">
                                                @foreach ($suppliers as $sup )
                                                    <option value="{{ $sup->id }}" {{$product->supplier_id == $sup->id ? 'selected' : ''}}> {{ $sup->nama }} </option>
                                                @endforeach
                                            </select>

                                            @error('suppplier_id')
                                            <div class="d-block invalid-feedback"> {{ $message }} </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="tab-pane fade" id="image" role="tabpanel" aria-labelledby="image-tab">
                            @forelse ( $images as $image )
                                <img src="{{ asset('storage/images/product/'. $image->image) }}" alt="{{$image->image}}">
                            @empty
                                <p>Tidak memiliki photo</p>
                            @endforelse
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <button class="btn btn-primary shadow" type="submit">Update</button>
                    <a href="{{ route('admin.product.index') }}" class="btn btn-secondary shadow">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection

@push('select2')
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/forms/select/select2.min.css') }}">
@endpush

@push('script')
<script src="{{ asset('app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
<script src="{{ asset('app-assets/js/scripts/forms/form-select2.min.js') }}"></script>
<script>
    $(function () {
			$('.select2').select2();
		})
</script>
<script src="{{ asset('js/helpers.js') }}"></script>
<script>
    const sell = document.getElementById('price_sell');
    const buy = document.getElementById('price_buy');

    sell.addEventListener('keyup', function (e) {
        sell.value = formatRupiah(this.value, "Rp. ");
    });

    buy.addEventListener('keyup', function (e) {
        buy.value = formatRupiah(this.value, "Rp. ");
    });

</script>
@endpush
