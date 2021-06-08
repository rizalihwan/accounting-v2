@extends('_layouts.main')
@section('title', 'Subklasifikasi')
@section('content')
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-user-plus bg-blue"></i>
                        <div class="d-inline">
                            <h5>Subklasifikasi</h5>
                            <span>Form edit subklasifikasi</span>
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
                                <a href="{{ route('admin.subklasifikasi.create') }}">Edit subklasifikasi</a>
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
                        <h3>Edit subklasifikasi</h3>
                    </div>
                    <div class="card-body">
                        <form class="forms-sample" method="POST" action="{{ route('admin.subklasifikasi.update', $subklasifikasi->id) }}">
                            @csrf
                            @method('patch')
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">    
                                        <label for="name">{{ __('Name') }}<span class="text-red">*</span></label>
                                        <input id="name" type="text"
                                            class="form-control @error('name') is-invalid @enderror" value="{{ $subklasifikasi->name ?? old('subklasifikasi') }}" name="name"
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
