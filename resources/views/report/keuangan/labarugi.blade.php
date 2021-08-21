@extends('_layouts.main')
@section('title', 'Laba Rugi')
@push('breadcrumb')
<li class="breadcrumb-item">
    <a href="{{ route('admin.report.menu') }}">Laporan Keuangan</a>
</li>
<li class="breadcrumb-item" aria-current="page">Laba Rugi</li>
@endpush
@section('content')
    {{-- <div class="row">
        <!-- end message area-->
        <div class="col-md-12">
            <div class="card py-2">
                <div class="card-header d-flex justify-content-center">
                    <h1 class="card-title">
                        <span class="badge badge-secondary">Laporan Laba Rugi</span>
                    </h1>
                </div>
                <div class="card-body pt-2">
                    <table class="table">
                        <tr>
                            <th>
                                Pendapatan
                                <span class="float-right">:</span>
                            </th>
                            <td>{{ 'Rp. ' . number_format($pendapatan, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <th>
                                Beban atas Pendapatan
                                <span class="float-right">:</span>
                            </th>
                            <td>{{ 'Rp. ' . number_format($beban, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <th>
                                Total Laba
                                <span class="float-right">:</span>
                            </th>
                            <td>{{ 'Rp. ' . number_format($total_laba, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <th>
                                Total Laba Kotor
                                <span class="float-right">:</span>
                            </th>
                            <td> 0 </td>
                        </tr>
                        <tr>
                            <th>
                                Total Laba Bersih
                                <span class="float-right">:</span>
                            </th>
                            <td> 0 </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div> --}}

    <div class="container">
        <div class="d-flex justify-content-center">
            <div class="col-8">
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
                                    <td class="text-right">{{ 'Rp. ' . number_format(0, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <th class="text-primary">
                                        Biaya Operasional
                                    </th>
                                    <td class="text-right">{{ 'Rp. ' . number_format(0, 0, ',', '.') }}</td>
                                </tr>
                                <tr class="border-top border-bottom">
                                    <th class="text-primary">
                                        Laba Bersih
                                    </th>
                                    <td class="text-right">{{ 'Rp. ' . number_format(0, 0, ',', '.') }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
