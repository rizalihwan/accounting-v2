@extends('_layouts.main')
@section('title', 'Kontak')
@section('content')
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-user-plus bg-blue"></i>
                        <div class="d-inline">
                            <h5>Kontak</h5>
                            <span>Form tambah Product</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('home') }}"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">Tambah Product</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-header">
                        <h3>Tambah Product</h3>
                    </div>
                    <div class="card-body">
                        <form class="forms-sample" method="POST" action="{{ route('admin.kontak.store') }}">
                            @csrf
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="name">{{ __('Nama Product') }}<span class="text-red">*</span></label>
                                        <input id="name" type="text"
                                            class="form-control @error('name') is-invalid @enderror" name="name" required>
                                        <div class="help-block with-errors"></div>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="category_id">{{ __('Kategori Product') }}</label><span class="text-red">*</span></label>
                                        <select name="category_id" id="category_id"
                                            class="form-control @error('category_id') is-invalid @enderror">
                                            @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        <div class="help-block with-errors"></div>
                                        @error('category_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="supplier_id">{{ __('Vendor') }}</label><span class="text-red">*</span></label>
                                        <select name="supplier_id" id="supplier_id"
                                            class="form-control @error('supplier_id') is-invalid @enderror">
                                            @foreach ($suppliers as $supplier)
                                            <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                            @endforeach
                                        </select>
                                        <div class="help-block with-errors"></div>
                                        @error('supplier_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="unit_id">{{ __('Satuan Product') }}</label><span class="text-red">*</span></label>
                                        <select name="unit_id" id="unit_id"
                                            class="form-control @error('unit_id') is-invalid @enderror">
                                            {{-- @foreach ($suppliers as $supplier)
                                            <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                            @endforeach --}}
                                            <option value="1">KG</option>
                                        </select>
                                        <div class="help-block with-errors"></div>
                                        @error('unit_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div> 
                                
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="price_buy">{{ __('Harga Beli') }}<span class="text-red">*</span></label>
                                        <input id="price_buy" type="text"
                                            class="form-control @error('price_buy') is-invalid @enderror" name="price_buy" required>
                                        <div class="help-block with-errors"></div>
                                        @error('price_buy')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="price_sell">{{ __('Harga Jual') }}<span class="text-red">*</span></label>
                                        <input id="price_sell" type="text"
                                            class="form-control @error('price_sell') is-invalid @enderror" name="price_sell" required>
                                        <div class="help-block with-errors"></div>
                                        @error('price_sell')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>


                            </div>
                                <div class="col-md-12 mt-4">
                                    <div class="form-group">
                                        <a href="{{ route('admin.kontak.index') }}"
                                            class="btn btn-danger">KEMBALI</a>
                                        <button type="submit" class="btn btn-primary">
                                            TAMBAH</button>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
