@extends('_layouts.main')
@section('title', 'Buku Besar')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card p-3">
                <div class="card-header d-flex">
                    <div class="d-inline-block">
                        <!-- Button trigger modal -->
                        <form action="{{route('admin.bukubesar.cariakun')}}"  method="POST" >
                            @csrf
                            <div class="form-row">
                            <div class="col-md-6 col-12">
                                <select class="form-control" name="id" id="id" >
                                <option value="">Pilih Akun</option>
                                @foreach ($select as $item)
                                <option value="{{$item->id}}">{{$item->kode}} - {{$item->name}}</option>
                                @endforeach
                                </select>
                            </div>
                            <div class="col-md-5 col-12 ">
                                <button class="btn btn-primary waves-effect waves-float waves-light ml-auto" type="submit">Cari</button>
                            </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-light table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Jumlah</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($akun as $row)
                            <br>
                            <hr>
                            <br>
                            <div class="d-flex justify-content-between">
                                <h3>{{ $row->name }} - {{ $row->id }}</h3>
                                <h3>{{ $row->subklasifikasi }}</h3>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Tipe</th>
                                            <th>No.Ref</th>
                                            <th>Kontak</th>
                                            <th>Debit</th>
                                            <th>Kredit</th>
                                            <th>Saldo</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td colspan="6">Saldo Awal</td>
                                            <td>0</td>
                                        </tr>
                                        @foreach($row->jurnalumumdetails as $data)
                                        <tr class="bg-info">
                                            <td>{{ $data->jurnalumum->tanggal }}</td>
                                            <td>Jurnal Umum</td>
                                            <td>{{ $data->jurnalumum->kode_jurnal }}</td>
                                            <td>{{ $data->jurnalumum->kontak->nama }}</td>
                                            <td>{{ $data->debit }}</td>
                                            <td colspan="2">{{ $data->kredit }}</td>

                                        </tr>
                                        @endforeach
                                        @foreach($row->bkk as $data)
                                        <tr class="bg-warning">
                                            <td>{{ $data->tanggal }}</td>
                                            <td>Buku dan Kas</td>
                                            <td>{{ $data->desk }}</td>
                                            <td>{{ $data->kontak->nama }}</td>
                                            <td colspan="3">{{ $data->value }}</td>
                                        </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="4">Saldo Awal</td>
                                            <td>{{ $row->jurnalumumdetails->sum('debit') }}</td>
                                            <td>{{ $row->jurnalumumdetails->sum('kredit') }}</td>
                                        </tr>
                                        <tr class="bg-primary text-light">
                                            <td colspan="6">Saldo Akhir</td>
                                            <td>{{ $row->jurnalumumdetails->sum('debit')-$row->jurnalumumdetails->sum('kredit')+$row->bkk->sum('value') }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
