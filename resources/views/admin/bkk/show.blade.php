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
                            <h5>Buku Kas Keluar (Show)</h5>
                            <span>List Buku Kas Keluar (BKK)</span>
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
                                <a href="{{ route('admin.bkk.index') }}">Buku Kas Keluar</a>
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
                        <table class="table">
                            <tr>
                                <td>To</td>
                                <td>:</td>
                                <td>{{$show->kontaks->nama}}</td>
                            </tr>
                            <tr>
                                <td>Nomor Kas Keluar </td>
                                <td>:</td>
                                <td>KK000{{$show->id}}</td>
                            </tr>
                            <tr>
                                <td>Deskripsi</td>
                                <td>:</td>
                                <td>{{$show->desk}}</td>
                            </tr>
                            <tr>
                                <td>Total</td>
                                <td>:</td>
                                <td>{{$show->value}}</td>
                            </tr>
                        </table>
                          
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead >
                                <tr style="background-color:#32383e;color:white">
                                    <th>no</th>
                                    <th>Nama</th>
                                    <th>Jumlah</th>
                                    <th>catatat</th>
                                    <th>Mata uang</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($show->rekenings as $item)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$item->rekenings}}</td>
                                    <td>{{$item->jml_uang}}</td>
                                    <td>{{$item->catatan}}</td>
                                    <td>{{$item->uang}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="table-dark">
                                <tr>
                                    <th>no</th>
                                    <th>Nama</th>
                                    <th>Jumlah</th>
                                    <th>catatat</th>
                                    <th>Mata uang</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
