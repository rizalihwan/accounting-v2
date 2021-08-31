@extends('_layouts.main')
@section('title', 'Import Data Pinjaman')
@push('breadcrumb')
<li class="breadcrumb-item">
    <a href="{{ route('admin.simpanpinjam') }}">Simpan & Pinjam</a>
</li>
<li class="breadcrumb-item"><a href="{{ route('admin.pinjam.index') }}">Pinjam</a></li>
<li class="breadcrumb-item" aria-current="page">Import Pinjaman</li>
@endpush
@section('content')
<div class="row">
    <div class="col-sm-3">
        @if ($errors->any())
        <div class="alert alert-danger alert-dismissible" role="alert" onload="focus()">
            <div class="alert-body">
                @foreach ($errors->all() as $error)
                <ul style="margin: 0 12px 0 -11px">
                    <li>{{ $error }}</li>
                </ul>
                @endforeach
            </div>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        <div class="card">
            <div class="card-header">
                <h5>Import Pinjaman</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <form action="{{ route('admin.pinjam.import') }}" class="needs-validation" method="POST" enctype="multipart/form-data">
                        <div class="col-sm-12">
                            <div class="form-group">
                                @csrf
                                <label for="import">Import Pinjaman <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input name="import" class="form-control" id="import" type="file" value="{{ old('import') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <button class="btn btn-primary" type="submit">Import</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="card shadow">
            <div class="card-header">
                <h3 class="card-title">Kontak Id</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nama</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($kontak as $data)
                            <tr>
                                <td>{{ $data->id }}</td>
                                <td>{{ $data->nama }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="card shadow">
            <div class="card-header">
                <h3 class="card-title">
                    Berikut contoh Format Import Excel yang benar dan berurutan:</h3>
            </div>
            <div class="card-body">
                <ol>
                    <li>
                        <p class="text-info">
                            Pastikan format excel sesuai dengan format sql dibawah ini:
                        </p>
                        <img src="{{ asset('tutorial/pinjam1.jpeg') }}" class="img-thumbnail" alt="">
                    </li>
                    <li>
                        <p class="text-info">
                            Pastikan data dimulai dari Row satu(header bawaan dihapus)
                            Berikut contoh Format Import Excel yang benar dan berurutan:
                        </p>
                        <img src="{{ asset('tutorial/pinjam2.jpeg') }}" class="img-thumbnail" alt="">
                    </li>
                    <li>
                        Tipe:
                        <ul>
                            <li>Anuitas</li>
                            <li>Flat</li>
                        </ul>
                    </li>
                </ol>
            </div>
        </div>
    </div>
</div>
@endsection
