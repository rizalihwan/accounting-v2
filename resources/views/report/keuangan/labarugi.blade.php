@extends('_layouts.main')
@section('title', 'Laba Rugi')
@push('breadcrumb')
<li class="breadcrumb-item">
    <a href="{{ route('admin.report.menu') }}">Laporan Keuangan</a>
</li>
<li class="breadcrumb-item" aria-current="page">Laba Rugi</li>
@endpush
@section('content')
    <div class="row">
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
                            <td> 0 </td>
                        </tr>
                        <tr>
                            <th>
                                Total Laba
                                <span class="float-right">:</span>
                            </th>
                            <td>{{ 'Rp. ' . number_format($total_laba, 0, ',', '.') }}</td>
                        </tr>
                        {{-- <tr>
                            <th>
                                Total Laba Kotor
                                <span class="float-right">:</span>
                            </th>
                            <td> 0 </td>
                        </tr> --}}
                        {{-- <tr>
                            <th>
                                Total Laba Bersih
                                <span class="float-right">:</span>
                            </th>
                            <td> 0 </td>
                        </tr> --}}
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
