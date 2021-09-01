@extends('_layouts.main')
@section('title', 'Laba Rugi')
@push('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('admin.report.menu') }}">Laporan Keuangan</a>
    </li>
    <li class="breadcrumb-item" aria-current="page">Laba Rugi</li>
@endpush
@section('content')
    <div class="container">
        <div class="d-flex justify-content-center">
            <div class="col-8">

            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-around">
                        <a target="_blank" href="{{ route('admin.report.keuangan.labarugi.pdf') }}" class="btn btn-danger">PDF</a>
                        <a target="_blank" href="{{ route('admin.report.keuangan.labarugi.excel') }}" class="btn btn-success">EXCEL</a>
                    </div>
                </div>
            </div>
                <div class="card rounded">
                    <p class="text-black text-center pt-2 font-weight-bolder">Direktorat Keuangan TNI Angkatan Darat</p>
                    <h2 class="text-center text-primary">Laba Rugi</h2>
                    <p class="text-black text-center">{{ date('F Y') }}</p>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-borderless border">
                                <tr>
                                    <th class="text-primary">
                                        Pendapatan
                                    </th>
                                    <td class="text-right">{{ 'Rp. ' . number_format($pendapatan, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <th class="text-primary">
                                        Beban atas pendapatan
                                    </th>
                                    <td class="text-right">{{ 'Rp. ' . number_format($beban, 0, ',', '.') }}</td>
                                </tr>
                                <tr class="border-top border-bottom">
                                    <th class="text-primary">
                                        Laba Kotor
                                    </th>
                                    <td class="text-right">{{ 'Rp. ' . number_format($laba_kotor, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <th class="text-primary">
                                        Biaya Operasional
                                    </th>
                                    <td class="text-right">{{ 'Rp. ' . number_format($BiayaOperasional, 0, ',', '.') }}</td>
                                </tr>
                                <tr class="border-top border-bottom">
                                    <th class="text-primary">
                                        Laba Bersih
                                    </th>
                                    <td class="text-right">{{ 'Rp. ' . number_format($laba_bersih, 0, ',', '.') }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
