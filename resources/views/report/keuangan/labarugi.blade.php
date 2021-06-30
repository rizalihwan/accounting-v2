@extends('_layouts.main')
@section('title', 'Laba Rugi')
@section('content')
    <div class="row">
        <!-- end message area-->
        <div class="col-md-12">
            <div class="card py-2">
                <div class="card-header d-flex justify-content-center">
                    <h1 class="card-title">
                        <span class="badge badge-secondary">Laba Rugi</span>
                    </h1>
                </div>
                <div class="card-body pt-2">
                    <table class="table">
                        <tr>
                            <th>
                                Pendapatan
                                <span class="float-right">:</span>
                            </th>
                            <td>Rp 20.000.000</td>
                        </tr>
                        <tr>
                            <th>
                                Beban atas Pendapatan
                                <span class="float-right">:</span>
                            </th>
                            <td>Rp 10.000.000</td>
                        </tr>
                        <tr>
                            <th>
                                Total Laba Kotor
                                <span class="float-right">:</span>
                            </th>
                            <td>Rp 10.000.000</td>
                        </tr>
                        <tr>
                            <th>
                                Total Laba Bersih
                                <span class="float-right">:</span>
                            </th>
                            <td>Rp 10.000.000</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
