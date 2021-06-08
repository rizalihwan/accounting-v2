@extends('_layouts.main')
@section('title', 'Data Bank')
@section('content')
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-users bg-blue"></i>
                        <div class="d-inline">
                            <h5>Data Produk</h5>
                            <span>List data Produck</span>
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
                                <a href="">Product</a>
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
                    <div class="card-header justify-content-between d-flex">
                        <div>
                            <a href="{{ route('admin.product.create') }}" class="btn btn-primary btn-lg"><i class="fa fa-plus"></i> Tambah Data</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-light table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Harga Beli</th>
                                    <th>Harga Jual</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                <tr>
                                    <td><a href="{{ route('admin.product.show',$product->id) }}" style="color: blue;">{{ $product->name }}</a></td>
                                    <td>{{ $product->price_buy }}</td>
                                    <td>{{ $product->price_sell }}</td>
                                    <td>
                                        <a href="{{ route('admin.product.edit',$product->id) }}" class="btn btn-info btn-sm mr-1" style="float: left;"><i class="fa fa-edit"></i></a>
                                        <form action="#" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                        </form>
                                    </td>
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
