@extends('_layouts.main')
@section('title', 'Data Kontak')
@section('content')
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-users bg-blue"></i>
                        <div class="d-inline">
                            <h5>Data Kontak</h5>
                            <span>List data kontak</span>
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
                                <a href="">Data Kontak</a>
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
                            <a href="{{ route('admin.kontak.create') }}" class="btn btn-primary btn-lg"><i class="fa fa-plus"></i> Tambah Data</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-light table-hover">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Kode</th>
                                    <th>Email</th>
                                    <th>Tipe</th>
                                    <th>Website</th>
                                    <th>Telepon</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kontak as $key)
                                <tr>
                                    <td>{{ $key->nama }}</td>
                                    <td><a href="{{ route('admin.kontak.show',$key->id) }}" style="color: blue;">{{ $key->kode_kontak }}</a></td>
                                    <td>{{ $key->email }}</td>
                                    <td>
                                        {{ $i->pelanggan ? 'Pelanggan' . ($i->pemasok == true || $i->karyawan == true ? ', ' : '') : '' }}
                                        {{ $i->pemasok ? 'Pemasok' . ($i->pelanggan == true || $i->karyawan == true ? ', ' : '') : '' }}
                                        {{ $i->karyawan ? 'Karyawan' . ($i->pelanggan == true || $i->pemasok == true ? ', ' : '') : '' }}
                                    </td>
                                    <td>{{ $key->website }}</td>
                                    <td>{{ $key->telepon }}</td>
                                    <td>
                                        <a href="{{ route('admin.kontak.edit',$key->id) }}" class="btn btn-info btn-sm mr-1" style="float: left;"><i class="fa fa-edit"></i></a>
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
