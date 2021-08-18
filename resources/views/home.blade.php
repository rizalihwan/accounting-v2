@extends('_layouts.main')
@section('title','Dashboard')
@push('breadcrumb')
<li class="breadcrumb-item">
    Dashboard
</li>
@endpush

@section('content')
<section id="dashboard-ecommerce">
    <div class="row match-height">


        <!-- Statistics Card -->
        <div class="col-xl-12 col-md-12 col-12">
            <div class="card shadow card-statistics">
                <div class="card-header">
                    <h4 class="card-title">Statistik dan Analisa Data</h4>
                    <div class="d-flex align-items-center">
                        <p class="card-text font-small-2 mr-25 mb-0"><i class="fa fa-clock"></i> {{ date('Y-m-d') }}</p>
                    </div>
                </div>
                <div class="card-body statistics-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="responsive-table">
                                <table class="table table-bordered">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th colspan="4">
                                               Saldo Akun
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>Nomor</th>
                                            <th>Nama Akun</th>
                                            <th>Uang</th>
                                            <th>Saldo</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($akun as $data)
                                        <tr>
                                            <td>{{$data->kode}}</td>
                                            <td>{{$data->name}}</td>
                                            <td>RP</td>
                                            <td>{{$data->debit - $data->kredit}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card shadow card-statistics">
                <div class="card-header">
                    <h4 class="card-title">Piutang Per Akun</h4>
                    <div class="d-flex align-items-center">
                        <p class="card-text font-small-2 mr-25 mb-0"><i class="fa fa-clock"></i> {{ date('Y-m-d') }}</p>
                    </div>
                </div>
                <div class="card-body statistics-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="reponsive-table">
                                <table class="table table-bordered">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th colspan="4">
                                                Piutang per Akun
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>Kode</th>
                                            <th>Nama Akun</th>
                                            <th>Uang</th>
                                            <th>Jumlah</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($piutang as $data)
                                        <tr>
                                            <td>{{$data->kode}}</td>
                                            <td>{{$data->name}}</td>
                                            <td>RP</td>
                                            <td>{{$data->debit}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card shadow card-statistics">
                <div class="card-header">
                    <h4 class="card-title">Hutang Per Akun</h4>
                    <div class="d-flex align-items-center">
                        <p class="card-text font-small-2 mr-25 mb-0"><i class="fa fa-clock"></i> {{ date('Y-m-d') }}</p>
                    </div>
                </div>
                <div class="card-body statistics-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="reponsive-table">
                                <table class="table table-bordered">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th colspan="4">
                                                Hutang Per Akun
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>Nomor</th>
                                            <th>Nama Akun</th>
                                            <th>Uang</th>
                                            <th>Saldo</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($hutang as $data)
                                        <tr>
                                            <td>{{$data->kode}}</td>
                                            <td>{{$data->name}}</td>
                                            <td>RP</td>
                                            <td>{{$data->kredit}}</td>
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
        <!--/ Statistics Card -->
    </div>

</section>
<!-- Dashboard Ecommerce ends -->
@endsection

@push('head')
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/charts/apexcharts.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/extensions/toastr.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/dashboard-ecommerce.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/extensions/ext-component-toastr.min.css') }}">
@endpush

@push('script')
<script src="{{ asset('app-assets/vendors/js/charts/apexcharts.min.js') }}"></script>
<script src="{{ asset('app-assets/vendors/js/extensions/toastr.min.js') }}"></script>
<script src="{{ asset('app-assets/js/scripts/pages/dashboard-ecommerce.min.js') }}"></script>
<script src="{{ asset('app-assets/js/scripts/extensions/ext-component-sweet-alerts.min.js') }}"></script>
@endpush
