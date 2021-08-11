@extends('_layouts.main')
@section('title', 'Tambah Data Pinjaman')
@push('breadcrumb')
<li class="breadcrumb-item">
    <a href="{{ route('admin.simpanpinjam') }}">Simpan & Pinjam</a>
</li>
<li class="breadcrumb-item"><a href="{{ route('admin.pinjam.index') }}">Pinjam</a></li>
<li class="breadcrumb-item" aria-current="page">Tambah Pinjaman</li>
@endpush
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>Tambah Pinjaman</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.pinjam.detail') }}" class="needs-validation" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="validationCustom01">Jumlah Pinjaman</label>
                                <input name="besar_pinjam" class="form-control" id="validationCustom01" type="number" placeholder="Jumlah Pinjaman" required="">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="validationCustom02">Lama Angsuran (Bulan)</label>
                                <input name="jangka" class="form-control" id="validationCustom02" type="number" placeholder="Lama Angsuran (Bulan)" required="">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="validationCustomUsername">Bunga</label>
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text" id="inputGroupPrepend">%</span></div>
                                    <input name="bunga" class="form-control" id="validationCustomUsername" type="number" placeholder="Bunga" aria-describedby="inputGroupPrepend" required="">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="tipe_pinjaman">{{ __('Tipe Pinjaman') }}<span class="text-danger">*</span></label>
                                    <select name="tipe_pinjaman" id="tipe_pinjaman" class="form-control select2">

                                        <option value="Anuitas">Anuitas</option>
                                        <option value="Flat">Flat</option>
                                    </select>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="validationCustomUsername">Keterangan</label>
                                <textarea name="keterangan" class="form-control" required=""></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                        </div>
                        <button class="btn btn-primary" type="submit">Hitung</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
</div>
@endsection
