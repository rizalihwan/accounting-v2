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
        <div class="row">
            <!-- end message area-->
            <div class="col-md-12">
                <div class="card py-2">
                    <div class="card-header d-flex justify-content-center">
                        @if($data->status)
                            <h1 class="card-title">
                                <span class="badge badge-success">Status : Approved</span>
                            </h1>
                        @else
                            <h1 class="card-title">
                                <span class="badge badge-warning">Status : Not Approved</span>
                            </h1>
                        @endif
                    </div>
                    <div class="card-body pt-2">
                        <table class="table">
                            <tr>
                                <th class="kode_jurnal">
                                    Kode
                                    <span class="float-right">:</span>
                                </th>
                                <td>{{ $data->kode_jurnal }}</td>
                            </tr>
                            <tr>
                                <th>
                                    Tanggal
                                    <span class="float-right">:</span>
                                </th>
                                <td>{{ $data->tanggal }}</td>
                            </tr>
                            <tr>
                                <th>
                                    Uraian
                                    <span class="float-right">:</span>
                                </th>
                                <td>{{ $data->uraian }}</td>
                            </tr>
                            <tr>
                                <th>
                                    Divisi
                                    <span class="float-right">:</span>
                                </th>
                                <td>{{ $data->divisi->nama }}</td>
                            </tr>
                        </table>
                        <div class="table-responsive">
                            <table class="table mt-2">
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

@push('head')
    <style>
        @media only screen and (max-width: 768px) {
            .kode_jurnal {
                width: 160px;
            }
        }
    </style>
@endpush