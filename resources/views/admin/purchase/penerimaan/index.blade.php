@extends('_layouts.main')
@section('title', 'Penerimaan Barang')
@push('breadcrumb')
<li class="breadcrumb-item">
    <a href="{{ route('admin.purchase') }}">Pembelian</a>
</li>
<li class="breadcrumb-item active">Penerimaan Barang</li>
@endpush
@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- end message area-->
        <div class="col-md-12">
            <div class="card-header">
                <h3>Penerimaan Barang</h3>
            </div>
            <div class="card ">
                <div class="card-header justify-content-between d-flex">
                    <div>
                        <a href="{{ route('admin.terima.create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Buat Baru</a>
                        <a href="{{ route('admin.terima.show','barang') }}" class="btn btn-warning btn-sm"><i class="fa fa-plus"></i> Buat Barang Baru</a>
                        <a href="{{ route('admin.terima.show','jasa') }}" class="btn btn-danger btn-sm"><i class="fa fa-plus"></i> Buat Jasa Baru</a>

                    </div>
                    <div class="d-flex">
                        <input type="date" class="form-control mx-1" name="" id="">
                        <input type="date" class="form-control mr-2" name="" id="">
                        <button type="button" class="btn btn-icon rounded-circle btn-primary waves-effect pr-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search">
                                <circle cx="11" cy="11" r="8"></circle>
                                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Tanggal</th>
                                    <th>Nomor Penerimaan</th>
                                    <th>Nama Pemasok</th>
                                    <th>Deskripsi</th>
                                    <th>Nilai</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
