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
                <div class="card rounded">
                    <img src="{{ public_path('pdf/logoijo-removebg-preview.png') }}" alt="" width="90px" style="margin-left : 42%">

                    <h2 class="text-black text-center pt-2 font-weight-bolder" style="text-align: center;color : #6e6b7b">Direktorat Keuangan TNI Angkatan Darat</h2>
                    <h2 class="text-center text-primary" style="text-align: center;color : #7367f0">Laba Rugi</h2>
                    <p class="text-black text-center" style="text-align: center;color : #6e6b7b">{{ date('F Y') }}</p>
                    <br>
                    <hr>
                    <br>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table cellpadding="20px" class="" border="1" style="margin-left: auto;margin-right: auto;">
                                <tr>
                                    <th class="text-primary" style="color : #7367f0">
                                        Pendapatan
                                    </th>
                                    <td class="text-right" style="text-align: center;color : #6e6b7b;">{{ 'Rp. ' . number_format($pendapatan, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <th class="text-primary" style="text-align: left; color : #7367f0">
                                        Beban atas pendapatan
                                    </th>
                                    <td class="text-right" style="text-align: center;color : #6e6b7b">{{ 'Rp. ' . number_format($beban, 0, ',', '.') }}</td>
                                </tr>
                                <tr class="border-top border-bottom">
                                    <th class="text-primary" style="text-align: left; color : #7367f0">
                                        Laba Kotor
                                    </th>
                                    <td class="text-right" style="text-align: center;color : #6e6b7b">{{ 'Rp. ' . number_format($laba_kotor, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <th class="text-primary" style="text-align: left; color : #7367f0">
                                        Biaya Operasional
                                    </th>
                                    <td class="text-right" style="text-align: center;color : #6e6b7b">{{ 'Rp. ' . number_format($BiayaOperasional, 0, ',', '.') }}</td>
                                </tr>
                                <tr class="border-top border-bottom">
                                    <th class="text-primary" style="text-align: left; color : #7367f0">
                                        Laba Bersih
                                    </th>
                                    <td class="text-right" style="text-align: center;color : #6e6b7b">{{ 'Rp. ' . number_format($laba_bersih, 0, ',', '.') }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
