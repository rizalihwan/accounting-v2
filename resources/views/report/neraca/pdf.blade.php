<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="container">
        <div class="d-flex justify-content-center">
            <div class="col-8">
                <div class="card shadow rounded">

                <img src="{{ public_path('pdf/logoijo-removebg-preview.png') }}" alt="" width="90px" style="margin-left : 42%">
                    <h2 style="text-align: center;color : #6e6b7b">Direktorat Keuangan TNI Angkatan Darat</h2>
                    <h2 style="text-align: center;color: #7367f0 !important">Neraca</h2>
                    <p style="text-align: center;color : #6e6b7b">{{ date('F Y') }}</p>
                    <br>
                    <hr>
                    <br>
                    <div class="card-body">
                        <div class="row border">
                            <div class="col-12" style="border:2px solid #a1a1a1;padding: 10px">
                                <h3 style="color: #7367f0 !important">Aktiva</h3>
                                @foreach($aktiva->unique('id') as $row)
                                <ul>
                                    <li style="list-style: none;">
                                        <h4>
                                            {{ $row->kode }} - {{ $row->name }}
                                        </h4>
                                        @foreach($row->where('level', $row->level) as $data)
                                        <ul>
                                            <li style="list-style: none;">
                                                <label for="">{{ $data->name }}</label>
                                                {{-- <h4 class="text-right">Rp. {{ number_format($data->debit - $data->kredit) }}</h4> --}}
                                            </li>
                                        </ul>
                                        @endforeach
                                        <div class="form-group">
                                            <label for="" class="text-primary"><a href="{{route('admin.report.keuangan.neraca.detail',$row->id)}}">Total {{ $row->name }}</a></label>
                                            <h4 class="text-right" style="margin-left: 550px;">Rp. {{ number_format($row->debit - $row->kredit) }}</h4>
                                        </div>
                                    </li>

                                </ul>
                                @endforeach
                                <div class="form-group">
                                    <h5 style="color: #7367f0 !important">Total Aktiva</h5>
                                    <h4 id="total" class="text-right"  style="margin-left: 650px;">Rp. {{ number_format($total_aktiva) }}</h4>
                                </div>
                            </div>
                        </div>

                        <div class="row border">
                            <div class="col-12" style="border:2px solid #a1a1a1;padding: 10px">
                                <h3 style="color: #7367f0 !important">Kewajiban</h3>
                                @foreach($kewajiban->unique('id') as $row)
                                <ul>
                                    <li style="list-style: none;">
                                        <h4>
                                            {{ $row->kode }} - {{ $row->name }}
                                        </h4>
                                        @foreach($row->where('level', $row->level) as $data)
                                        <ul>
                                            <li style="list-style: none;">
                                                <label for="">{{ $data->name }}</label>
                                                {{-- <h4 class="text-right">Rp. {{ number_format($data->debit - $data->kredit) }}</h4> --}}
                                            </li>
                                        </ul>
                                        @endforeach
                                        <div class="form-group">
                                            <label for="" class="text-primary"><a href="{{route('admin.report.keuangan.neraca.detail',$row->id)}}">Total {{ $row->name }}</a></label>
                                            <h4 class="text-right"  style="margin-left: 550px;">Rp. {{ number_format($row->debit - $row->kredit) }}</h4>
                                        </div>
                                    </li>

                                </ul>
                                @endforeach
                                <div class="form-group">
                                    <h5 style="color: #7367f0 !important">Total Kewajiban</h5>
                                    <h4 id="total" class="text-right"  style="margin-left: 650px;">Rp. {{ number_format($total_kewajiban) }}</h4>
                                </div>
                            </div>
                        </div>

                        <div class="row border">
                            <div class="col-12" style="border:2px solid #a1a1a1;padding: 10px">
                                <h3 style="color: #7367f0 !important">Modal</h3>
                                @foreach($modal->unique('id') as $row)
                                <ul>
                                    <li style="list-style: none;">
                                        <h4>
                                            {{ $row->kode }} - {{ $row->name }}
                                        </h4>
                                        @foreach($row->where('level', $row->level) as $data)
                                        <ul>
                                            <li style="list-style: none;"   >
                                                <label for="">{{ $data->name }}</label>
                                                {{-- <h4 class="text-right">Rp. {{ number_format($data->debit - $data->kredit) }}</h4> --}}
                                            </li>
                                        </ul>
                                        @endforeach
                                        <div class="form-group">
                                            <label for="" class="text-primary"><a href="{{route('admin.report.keuangan.neraca.detail',$row->id)}}">Total {{ $row->name }}</a></label>
                                            <h4 class="text-right"  style="margin-left: 550px;">Rp. {{ number_format($row->debit - $row->kredit) }}</h4>
                                        </div>
                                    </li>

                                </ul>
                                @endforeach
                                <div class="form-group">
                                    <h5 style="color: #7367f0 !important">Total Modal</h5>
                                    <h4 id="total" class="text-right"  style="margin-left: 650px;">Rp. {{ number_format($total_modal) }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
