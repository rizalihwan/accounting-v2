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
    <div class="col-sm-8 offset-sm-2">
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
                <form action="{{ route('admin.pinjam.import') }}" class="needs-validation" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="import">Import Pinjaman <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input name="import" class="form-control" id="import" type="file" value="{{ old('import') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button class="btn btn-primary" type="submit">Import</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
