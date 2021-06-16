@extends('_layouts.main')
@section('title', 'Buku Kas Masuk')
@push('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('admin.cash-bank') }}">Cash & Bank</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">Income</li>
@endpush
@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- end message area-->
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-header justify-content-between d-flex">
                        <div>
                            <a href="{{ route('admin.bkm.create') }}" class="btn btn-primary btn-lg"><i class="fa fa-plus"></i> Tambah Buku Kas Masuk</a>
                        </div>
                        <div class="d-flex">
                            <input type="date" class="form-control mx-1" name="" id="">
                            <input type="date" class="form-control mr-2" name="" id="">
                            <button type="button" class="btn btn-icon rounded-circle btn-primary waves-effect pr-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
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
                                        <td>KK0000{{ $item->id }}</td>
                                        @elseif ($item->id < 99)
                                        <td>KK000{{ $item->id  }}</td>
                                        @elseif ($item->id < 999)
                                        <td>KK00{{ $item->id }}</td>
                                        @elseif ($item->id < 9999)
                                        <td>KK0{{ $item->id }}</td>
                                        @else
                                        <td>KK{{ $item->id  }}</td>
                                        @endif
                                        @endif
                                        <td>{{ $item->akuns->name  }} - {{ $item->akuns->subklasifikasi->name  }}</td>
                                        <td>{{ $item->desk  }}</td>
                                        <td>{{ $item->value  }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-flat-dark waves-effect" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i data-feather='more-vertical'></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-dark p-2" aria-labelledby="dropdownMenuButton2">
                                                <li><a href="{{ route('admin.bkm.edit',$item->id) }}" class="btn btn-outline-info mb-1 col-md-12" ><i data-feather='edit'></i> <br>   Edit</a></li>
                                                <form action="{{ route('admin.bkm.destroy', $item->id) }}" method="post"
                                                    onclick="return confirm('Apakah yakin?')">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-outline-danger mb-1 col-md-12"><i data-feather='trash-2'></i>hapus</button>
                                                </form>
                                                <li><a href="{{ route('admin.bkm.edit',$item->id) }}" class="btn btn-outline-success mb-1 col-md-12"><i data-feather='eye'></i>Show</a></li>
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
    </div>
@endsection
