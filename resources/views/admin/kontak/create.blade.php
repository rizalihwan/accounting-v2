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
                            <span>Form tambah kontak person</span>
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
                                <a href="#">Tambah Kontak Person</a>
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
                        <h3>Tambah Jurnal Umum</h3>
                    </div>
                    <div class="card-body">
                        <form class="forms-sample" method="POST" action="#">
                            @csrf
                                <p><strong>Informasi Utama</strong></p>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="kode">{{ __('kode') }}<span class="text-red">*</span></label>
                                            <input id="kode" type="text"
                                                class="form-control @error('kode') is-invalid @enderror" name="kode"
                                                required>
                                            <div class="help-block with-errors"></div>
                                            @error('kode')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="nama">{{ __('nama') }}<span class="text-red">*</span></label>
                                            <input id="nama" type="text"
                                                class="form-control @error('nama') is-invalid @enderror" name="nama"
                                                required>
                                            <div class="help-block with-errors"></div>
                                            @error('nama')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="kategori">{{ __('kategori') }}<span class="text-red">*</span></label>
                                            <select name="kategori" id="" class="form-control @error('kategori') is-invalid @enderror" required>
                                                <option value="Tes">Tes</option>
                                            </select>
                                            <div class="help-block with-errors"></div>
                                            @error('kategori')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-4 mt-3">
                                        <div class="form-group">

                                        </div>
                                        <div class="form-group">
                                            <a href="kategorikontak" class="btn btn-danger">Tambah Kategori</a>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <p><strong>Informasi Tambahan</strong></p>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="alamat">alamat<span class="text-red">*</span></label>
                                            <textarea name="alamat" id="alamat" class="form-control @error('alamat') is-invalid @enderror"required>

                                            </textarea>
                                            <div class="help-block with-errors"></div>
                                            @error('alamat')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="kota">kota<span class="text-red">*</span></label>
                                            <input id="kota" type="text"
                                                class="form-control @error('kota') is-invalid @enderror" name="kota"
                                                required>
                                            <div class="help-block with-errors"></div>
                                            @error('kota')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="kode_pos">kode pos<span class="text-red">*</span></label>
                                            <input id="kode_pos" type="text"
                                                class="form-control @error('kode_pos') is-invalid @enderror" name="kode_pos"
                                                required>
                                            <div class="help-block with-errors"></div>
                                            @error('kode_pos')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="telepon">telepon<span class="text-red">*</span></label>
                                            <input id="telepon" type="text"
                                                class="form-control @error('telepon') is-invalid @enderror" name="telepon"
                                                required>
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
                                            <label for="fax">fax<span class="text-red">*</span></label>
                                            <input id="fax" type="text"
                                                class="form-control @error('fax') is-invalid @enderror" name="fax"
                                                required>
                                            <div class="help-block with-errors"></div>
                                            @error('fax')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="bank">bank<span class="text-red">*</span></label>
                                            <input id="bank" type="text"
                                                class="form-control @error('bank') is-invalid @enderror" name="bank"
                                                required>
                                            <div class="help-block with-errors"></div>
                                            @error('bank')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="ac">A/C<span class="text-red">*</span></label>
                                            <input id="ac" type="text"
                                                class="form-control @error('ac') is-invalid @enderror" name="ac"
                                                required>
                                            <div class="help-block with-errors"></div>
                                            @error('ac')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="catatan">catatan<span class="text-red">*</span></label>
                                            <input id="catatan" type="text"
                                                class="form-control @error('catatan') is-invalid @enderror" name="catatan"
                                                required>
                                            <div class="help-block with-errors"></div>
                                            @error('catatan')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12 mt-4">
                                        <div class="form-group">
                                            <a href="{{ route('admin.jurnalumum.index') }}" class="btn btn-danger">KEMBALI</a>
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
