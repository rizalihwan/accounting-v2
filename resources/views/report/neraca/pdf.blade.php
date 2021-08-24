<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap.min.css') }}">
</head>

<body>
    <div class="row border">
        <div class="col-12">
            <h5 class="text-primary">Aktiva</h5>
            @foreach($aktiva->unique('id') as $row)
            <ul class="list-unstyled">
                <li>
                    <h4>
                        {{ $row->name }}
                    </h4>
                    @foreach($row->where('level', $row->level) as $data)
                    <ul class="list-unstyled">
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
                <h4 id="total" class="text-right">Rp. {{ number_format($total_aktiva) }}</h4>
            </div>
        </div>
    </div>

    <div class="row border">
        <div class="col-12">
            <h5 class="text-primary">Kewajiban</h5>
            @foreach($kewajiban->unique('id') as $row)
            <ul class="list-unstyled">
                <li>
                    <h4>
                        {{ $row->name }}
                    </h4>
                    @foreach($row->where('level', $row->level) as $data)
                    <ul class="list-unstyled">
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
                <h4 id="total" class="text-right">Rp. {{ number_format($total_kewajiban) }}</h4>
            </div>
        </div>
    </div>

    <div class="row border">
        <div class="col-12">
            <h5 class="text-primary">Modal</h5>
            @foreach($modal->unique('id') as $row)
            <ul class="list-unstyled">
                <li>
                    <h4>
                        {{ $row->name }}
                    </h4>
                    @foreach($row->where('level', $row->level) as $data)
                    <ul class="list-unstyled">
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
                <h4 id="total" class="text-right">Rp. {{ number_format($total_modal) }}</h4>
            </div>
        </div>
    </div>

</body>

</html>
