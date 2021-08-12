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
                    @if ($errors->any())
                        <div class="alert alert-danger alert-validation-msg" role="alert">
                            <div class="alert-body">
                                @foreach ($errors->all() as $error)
                                <ul style="margin: 5px 12px 0 -11px">
                                    <li>{{ $error }}</li>
                                </ul>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.simpan.store') }}" class="needs-validation" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="jenis_simpanan">Jenis Simpanan</label>
                                <input name="jenis_simpanan" class="form-control" id="jenis_simpanan" type="text"
                                    placeholder="Jenis Simpanan">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="no_rekening">No Rekening</label>
                                <input name="no_rekening" class="form-control" id="no_rekening" type="number"
                                    placeholder="No Rekening" required="">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="administrasi">Administrasi</label>
                                <input name="administrasi" class="form-control" id="administrasi" type="number"
                                    placeholder="Administrasi" required="">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="setoran">Setoran</label>
                                <input name="setoran" class="form-control" id="setoran" type="number"
                                    placeholder="Setoran" required="">
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label for="kontak_id">{{ __('Nomor Anggota') }}<span
                                            class="text-danger">*</span></label>
                                    <select name="kontak_id" id="kontak_id" class="form-control select2">
                                        <option disabled selected>-- Pilih Nomor Anggota --</option>
                                        @foreach ($contacts as $key)
                                            <option value="{{ $key->id }}">{{ $key->kode_kontak }}</option>
                                        @endforeach
                                    </select>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="nama">Nama</label>
                                <input disabled name="nama" class="form-control" id="nama" type="number"
                                    placeholder="Nama" required="">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="alamat">Alamat</label>
                                <input disabled name="alamat" class="form-control" id="alamat" type="number"
                                    placeholder="Alamat" required="">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="pekerjaan">Pekerjaan</label>
                                <input disabled name="pekerjaan" class="form-control" id="pekerjaan" type="number"
                                    placeholder="Pekerjaan" required="">
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="petugas">{{ __('Petugas') }}<span
                                            class="text-danger">*</span></label>
                                    <select name="petugas" id="petugas" class="form-control select2">
                                        <option disabled selected>-- Pilih Petugas --</option>
                                        @foreach ($petugas as $id => $key)
                                            <option value="{{ $key }}">{{ $key }}</option>
                                        @endforeach
                                    </select>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="keterangan">Keterangan</label>
                                <textarea name="keterangan" id="keterangan" rows="2" class="form-control"></textarea>
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
