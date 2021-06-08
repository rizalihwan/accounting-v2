@extends('_layouts.main')
@section('title', 'Laporan Neraca Keuangan')
@section('content')
<div class="container-fluid">
    <div class="page-header">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="ik ik-bar-chart-line- bg-red"></i>
                    <div class="d-inline">
                        <h5>Laporan</h5>
                        <span>Neraca Keuangan</span>
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
                            <a href="{{ route('admin.neracakeuangan.index') }}">Neraca Keuangan</a>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-center">
        <!-- end message area-->
        <div class="col-md-8">
            <div class="card p-3">
                <div class="card-header">
                    <h3>Filter Laporan</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.neracakeuangan.show') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="date">Bulan Tahun</label>
                            <input type="month" class="form-control" name="date" id="date">
                        </div>
                        <input type="checkbox" name="check" id="check">
                        <label for="check">Tampilkan juga yang Bernilai Nol</label>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-start">
                        <button type="submit" class="btn btn-success mr-2">Preview</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
