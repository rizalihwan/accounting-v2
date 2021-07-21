@extends('_layouts.main')
@section('title', 'Buku Kas Keluar')
@section('content')
    @push('breadcrumb')
        <li class="breadcrumb-item active">Cash & Bank</li>
        <li class="breadcrumb-item active">Expanse</li>
        <li class="breadcrumb-item active">Show</li>
    @endpush
    <div class="row">
        <!-- end message area-->
        <div class="col-md-12">
            <div class="card p-3">
                <div class="card-header justify-content-between d-flex">
                    <table class="table">
                        <tr>
                            <td>To</td>
                            <td>:</td>
                            <td>{{ $show->kontaks->nama }}</td>
                        </tr>
                        <tr>
                            <td>Nomor Kas Keluar </td>
                            <td>:</td>
                            <td>KK000{{ $show->id }}</td>
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
                                <th>catatat</th>
                                <th>Mata uang</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($show->uraians as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->rekening->name }} - {{ $item->rekening->subklasifikasi->name }}</td>
                                    <td>{{ $item->jml_uang }}</td>
                                    <td>{{ $item->catatan }}</td>
                                    <td>{{ $item->uang }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
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
@endsection
