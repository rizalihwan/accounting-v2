@extends('_layouts.main')
@section('title', 'Buku Besar')
@section('content')
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-users bg-blue"></i>
                        <div class="d-inline">
                            <h5>Buku Besar</h5>
                            <span>List data Buku Besar</span>
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
                                <a href="{{ route('admin.bukubesar.index') }}">Buku Besar</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- end message area-->
            <div class="col-md-12">
                <div class="card p-3">
                    <div class="card-header justify-content-center d-flex">
                        {{-- <div>
                            <a href="{{ route('admin.jurnalumum.create') }}" class="btn btn-primary btn-lg"><i class="fa fa-plus"></i> TAMBAH JURNAL</a>
                        </div> --}}
                        <div class="d-flex">
                            <input type="date" class="form-control mx-1" name="" id="">
                            <input type="date" class="form-control mr-2" name="" id="">
                            <button type="submit" class="btn btn-success"><i class="fa fa-search"></i> Cari</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-light table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Jumlah</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transaksi as $item)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$item->tanggal}}</td>
                                    <td>{{$jumlah}}</td>
                                    <td>{{$item->status}}</td>
                                </tr>  
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
