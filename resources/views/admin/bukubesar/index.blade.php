@extends('_layouts.main')
@section('title', 'Buku Besar')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card p-3">
                <div class="card-header d-flex">
                    <div class="d-inline-block">
                        @if (!empty($ada))
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
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-hover" style="">
                        <tbody>
                            @if ($akun != NULL)
                            @foreach($akun as $row)
                            <br>
                            <div class="d-flex justify-content-between">
                                <h3>{{ $row->name }} - {{ $row->id }}</h3>
                                <h3>{{ $row->subklasifikasi }}</h3>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
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
                                            <td>{{ $row->saldo_awal }} </td>
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
                                            @php $desk =''; @endphp
                                            @foreach($row->bkk as $item)
                                                @if ($item->status == 'BKK')
                                                    @foreach ($item->bkk_details as $black)
                                                        @if ($desk != $item->desk)
                                                            <tr>
                                                                <td>
                                                                    <span class="badge badge-info">
                                                                        {{ $item->tanggal }}
                                                                    </span>
                                                                </td>
                                                                <td>Bank Dan Kas</td>
                                                                <td>{{ $item->desk }}</td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                            </tr>
                                                            @php $desk = $item->desk @endphp
                                                        @endif
                                                        <tr>
                                                            <td></td>
                                                            <td>BKK</td>
                                                            <td>-</td>
                                                            <td>{{$black->rekening->name }}</td>
                                                            <td>{{$black->jml_uang}}</td> 
                                                            <td>-</td> 
                                                            <td></td> 
                                                            @php $asik = $black->uang; @endphp
                                                        </tr>      
                                                    @endforeach
                                                    <tr>
                                                        <td></td>
                                                        <td>BKK</td>
                                                        <td>-</td>
                                                        <td>{{$item->akun->name}}</td>
                                                        <td>-</td>
                                                        <td>{{$item->value}}</td>
                                                        <td></td>
                                                    </tr>
                                                @endif
                                                @if ($item->status == 'BKM')
                                                    @foreach ($item->bkk_details as $black)
                                                        @if ($desk != $item->desk)
                                                            <tr>
                                                                <td>
                                                                    <span class="badge badge-info">
                                                                        {{ $item->tanggal }}
                                                                    </span>
                                                                </td>
                                                                <td>Bank Dan Kas</td>
                                                                <td>{{ $item->desk }}</td>
                                                                <td>-</td>
                                                                <td>-</td>
                                                                <td>-</td>
                                                                <td></td>
                                                                <td></td>
                                                            </tr>
                                                            @php $desk = $item->desk @endphp
                                                        @endif
                                                        <tr>
                                                            <td></td>
                                                            <td>BKM</td>
                                                            <td>-</td>
                                                            <td>{{$black->rekening->name }}</td>
                                                            <td>-</td> 
                                                            <td>{{$black->jml_uang}}</td> 
                                                            <td></td>
                                                            @php $asik = $black->uang; @endphp
                                                        </tr>      
                                                    @endforeach
                                                    <tr>
                                                        <td></td>
                                                        <td>BKM</td>
                                                        <td>-</td>
                                                        <td>{{$item->akun->name}}</td>
                                                        <td>{{$item->value}}</td>
                                                        <td>-</td>
                                                        <td></td>
                                                    </tr> 
                                                @endif
                                            @endforeach
                                        <tr class="bg-primary text-light">
                                            <td colspan="6">Saldo Akhir</td>
                                            <td>{{ $row->saldo_akhir }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            @endforeach
                            @else
                                <td colspan="6">
                                    <center>No Select</center>
                                </td>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
