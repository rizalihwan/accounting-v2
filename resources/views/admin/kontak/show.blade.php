@extends('_layouts.main')
@section('title', 'Data Bank')
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 margin-tb mb-5">
            <div class="pull-left">
                <h2> Show Data Kontak</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('admin.kontak.index') }}"> Back</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nama:</strong>
                {{ $kontak->nama }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Email:</strong>
                {{ $kontak->email }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Telepon:</strong>
                {{ $kontak->telepon }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Tipe:</strong>
                {{ $kontak->pelanggan ? 'Pelanggan' . ($kontak->pemasok == true || $kontak->karyawan == true ? ', ' : '') : '' }}
                {{ $kontak->pemasok ? 'Pemasok' . ($kontak->pelanggan == true || $kontak->karyawan == true ? ', ' : '') : '' }}
                {{ $kontak->karyawan ? 'Karyawan' . ($kontak->pelanggan == true || $kontak->pemasok == true ? ', ' : '') : '' }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Alamat:</strong>
                {{ $kontak->alamat }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Kota:</strong>
                {{ $kontak->kota }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Kode Pos:</strong>
                {{ $kontak->kode_pos }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Kode Kontak:</strong>
                {{ $kontak->kode_kontak }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Mata Uang:</strong>
                {{ $kontak->mata_uang }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>NIK:</strong>
                {{ $kontak->nik }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Kontak Person:</strong>
                {{ $kontak->kontak_person }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Website:</strong>
                {{ $kontak->website }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>
                    @if($kontak->aktif === 1)
                        Akun Ini Aktif
                    @else
                        Akun ini tidak aktif
                    @endif
                </strong>
            </div>
        </div>
    </div>
</div>
@endsection
