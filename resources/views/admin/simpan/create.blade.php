@extends('_layouts.main')
@section('title', 'Tambah Data Simpan')
@push('breadcrumb')
<li class="breadcrumb-item">
    <a href="{{ route('admin.simpanpinjam') }}">Simpan & Pinjam</a>
</li>
<li class="breadcrumb-item"><a href="{{ route('admin.simpan.index') }}">Simpan</a></li>
<li class="breadcrumb-item" aria-current="page">Tambah Simpanan</li>
@endpush
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>Tambah Simpanan</h5>
                </div>
                <div class="card-body">
                    <form action="" class="needs-validation" method="POST">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nama_simpanan">Nama Simpanan</label>
                                <input name="nama_simpanan" class="form-control" id="nama_simpanan" type="number" placeholder="Nama Simpanan" required="">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="no_rekening">No Rekening</label>
                                <input name="no_rekening" class="form-control" id="no_rekening" type="number" placeholder="No Rekening" required="">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="administrasi">Administrasi</label>
                                <input name="administrasi" class="form-control" id="administrasi" type="number" placeholder="Administrasi" required="">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="setoran">Setoran</label>
                                <input name="setoran" class="form-control" id="setoran" type="number" placeholder="Setoran" required="">
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label for="nasabah_id">{{ __('Nomor Anggota') }}<span class="text-danger">*</span></label>
                                    <select name="nasabah_id" id="nasabah_id" class="form-control select2">
                                        {{-- DISINI ngambil dari kode kontak kosna --}}
                                        <option value="1">1180</option>
                                        <option value="2">1190</option>
                                    </select>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="nama">Nama</label>
                                <input disabled name="nama" class="form-control" id="nama" type="number" placeholder="Nama" required="">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="alamat">Alamat</label>
                                <input disabled name="alamat" class="form-control" id="alamat" type="number" placeholder="Alamat" required="">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="pekerjaan">Pekerjaan</label>
                                <input disabled name="pekerjaan" class="form-control" id="pekerjaan" type="number" placeholder="Pekerjaan" required="">
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label for="petugas_id">{{ __('Petugas') }}<span class="text-danger">*</span></label>
                                    <select name="petugas_id" id="petugas_id" class="form-control select2">

                                        <option value="1">Petugas 1</option>
                                        <option value="2">petugas 2</option>
                                    </select>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
