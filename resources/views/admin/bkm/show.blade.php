@extends('_layouts.main')
@section('title', 'Buku Kas Masuk')
@section('content')
    @push('breadcrumb')
        <li class="breadcrumb-item">
            <a href="{{ route('admin.cash-bank') }}">Kas & Bank</a>
        </li>
        <li class="breadcrumb-item active">
            <a href="{{ route('admin.bkm.index') }}">Buku Kas Masuk</a>
        </li>
        <li class="breadcrumb-item active">Detail Data</li>
    @endpush
    <div class="row">
        <!-- end message area-->
        <div class="col-md-12">
            <div class="card py-2">
                <div class="card-header justify-content-between d-flex">
                    <table class="table">
                        <tr>
                            <td>To</td>
                            <td>:</td>
                            <td>{{ $show->kontak->nama }}</td>
                        </tr>
                        <tr>
                            <td>Nomor Kas Masuk </td>
                            <td>:</td>
                            <td>KM000{{ $show->id }}</td>
                        </tr>
                        <tr>
                            <td>Deskripsi</td>
                            <td>:</td>
                            <td>{{ $show->desk }}</td>
                        </tr>
                        <tr>
                            <td>Total</td>
                            <td>:</td>
                            <td>{{ $show->value }}</td>
                        </tr>
                    </table>

                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>no</th>
                                <th>Nama</th>
                                <th>Jumlah</th>
                                <th>Catatan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($show->bkk_details as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->rekening->name }} - {{ $item->rekening->name }}</td>
                                    <td>{{ $item->jml_uang }}</td>
                                    <td>{{ $item->catatan }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>no</th>
                                <th>Nama</th>
                                <th>Jumlah</th>
                                <th>Catatan</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
