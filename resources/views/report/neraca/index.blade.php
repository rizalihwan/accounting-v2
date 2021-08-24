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
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-around">
                        <a href="{{ route('admin.report.keuangan.neraca.pdf') }}" class="btn btn-danger">PDF</a>
                        <a href="" class="btn btn-success">EXCEL</a>
                    </div>
                </div>
            </div>
            <div class="card shadow rounded">
                <p class="text-black text-center pt-2 font-weight-bolder">Direktorat Keuangan TNI Angkatan Darat</p>
                <h2 class="text-center text-primary">Neraca</h2>
                <p class="text-black text-center">{{ date('F Y') }}</p>
                <div class="card-body">
                    <div class="row border">
                        <div class="col-12">
                            <h5 class="text-primary">Aktiva</h5>
                            @foreach($aktiva->unique('id') as $row)
                            <ul>
                                <li>
                                    <h4>
                                        {{ $row->name }}
                                    </h4>
                                    @foreach($row->where('level', $row->level) as $data)
                                    <ul>
                                        <li>
                                            <label for="">{{ $data->name }}</label>
                                            {{-- <h4 class="text-right">Rp. {{ number_format($data->debit - $data->kredit) }}</h4> --}}
                                        </li>
                                    </ul>
                                    @endforeach
                                    <div class="form-group">
                                        <label for="" class="text-primary"><a href="{{route('admin.report.keuangan.neraca.detail',$row->id)}}">Total {{ $row->name }}</a></label>
                                        <h4 class="text-right">Rp. {{ number_format($row->debit - $row->kredit) }}</h4>
                                    </div>
                                </li>

                            </ul>
                            @endforeach
                            <div class="form-group">
                                <h5 class="text-primary">Total Aktiva</h5>
                                <h4 id="total"  class="text-right">Rp. {{ number_format($total_aktiva) }}</h4>
                            </div>
                        </div>
                    </div>

                    <div class="row border">
                        <div class="col-12">
                            <h5 class="text-primary">Kewajiban</h5>
                            @foreach($kewajiban->unique('id') as $row)
                            <ul>
                                <li>
                                    <h4>
                                        {{ $row->name }}
                                    </h4>
                                    @foreach($row->where('level', $row->level) as $data)
                                    <ul>
                                        <li>
                                            <label for="">{{ $data->name }}</label>
                                            {{-- <h4 class="text-right">Rp. {{ number_format($data->debit - $data->kredit) }}</h4> --}}
                                        </li>
                                    </ul>
                                    @endforeach
                                    <div class="form-group">
                                        <label for="" class="text-primary"><a href="{{route('admin.report.keuangan.neraca.detail',$row->id)}}">Total {{ $row->name }}</a></label>
                                        <h4 class="text-right">Rp. {{ number_format($row->debit - $row->kredit) }}</h4>
                                    </div>
                                </li>

                            </ul>
                            @endforeach
                            <div class="form-group">
                                <h5 class="text-primary">Total Kewajiban</h5>
                                <h4 id="total"  class="text-right">Rp. {{ number_format($total_kewajiban) }}</h4>
                            </div>
                        </div>
                    </div>

                    <div class="row border">
                        <div class="col-12">
                            <h5 class="text-primary">Modal</h5>
                            @foreach($modal->unique('id') as $row)
                            <ul>
                                <li>
                                    <h4>
                                        {{ $row->name }}
                                    </h4>
                                    @foreach($row->where('level', $row->level) as $data)
                                    <ul>
                                        <li>
                                            <label for="">{{ $data->name }}</label>
                                            {{-- <h4 class="text-right">Rp. {{ number_format($data->debit - $data->kredit) }}</h4> --}}
                                        </li>
                                    </ul>
                                    @endforeach
                                    <div class="form-group">
                                        <label for="" class="text-primary"><a href="{{route('admin.report.keuangan.neraca.detail',$row->id)}}">Total {{ $row->name }}</a></label>
                                        <h4 class="text-right">Rp. {{ number_format($row->debit - $row->kredit) }}</h4>
                                    </div>
                                </li>

                            </ul>
                            @endforeach
                            <div class="form-group">
                                <h5 class="text-primary">Total Modal</h5>
                                <h4 id="total"  class="text-right">Rp. {{ number_format($total_modal) }}</h4>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="row">
                        <div class="col-12">
                            <h5 class="text-primary">Kewajiban</h5>
                            @foreach($kewajiban->unique('subklasifikasi_id') as $row)
                            <ul>
                                <li>
                                    <h4>
                                        {{ $row->name }}
                                    </h4>
                                    @foreach($row->where('level', $row->level) as $data)
                                    <ul>
                                        <li>
                                            <label for="">{{ $data->name }}</label>
                                            <h4 class="text-right">{{ number_format($data->debit - $data->kredit) }}</h4>
                                        </li>
                                    </ul>
                                    <div class="form-group">
                                        <label for="" class="text-primary">Total {{ $row->name }}</label>
                                        <h4 class="text-right">{{ number_format($row->where('level', $row->level)->where('subklasifikasi_id', $row->subklasifikasi_id)->sum('saldo_akhir')) }}</h4>
                                    </div>
                                    @endforeach
                                </li>
                            </ul>
                            @endforeach
                            <div class="form-group">
                                <h5 class="text-primary">Total Kewajiban</h5>
                                <h4 class="text-right">Rp. {{ number_format($total_kewajiban) }}</h4>
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
                                        {{ $row->name }}
                                    </h4>
                                    @foreach($row->where('level', $row->level) as $data)
                                    <ul>
                                        <li>
                                            <label for="">{{ $data->name }}</label>
                                            <h4 class="text-right">Rp. {{ number_format($data->debit - $data->kredit) }}</h4>
                                        </li>
                                    </ul>
                                    @endforeach
                                    <div class="form-group">
                                        <label for="" class="text-primary">Total {{ $row->name }}</label>
                                        <h4 class="text-right">Rp. {{ number_format($row->where('level', $row->level)->where('subklasifikasi_id', $row->subklasifikasi_id)->sum('saldo_akhir')) }}</h4>
                                    </div>
                                </li>

                            </ul>
                            @endforeach
                            <div class="form-group">
                                <h5 class="text-primary">Total Modal</h5>
                                <h4 class="text-right">Rp. {{ number_format($total_modal) }}</h4>
                            </div>
                        </div>
                    </div> --}}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
