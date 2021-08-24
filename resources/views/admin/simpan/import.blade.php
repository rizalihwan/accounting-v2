@extends('_layouts.main')
@section('title', 'Import Data Simpan')
@push('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('admin.simpanpinjam') }}">Simpan & Pinjam</a>
    </li>
    <li class="breadcrumb-item"><a href="{{ route('admin.simpan.index') }}">Simpan</a></li>
    <li class="breadcrumb-item" aria-current="page">Import Simpanan</li>
@endpush
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <div class="card">
                <div class="card-header">
                    <h5>IMport Simpanan</h5>
                    @if ($errors->any())
                        <div class="alert alert-danger alert-validation-msg" role="alert">
                            <div class="alert-body">
                                @foreach ($errors->all() as $error)
                                <ul style="margin: 5px 12px 0 -11px">
                                    <li>{{ $error }}</li>
                                </ul>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.simpan.import') }}" class="needs-validation" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="import">Import Simpanan</label>
                                    <input name="import" class="form-control" id="import" type="file">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button class="btn btn-primary mt-3" type="submit">Submit</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
