@extends('_layouts.main')
@section('title', 'Subklasifikasi')
    @push('breadcrumb')
        <li class="breadcrumb-item">Subklasifikasi Akun</li>
        <li class="breadcrumb-item active">Tambah Subklasifikasi</li>
    @endpush
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-header">
                        <h3>Tambah subklasifikasi Kontak</h3>
                    </div>
                    <div class="card-body">
                        <form class="forms-sample" method="POST" action="{{ route('admin.subklasifikasi.store') }}">
                            @csrf
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">    
                                        <label for="name">{{ __('Name') }}<span class="text-red">*</span></label>
                                        <input id="name" type="text"
                                            class="form-control @error('name') is-invalid @enderror" name="name"
                                            required>
                                        <div class="help-block with-errors"></div>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12 mt-4">
                                    <div class="form-group">
                                        <a href="{{ route('admin.subklasifikasi.index') }}" class="btn btn-danger">KEMBALI</a>
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
