@extends('_layouts.main')
@section('title', 'Detail Jurnal Umum')
@section('content')
    @push('breadcrumb')
        <li class="breadcrumb-item">
            <a href="{{ route('admin.ledger') }}">Jurnal</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('admin.jurnalumum.index') }}">Jurnal Umum</a>
        </li>
        <li class="breadcrumb-item active">Detail Data</li>
    @endpush
    <div class="container-fluid">
        <div class="row">
            <!-- end message area-->
            <div class="col-md-12">
                <div class="card p-3">
                    <center class="mb-2">
                        {!! $data->status == 1 ? '<h1 class="badge badge-success">Status : Approved</h1>' : '<h1 class="badge badge-success">Status : Not Approved</h1>' !!}
                    </center>
                    <div class="card-header justify-content-between d-flex">
                        <table class="table">
                            <tr>
                                <td>Kode</td>
                                <td>:</td>
                                <td>{{ $data->kode_jurnal }}</td>
                            </tr>
                            <tr>
                                <td>Tanggal</td>
                                <td>:</td>
                                <td>{{ $data->tanggal }}</td>
                            </tr>
                            <tr>
                                <td>Uraian</td>
                                <td>:</td>
                                <td>{{ $data->uraian }}</td>
                            </tr>
                            <tr>
                                <td>Divisi</td>
                                <td>:</td>
                                <td>{{ $data->divisi->nama }}</td>
                            </tr>
                        </table>

                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Kode Akun</th>
                                    <th>Nama Akun</th>
                                    <th>Divisi</th>
                                    <th>Debit</th>
                                    <th>Kredit</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data->jurnalumumdetails as $key)
                                    <tr>
                                        <td>{{ $key->akun->kode }}</td>
                                        <td>{{ $key->akun->name }}</td>
                                        <td>{{ $data->divisi->nama }}</td>
                                        <td>{{ 'Rp. ' . number_format($key->debit, 0, ',', '.') }}</td>
                                        <td>{{ 'Rp. ' . number_format($key->kredit, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th>{{ 'Rp. ' . number_format($data->jurnalumumdetails->sum('debit'), 0, ',', '.') }}
                                    </th>
                                    <th>{{ 'Rp. ' . number_format($data->jurnalumumdetails->sum('kredit'), 0, ',', '.') }}
                                    </th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
