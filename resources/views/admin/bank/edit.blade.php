@extends('_layouts.main')
@section('title', 'Data Bank')
    @push('breadcrumb')
        <li class="breadcrumb-item">Data Bank</li>
        <li class="breadcrumb-item active">Edit Data Bank</li>
    @endpush
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-header">
                        <h3>Edit Data Bank</h3>
                    </div>
                    <div class="card-body">
                        <form class="forms-sample" method="POST" action="{{ route('admin.bank.update',$bank->id) }}">
                            @csrf
                            @method('PUT')
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="kode">Kode<span class="text-red">*</span></label>
                                            <input id="kode" type="text"
                                                class="form-control @error('kode') is-invalid @enderror" name="kode"
                                                value="{{$bank->kode}}" required>
                                            <div class="help-block with-errors"></div>
                                            @error('kode')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="nama_bank">Nama<span class="text-red">*</span></label>
                                            <input id="nama_bank" type="text"
                                                class="form-control @error('nama_bank') is-invalid @enderror" name="nama_bank"
                                                value="{{$bank->nama_bank}}" required>
                                            <div class="help-block with-errors"></div>
                                            @error('nama_bank')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="alamat">alamat</label>
                                            <textarea name="alamat" id="alamat"
                                                class="form-control @error('alamat') is-invalid @enderror">{{$bank->alamat}}</textarea>
                                            <div class="help-block with-errors"></div>
                                            @error('alamat')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="kota">Kota</label>
                                            <input id="kota" type="text"
                                                class="form-control @error('kota') is-invalid @enderror" name="kota" value="{{$bank->kota}}">
                                            <div class="help-block with-errors"></div>
                                            @error('kota')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="telepon">Telepon</label>
                                            <input id="telepon" type="text" autocomplete="off"
                                                class="form-control @error('telepon') is-invalid @enderror" name="telepon"
                                                onkeypress="return hanyaAngka(event)" minlength="11" maxlength="16" value="{{$bank->telepon}}">
                                            <div class="help-block with-errors"></div>
                                            @error('telepon')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="fax">Fax</label>
                                            <input id="fax" type="text"
                                                class="form-control @error('fax') is-invalid @enderror" name="fax" value="{{$bank->fax}}">
                                            <div class="help-block with-errors"></div>
                                            @error('fax')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="kontak">Kontak</label>
                                            <input id="kontak" type="text"
                                                class="form-control @error('kontak') is-invalid @enderror" name="kontak" value="{{$bank->kontak}}">
                                            <div class="help-block with-errors"></div>
                                            @error('kontak')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="kontak_jabatan">Kontak Jabatan</label>
                                            <input id="kontak_jabatan" type="text"
                                                class="form-control @error('kontak_jabatan') is-invalid @enderror" name="kontak_jabatan" value="{{$bank->kontak_jabatan}}">
                                            <div class="help-block with-errors"></div>
                                            @error('kontak_jabatan')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="catatan">Catatan</label>
                                            <input id="catatan" type="text"
                                                class="form-control @error('catatan') is-invalid @enderror" name="catatan" value="{{$bank->catatan}}">
                                            <div class="help-block with-errors"></div>
                                            @error('catatan')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 mt-4">
                                        <div class="form-group">
                                            <a href="{{ route('admin.bank.index') }}" class="btn btn-danger">KEMBALI</a>
                                            <button type="submit" class="btn btn-primary">
                                                UPDATE</button>
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

@push('script')
    <script>
        function hanyaAngka(e){
            let charCode = (e.which) ? e.which : e.keyCode
            if (charCode > 32 && (charCode < 48 || charCode > 57)) {
                return false
            }
            return true
        }
    </script>
@endpush
