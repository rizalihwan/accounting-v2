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
                            <h5>Data Bank</h5>
                            <span>List data Bank</span>
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
                                <a href="">Chart Of Account</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="">Bank</a>
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
                            <a href="{{ route('admin.bank.create') }}" class="btn btn-primary btn-lg"><i class="fa fa-plus"></i> Tambah Data</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-light table-hover">
                            <thead>
                                <tr>
                                    <th>Kode</th>
                                    <th>Nama Bank</th>
                                    <th>Alamat</th>
                                    <th>Kota</th>
                                    <th>Telepon</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($banks as $bank)
                                <tr>
                                    <td>{{ $bank->kode }}</td>
                                    <td><a href="{{ route('admin.bank.show',$bank->id) }}" style="color: blue;">{{ $bank->nama_bank }}</a></td>
                                    <td>{{ $bank->alamat }}</td>
                                    <td>{{ $bank->kota }}</td>
                                    <td>{{ $bank->telepon }}</td>
                                    <td>
                                        <a href="{{ route('admin.bank.edit',$bank->id) }}" class="btn btn-info btn-sm mr-1" style="float: left;"><i class="fa fa-edit"></i></a>
                                        <form action="#" method="post">
                                            @csrf
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
