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
                        <h3>Tambah Kontak Person</h3>
                    </div>
                    <div class="card-body">
                        <form class="forms-sample" method="POST" action="{{ route('admin.kontak.store') }}">
                            @csrf
                            <p><strong>Umum</strong></p>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="nama">{{ __('nama') }}<span class="text-red">*</span></label>
                                        <input id="nama" type="text"
                                            class="form-control @error('nama') is-invalid @enderror" name="nama" required>
                                        <div class="help-block with-errors"></div>
                                        @error('nama')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="email">{{ __('email') }}<span class="text-red">*</span></label>
                                        <input id="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror" name="email" required>
                                        <div class="help-block with-errors"></div>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="telepon">telepon<span class="text-red">*</span></label>
                                        <input id="telepon" type="text"
                                            class="form-control @error('telepon') is-invalid @enderror" name="telepon">
                                        <div class="help-block with-errors"></div>
                                        @error('telepon')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="border-checkbox-section">
                                            <div class="border-checkbox-group border-checkbox-group-primary">
                                                <input class="border-checkbox" type="checkbox" id="pelanggan" name="pelanggan" checked>
                                                <label class="border-checkbox-label" for="pelanggan">{{ __('Pelanggan')}}</label>
                                            </div>
                                            <div class="border-checkbox-group border-checkbox-group-primary">
                                                <input class="border-checkbox" type="checkbox" id="pemasok" name="pemasok" checked>
                                                <label class="border-checkbox-label" for="Pemasok">{{ __('Pemasok')}}</label>
                                            </div>
                                            <div class="border-checkbox-group border-checkbox-group-primary">
                                                <input class="border-checkbox" type="checkbox" id="karyawan" name="karyawan" checked>
                                                <label class="border-checkbox-label" for="karyawan">{{ __('Karyawan')}}</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <p><strong>Alamat</strong></p>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="alamat">alamat</label>
                                        <textarea name="alamat" id="alamat"
                                            class="form-control @error('alamat') is-invalid @enderror">

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
                                        <label for="kota">kota</label>
                                        <input id="kota" type="text"
                                            class="form-control @error('kota') is-invalid @enderror" name="kota">
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
                                        <label for="kode_pos">kode pos</label>
                                        <input id="kode_pos" type="text"
                                            class="form-control @error('kode_pos') is-invalid @enderror" name="kode_pos">
                                        <div class="help-block with-errors"></div>
                                        @error('kode_pos')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <p><strong>Data Lainnya</strong></p>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="kode_kontak">Kode Kontak</label>
                                        <input id="kode_kontak" type="text"
                                            class="form-control @error('kode_kontak') is-invalid @enderror" name="kode_kontak">
                                        <div class="help-block with-errors"></div>
                                        @error('kode_kontak')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="mata_uang">{{ __('Mata Uang') }}</label>
                                        <select name="mata_uang" id="mata_uang"
                                            class="form-control @error('mata_uang') is-invalid @enderror">
                                            <option value="IDR">IDR</option>
                                        </select>
                                        <div class="help-block with-errors"></div>
                                        @error('mata_uang')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-sm-12 col-xl-4 mb-30">
                                    <p><strong>Aktif</strong></p>
                                    <input type="checkbox" class="js-single" checked />
                                </div>
                            </div>


                                <div class="col-md-12 mt-4">
                                    <div class="form-group">
                                        <a href="{{ route('admin.jurnalumum.index') }}"
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
