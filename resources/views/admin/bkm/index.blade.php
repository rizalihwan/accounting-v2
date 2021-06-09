@extends('_layouts.main')
@section('title', 'Buku Kas Masuk')
@section('content')
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-book bg-blue"></i>
                        <div class="d-inline">
                            <h5>Buku Kas Masuk</h5>
                            <span>List Buku Kas Masuk (BKM)</span>
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
                                <a href="{{ route('admin.bkm.index') }}">Kas Masuk</a>
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
                            <a href="{{ route('admin.bkm.create') }}" class="btn btn-primary btn-lg"><i class="fa fa-plus"></i> Tambah Buku Kas Masuk</a>
                        </div>
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
                                    <th>No.</th>
                                    <th>Tanggal</th>
                                    <th>Nomor Kas Keluar</th>
                                    <th>nama rekening</th>
                                    <th>untuk Pembayaran</th>
                                    <th>Value</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($indeks as $item)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$item->tanggal}}</td>
                                    @if ($row > 0)
                                    @if ($item->id < 9)
                                    <td>KM0000{{ $item->id }}</td>
                                    @elseif ($item->id < 99)
                                    <td>KM000{{ $item->id  }}</td>
                                    @elseif ($item->id < 999)
                                    <td>KM00{{ $item->id }}</td>
                                    @elseif ($item->id < 9999)
                                    <td>KM0{{ $item->id }}</td>
                                    @else
                                    <td>KM{{ $item->id  }}</td>
                                    @endif
                                    @endif
                                    <td>{{ $item->rekening_id  }}</td>
                                    <td>{{ $item->desk  }}</td>
                                    <td>{{ $item->value  }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                                                 <i class="fa fa-ellipsis-v ml-1"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton2">
                                              <li><a href="{{ route('admin.bkm.show',$item->id) }}" class="btn btn-outline-info btn-sm mb-2 col-md-12" ><i class="fa fa-edit"></i>Edit</a></li>
                                              <form action="{{ route('admin.bkk.destroy', $item->id) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <li><button type="submit" class="btn btn-outline-danger mb-2 btn-sm col-md-12"><i class="fa fa-trash"></i>Hapus</button></li>
                                            </form>
                                               <li><a href="{{ route('admin.bkk.show',$item->id) }}" class="btn btn-outline-success btn-sm mb-2 col-md-12"><i class="fa fa-eye"></i>Show</a></li>
                                            </ul>
                                          </div>
                                        
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
