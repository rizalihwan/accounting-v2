@extends('_layouts.main')
@section('title', 'akun')
    @push('breadcrumb')
        <li class="breadcrumb-item">Chart of Account</li>
        <li class="breadcrumb-item active">Edit Akun</li>
    @endpush
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-header">
                        <h3>Edit Akun</h3>
                    </div>
                    <div class="card-body">
                        <form class="forms-sample" method="POST" action="{{ route('admin.akun.update', $akun->id) }}">
                            @csrf
                            @method('patch')
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">    
                                        <label for="kode">{{ __('Kode') }}<span class="text-red">*</span></label>
                                        <input id="kode" type="text"
                                            class="form-control @error('kode') is-invalid @enderror" value="{{ $akun->kode ?? old('akun') }}" name="kode"
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
                                        <label for="name">{{ __('Name') }}<span class="text-red">*</span></label>
                                        <input id="name" type="text"
                                            class="form-control @error('name') is-invalid @enderror" value="{{ $akun->name ?? old('akun') }}" name="name"
                                            required>
                                        <div class="help-block with-errors"></div>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">    
                                        <label for="subklasifikasi_id">{{ __('akun') }}<span class="text-red">*</span></label>
                                        <select name="subklasifikasi_id" id="subklasifikasi_id" class="form-control" required>
                                            @foreach($subklasifikasi_id as $value)
                                                <option value="{{ $value->id }}" @if($value->id == $akun->subklasifikasi_id) selected @endif>{{ $value->name }}</option>
                                            @endforeach
                                        </select>
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
                                        <a href="{{ route('admin.akun.index') }}" class="btn btn-danger">KEMBALI</a>
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
