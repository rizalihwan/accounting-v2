@extends('_layouts.main')
@section('title', 'Data Bank')
    @push('breadcrumb')
        <li class="breadcrumb-item">
            <a href="{{ route('admin.data-store') }}">Data Master</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('admin.akun.index') }}">Data Bank</a>
        </li>
        <li class="breadcrumb-item active">Detail Data</li>
    @endpush
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 margin-tb mb-5">
            <div class="pull-left">
                <h2> Show Data Bank</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('admin.bank.index') }}"> Back</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Kode:</strong>
                {{ $bank->kode }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nama:</strong>
                {{ $bank->nama_bank }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Alamat:</strong>
                {{ $bank->alamat }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Kota:</strong>
                {{ $bank->kota }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Telepon:</strong>
                {{ $bank->telepon }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Fax:</strong>
                {{ $bank->fax }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Kontak:</strong>
                {{ $bank->kontak }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Kontak Jabatan:</strong>
                {{ $bank->kontak_jabatan }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Catatan:</strong>
                {{ $bank->catatan }}
            </div>
        </div>
    </div>
</div>
@endsection
