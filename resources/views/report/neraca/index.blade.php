@extends('_layouts.main')
@section('title', 'Neraca Keuangan')
@push('breadcrumb')
<li class="breadcrumb-item">
    <a href="{{ route('admin.report.menu') }}">Laporan Keuangan</a>
</li>
<li class="breadcrumb-item" aria-current="page">Neraca</li>
@endpush
@section('content')
<div class="container">
    <div class="d-flex justify-content-center">
        <div class="col-8">
            <div class="card shadow rounded">
                <div class="card-header">
                    <h5 class="card-title">NERACA - STANDARD</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <h5 class="text-primary">Aktiva</h5>
                            @foreach($aktiva->unique('subklasifikasi_id') as $row)
                            <ul>
                                <li>
                                    <h4>
                                        {{ $row->subklasifikasi->name }}
                                    </h4>
                                    @foreach($row->subklasifikasi->akun->where('level', $row->level) as $data)
                                    <ul>
                                        <li>
                                            <label for="">{{ $data->name }}</label>
                                            <input type="text" class="form-control {{ $row->subklasifikasi->name }}" value="{{ $data->saldo_akhir }}">
                                        </li>
                                    </ul>
                                    @endforeach
                                    <div class="form-group">
                                        <label for="" class="text-primary">Total {{ $row->subklasifikasi->name }}</label>
                                        <input type="text" class="form-control" value="{{ $row->subklasifikasi->akun->where('level', $row->level)->where('subklasifikasi_id', $row->subklasifikasi_id)->sum('saldo_akhir') }}">
                                    </div>
                                </li>

                            </ul>
                            @endforeach
                            <div class="form-group">
                                <h5 class="text-primary">Total Aktiva</h5>
                                <input type="number" class="form-control" id="total" value="{{ $total_aktiva }}">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-12">
                            <h5 class="text-primary">Modal</h5>
                            @foreach($modal->unique('subklasifikasi_id') as $row)
                            <ul>
                                <li>
                                    <h4>
                                        {{ $row->subklasifikasi->name }}
                                    </h4>
                                    @foreach($row->subklasifikasi->akun->where('level', $row->level) as $data)
                                    <ul>
                                        <li>
                                            <label for="">{{ $data->name }}</label>
                                            <input type="text" class="form-control {{ $row->subklasifikasi->name }}" value="{{ $data->saldo_akhir }}">
                                        </li>
                                    </ul>
                                    @endforeach
                                    <div class="form-group">
                                        <label for="" class="text-primary">Total {{ $row->subklasifikasi->name }}</label>
                                        <input type="text" class="form-control" value="{{ $row->subklasifikasi->akun->where('level', $row->level)->where('subklasifikasi_id', $row->subklasifikasi_id)->sum('saldo_akhir') }}">
                                    </div>
                                </li>

                            </ul>
                            @endforeach
                            <div class="form-group">
                                <h5 class="text-primary">Total Modal</h5>
                                <input type="number" class="form-control" value="{{ $total_modal }}">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-12">
                            <h5 class="text-primary">Kewajiban</h5>
                            @foreach($kewajiban->unique('subklasifikasi_id') as $row)
                            <ul>
                                <li>
                                    <h4>
                                        {{ $row->subklasifikasi->name }}
                                    </h4>
                                    @foreach($row->subklasifikasi->akun->where('level', $row->level) as $data)
                                    <ul>
                                        <li>
                                            <label for="">{{ $data->name }}</label>
                                            <input type="text" class="form-control {{ $row->subklasifikasi->name }}" value="{{ $data->saldo_akhir }}">
                                        </li>
                                    </ul>
                                    <div class="form-group">
                                        <label for="" class="text-primary">Total {{ $row->subklasifikasi->name }}</label>
                                        <input type="text" class="form-control" value="{{ $row->subklasifikasi->akun->where('level', $row->level)->where('subklasifikasi_id', $row->subklasifikasi_id)->sum('saldo_akhir') }}">
                                    </div>
                                    @endforeach
                                </li>
                            </ul>
                            @endforeach
                            <div class="form-group">
                                <h5 class="text-primary">Total Kewajiban</h5>
                                <input type="number" class="form-control" value="{{ $total_kewajiban }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
