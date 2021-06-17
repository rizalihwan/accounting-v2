@extends('_layouts.main')
@section('title', 'Jurnal Umum')
@push('breadcrumb')
<li class="breadcrumb-item">
    <a href="{{ route('admin.sales') }}">Penjualan</a>
</li>
<li class="breadcrumb-item">
    <a href="{{ route('admin.penawaran.index') }}">Penawaran Harga</a>
</li>
<li class="breadcrumb-item" aria-current="page">Tambah Penawaran Harga</li>
@endpush
@section('content')
<div class="row">
    <div class="col-md-12">
        <form class="forms-sample" class="invoice-repeater" action="{{ route('admin.penawaran.store') }}" method="POST">
            <div class="card ">
                <div class="card-body">
                    @csrf
                    <input type="hidden" name="kode" value="{{ $kode }}">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="tanggal">{{ __('Tanggal') }}<span class="text-red">*</span></label>
                                <input id="tanggal" type="date" value="{{ date('Y-m-d') }}"
                                    class="form-control @error('tanggal') is-invalid @enderror" name="tanggal">
                                <div class="help-block with-errors"></div>
                                @error('tanggal')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="kode">{{ __('Kode Penawaran') }}<span class="text-red">*</span></label>
                                <input class="form-control" id="kode" type="text" value="{{ $kode }}" name="kode"
                                    readonly>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="pelanggan_id">{{ __('Pelanggan') }}<span class="text-red">*</span></label>
                                <select name="pelanggan_id" id="pelanggan_id" class="form-control select2 @error('pelanggan_id') is-invalid @enderror">
                                    @foreach($pelanggan as $pel)
                                        <option value="{{ $pel->id }}"> {{ $pel->nama }} </option>
                                    @endforeach
                                </select>
                                <div class="help-block with-errors"></div>
                                @error('pelanggan_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-3" style="margin-top: 8px">
                            <div class="form-group"></div>
                            <div class="form-group">
                                <a href="{{ route('admin.kontak.create') }}" class="btn btn-danger">
                                    <i data-feather="plus"></i>
                                    TAMBAH Pelanggan
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card ">
                <div class="card-body">
                    <div class="invoice-repeater">
                        <div data-repeater-list="invoice">

                            <div data-repeater-item="" style="">
                                <div class="row d-flex align-items-end">
                                    <div class="col-md-2 col-12">
                                        <div class="form-group">
                                        <label for="product_id">{{ __('Product') }}</label>
                                        <select name="product_id" class="form-control select2" id="product_id">
                                        </select>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-2 col-12">
                                        <div class="form-group">
                                            <label for="itemquantity">Jumlah</label>
                                            <input type="number" class="form-control" id="itemquantity"
                                                aria-describedby="itemquantity" placeholder="1">
                                        </div>
                                    </div>

                                    <div class="col-md-2 col-12">
                                        <div class="form-group">
                                            <label for="itemcost">Satuan Ukur</label>
                                            <input type="text" class="form-control" id="unit"
                                                aria-describedby="itemcost" readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-2 col-12">
                                        <div class="form-group">
                                            <label for="itemcost">Harga Satuan</label>
                                            <input type="text" class="form-control" id="price_sell"
                                                aria-describedby="itemcost" readonly>
                                        </div>
                                    </div>


                                    <div class="col-md-2 col-12">
                                        <div class="form-group">
                                            <label for="staticprice">Total</label>
                                            <input type="text" readonly="" class="form-control"
                                                id="staticprice">
                                        </div>
                                    </div>

                                    <div class="col-md-2 col-12 mb-50">
                                        <div class="form-group">
                                            <button class="btn btn-outline-danger text-nowrap px-1 waves-effect"
                                                data-repeater-delete="" type="button">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-x mr-25">
                                                    <line x1="18" y1="6" x2="6" y2="18"></line>
                                                    <line x1="6" y1="6" x2="18" y2="18"></line>
                                                </svg>
                                                <span>Hapus</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <button class="btn btn-icon btn-primary waves-effect waves-float waves-light"
                                    type="button" data-repeater-create="">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-plus mr-25">
                                        <line x1="12" y1="5" x2="12" y2="19"></line>
                                        <line x1="5" y1="12" x2="19" y2="12"></line>
                                    </svg>
                                    <span>Tambah Baru</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
        <hr>
        <div class="col-md-12 mt-4">
            <div class="form-group">
                <a href="{{ route('admin.jurnalumum.index') }}" class="btn btn-danger">KEMBALI</a>
                <button type="submit" class="btn btn-primary" id="btn-submit">
                    TAMBAH</button>
            </div>
        </div>
    </div>
</div>
</form>
</div>
</div>
@endsection

@push('select2')
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/forms/select/select2.min.css') }}">
@endpush
@push('head')
<style>
    .select2 {
        width: 100% !important;
    }

</style>
@endpush

@push('script')
<script src="{{ asset('plugins/jquery.repeater/jquery.repeater.min.js') }}"></script>
<script src="{{ asset('app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
<script src="{{ asset('app-assets/js/scripts/forms/form-select2.min.js') }}"></script>
<script>
    let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content')

    $(document).ready(function () {
        $("#pelanggan_id").select2({
            placeholder: "Pilih Pelanggan",
        });

        $("#product_id").select2({
            placeholder: "Pilih Product",
        })
    });

</script>
@endpush
