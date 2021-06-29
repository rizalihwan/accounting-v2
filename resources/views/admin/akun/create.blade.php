@extends('_layouts.main')
@section('title', 'Akun')
    @push('breadcrumb')
        <li class="breadcrumb-item">
            <a href="{{ route('admin.data-store') }}">Data Master</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('admin.akun.index') }}">Chart of Account</a>
        </li>
        <li class="breadcrumb-item active">Tambah Akun</li>
    @endpush
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-header">
                        <h3>Tambah Akun Kontak</h3>
                    </div>
                    <div class="card-body">
                        <form class="forms-sample" method="POST" action="{{ route('admin.akun.store') }}">
                            @csrf
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">    
                                        <label for="kode">{{ __('Kode') }}<span class="text-red">*</span></label>
                                        <input id="kode" type="text"
                                            class="form-control @error('kode') is-invalid @enderror" name="kode" value="{{ $kode }}"
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
                                <div class="col-sm-4">
                                    <div class="form-group">    
                                        <label for="subklasifikasi_id">{{ __('Subklasifikasi') }}<span class="text-red">*</span></label>
                                        <select name="subklasifikasi_id" id="subklasifikasi_id" class="form-control" required>
                                            <option disabled selected>-- Pilih Subklasifikasi --</option>
                                            @foreach($subklasifikasi_id as $value)
                                                <option value="{{ $value->id }}">{{ $value->name }}</option>
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
                                <div class="col-sm-4">
                                    <div class="form-group">    
                                        <label for="level">{{ __('Level') }}<span class="text-red">*</span></label>
                                        <select name="level" id="level" class="form-control select2" required>
                                            <option value="Aktiva">Aktiva</option>
                                            <option value="Modal">Modal</option>
                                            <option value="Kewajiban">Kewajiban</option>
                                        </select>
                                        <div class="help-block with-errors"></div>
                                        @error('level')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">    
                                        <label for="saldo_awal">{{ __('Input Saldo Awal') }}<span class="text-red">*</span></label>
                                        <input id="saldo_awal" type="text"
                                            class="form-control @error('saldo_awal') is-invalid @enderror" name="saldo_awal"
                                            onkeypress="return hanyaAngka(event)" required>
                                        <div class="help-block with-errors"></div>
                                        @error('saldo_awal')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12 mt-4">
                                    <div class="form-group">
                                        <a href="{{ route('admin.akun.index') }}" class="btn btn-danger">KEMBALI</a>
                                        <button type="submit" class="btn btn-primary">TAMBAH</button>
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
