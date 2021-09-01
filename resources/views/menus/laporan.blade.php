@section('title', 'Laporan')

@push('breadcrumb')
    <li class="breadcrumb-item active">Laporan</li>
@endpush

<section id="card-content-types">
    <div class="row">
        <div class="col-md-3 col-xl-3">
            <a href="{{ route('admin.report.keuangan.menu') }}">
                <div class="card border-0 text-white" style="background-color: #72147E;">
                    <div class="card-body">
                        <div class="title">
                            <div class="row">
                                <div class="col">
                                    <h1 class="text-light">Laporan Keuangan</h1>
                                </div>
                                <div class="col">
                                    <i class="fa fa-hand-holding-usd fa-lg fa-5x"></i>
                                </div>
                            </div>
                        </div>
                        <div class="info">
                            <p class="card-text">
                            <h1 class="card-text display-5 text-white font-weight-bold">Laporan Keuangan</h1>
                            <i class="fa fa-hand-holding-usd"></i>
                            </p>
                            <hr class="mr-1">
                            <p class="card-text">
                                Laporan Keuangan
                            </p>
                            <p class="card-text">
                                <small class="text-light"></small>
                            </p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        {{-- <div class="col-md-3 col-xl-3">
            <a href="{{ route('admin.report.penjualandanpiutang.menu') }}">
                <div class="card border-0 text-white" style="background-color : #F21170">
                    <div class="card-body">
                        <div class="title">
                            <div class="row">
                                <div class="col">
                                    <h1 class="text-light">Laporan Penjualan dan Piutang</h1>
                                </div>
                                <div class="col">
                                    <i class="fa fa-hand-holding-usd fa-lg fa-5x"></i>
                                </div>
                            </div>
                        </div>
                        <div class="info">
                            <p class="card-text">
                            <h1 class="card-text display-5 text-white font-weight-bold">Laporan Penjualan dan
                                Piutang</h1>
                            <i class="fa fa-hand-holding-usd"></i>
                            </p>
                            <hr class="mr-1">
                            <p class="card-text">
                                Laporan Penjualan dan Piutang
                            </p>
                            <p class="card-text">
                                <small class="text-light"></small>
                            </p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3 col-xl-3">
            <a href="{{ route('admin.report.pembeliandanutang.menu') }}">
                <div class="card border-0 text-white" style="background-color: #FA9905;">
                    <div class="card-body">
                        <div class="title">
                            <div class="row">
                                <div class="col">
                                    <h1 class="text-light">Laporan Pembelian dan Utang</h1>
                                </div>
                                <div class="col">
                                    <i class="fa fa-hand-holding-usd fa-lg fa-5x"></i>
                                </div>
                            </div>
                        </div>
                        <div class="info">
                            <p class="card-text">
                            <h1 class="card-text display-5 text-white font-weight-bold">Laporan Pembelian dan Utang
                            </h1>
                            <i class="fa fa-hand-holding-usd"></i>
                            </p>
                            <hr class="mr-1">
                            <p class="card-text">
                                Laporan Pembelian dan Utang
                            </p>
                            <p class="card-text">
                                <small class="text-light"></small>
                            </p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3 col-xl-3">
            <a href="{{ route('admin.report.produk.menu') }}">
                <div class="card border-0 text-white" style="background-color: #FF5200;">
                    <div class="card-body">
                        <div class="title">
                            <div class="row">
                                <div class="col">
                                    <h1 class="text-light">Laporan Produk</h1>
                                </div>
                                <div class="col">
                                    <i class="fa fa-hand-holding-usd fa-lg fa-5x"></i>
                                </div>
                            </div>
                        </div>
                        <div class="info">
                            <p class="card-text">
                            <h1 class="card-text display-5 text-white font-weight-bold">Laporan Produk</h1>
                            <i class="fa fa-hand-holding-usd"></i>
                            </p>
                            <hr class="mr-1">
                            <p class="card-text">
                                Laporan Produk
                            </p>
                            <p class="card-text">
                                <small class="text-light"></small>
                            </p>
                        </div>
                    </div>
                </div>
            </a>
        </div> --}}
    </div>
</section>