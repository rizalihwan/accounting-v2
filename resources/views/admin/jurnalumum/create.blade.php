@extends('_layouts.main')
@section('title', 'Jurnal Umum')
@section('content')
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-user-plus bg-blue"></i>
                        <div class="d-inline">
                            <h5>Jurnal Umum</h5>
                            <span>Form tambah jurnal umum</span>
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
                                <a href="{{ route('admin.jurnalumum.create') }}">Tambah Jurnal Umum</a>
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
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="tanggal">{{ __('Tanggal') }}<span class="text-red">*</span></label>
                                            <input id="tanggal" type="date"
                                                class="form-control @error('tanggal') is-invalid @enderror" name="tanggal"
                                                required>
                                            <div class="help-block with-errors"></div>
                                            @error('tanggal')
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
                                            <label for="kontak">{{ __('Kontak') }}<span class="text-red">*</span></label>
                                            <select name="kontak" id="" class="form-control @error('kontak') is-invalid @enderror" required>
                                                <option value="Tes">Tes</option>
                                            </select>
                                            <div class="help-block with-errors"></div>
                                            @error('kontak')
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
                                            <a href="{{ route('admin.kontak.create') }}" class="btn btn-danger">Tambah Kontak</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="nama_akun">Nama Akun<span class="text-red">*</span></label>
                                            <select name="nama_akun" id="nama_akun"
                                                class="form-control @error('nama_akun') is-invalid @enderror">
                                                <option disabled selected>-- Pilih --</option>
                                                <option value="tono">tono</option>
                                            </select>
                                            <div class="help-block with-errors"></div>
                                            @error('nama_akun')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="debit">Debit<span class="text-red">*</span></label>
                                            <input id="debit" type="text"
                                                class="form-control @error('debit') is-invalid @enderror" name="debit"
                                                required>
                                            <div class="help-block with-errors"></div>
                                            @error('debit')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="kredit">Kredit<span class="text-red">*</span></label>
                                            <input id="kredit" type="text"
                                                class="form-control @error('kredit') is-invalid @enderror" name="kredit"
                                                required>
                                            <div class="help-block with-errors"></div>
                                            @error('kredit')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="catatan">Catatan<span class="text-red">*</span></label>
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

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="kurs">kurs<span class="text-red">*</span></label>
                                            <input id="kurs" type="number"
                                                class="form-control @error('kurs') is-invalid @enderror" name="kurs" required>
                                            <div class="help-block with-errors"></div>
                                            @error('kurs')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="valas">Valas<span class="text-red">*</span></label>
                                            <input id="kuvalasrs" type="number"
                                                class="form-control @error('valas') is-invalid @enderror" name="valas" required>
                                            <div class="help-block with-errors"></div>
                                            @error('valas')
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
