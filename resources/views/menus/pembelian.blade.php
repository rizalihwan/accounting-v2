@section('title', 'Pembelian')

@push('breadcrumb')
    <li class="breadcrumb-item active">Pembelian</li>
@endpush

<section>
    <div class="row">
        <div class="col-md-3 col-xl-3">
            <a href="{{ route('admin.purchase.penawaran.index') }}">
                <div class="card bg-warning border-0 text-white shadow">
                    <div class="card-body">
                        <div class="title">
                            <div class="row">
                                <div class="col">
                                    <h1 class="text-light">Penawaran Harga</h1>
                                </div>
                                <div class="col">
                                    <i class="fa fa-chart-line fa-lg fa-5x"></i>
                                </div>
                            </div>
                        </div>
                        <div class="info">
                            <p class="card-text">
                            <h1 class="card-text display-5 text-white font-weight-bold">Penawaran Harga</h1>
                            <i class="fa fa-chart-line"></i>
                            </p>
                            <hr class="mr-1">
                            <p class="card-text">
                                Membuat penawaran harga untuk pemasok
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
            <a href="{{ route('admin.purchase.pesanan.index') }}">
                <div class="card  bg-success border-0 text-white shadow">
                    <div class="card-body">
                        <div class="title">
                            <div class="row">
                                <div class="col">
                                    <h1 class="text-light">Pesanan Pembelian</h1>
                                </div>
                                <div class="col">
                                    <i class="fa fa-hand-holding-usd fa-lg fa-5x"></i>
                                </div>
                            </div>
                        </div>
                        <div class="info">
                            <p class="card-text">
                            <h1 class="card-text display-5 text-white font-weight-bold">Pesanan Pemasok</h1>
                            <i class="fa fa-chart-line"></i>
                            </p>
                            <hr class="mr-1">
                            <p class="card-text">
                                Membuat pesanan pembelian untuk pemasok
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
            <a href="{{ route('admin.purchase.terima.index') }}">
                <div class="card border-0 text-white shadow" style="background-color : #900C3F">
                    <div class="card-body">
                        <div class="title">
                            <div class="row">
                                <div class="col">
                                    <h1 class="text-light">Penerimaan Barang</h1>
                                </div>
                                <div class="col">
                                    <i class="fa fa-truck fa-lg fa-4x"></i>
                                </div>
                            </div>
                        </div>
                        <div class="info">
                            <p class="card-text">
                            <h1 class="card-text display-5 text-white font-weight-bold">Penerimaan Barang</h1>
                            <i class="fa fa-truck"></i>
                            </p>
                            <hr class="mr-1">
                            <p class="card-text">
                                Membuat pesanan Penerimaan barang untuk pemasok
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
            <a href="{{ route('admin.purchase.faktur.index') }}">
                <div class="card bg-primary border-0 text-white shadow" >
                    <div class="card-body">
                        <div class="title">
                            <div class="row">
                                <div class="col">
                                    <h1 class="text-light">Faktur Pembelian</h1>
                                </div>
                                <div class="col">
                                    <i class="fa fa-book-open fa-lg fa-4x"></i>
                                </div>
                            </div>
                        </div>
                        <div class="info">
                            <p class="card-text">
                            <h1 class="card-text display-5 text-white font-weight-bold">Faktur Pembelian</h1>
                            <i class="fa fa-book-open"></i>
                            </p>
                            <hr class="mr-1">
                            <p class="card-text">
                                Mencatat Faktur Penjualan Untuk Pelanggan
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
            <a href="{{ route('admin.purchase.piutang.index') }}">
                <div class="card border-0 text-white shadow" style="background-color : #F6A9A9">
                    <div class="card-body">
                        <div class="title">
                            <div class="row">
                                <div class="col">
                                    <h1 class="text-light">Daftar Utang Usaha</h1>
                                </div>
                                <div class="col">
                                    <i class="fa fa-tasks fa-lg fa-4x"></i>
                                </div>
                            </div>
                        </div>
                        <div class="info">
                            <p class="card-text">
                            <h1 class="card-text display-5 text-white font-weight-bold">Daftar Piutang Usaha</h1>
                            <i class="fa fa-tasks"></i>
                            </p>
                            <hr class="mr-1">
                            <p class="card-text">
                                Menampilkan daftar perinci piutang dagang tiap pemasok
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
            <a href="{{ route('admin.purchase.pembayaran.index') }}">
                <div class="card border-0 text-white shadow" style="background-color : #B85C38">
                    <div class="card-body">
                        <div class="title">
                            <div class="row">
                                <div class="col">
                                    <h1 class="text-light">Pembayaran Utang Usaha</h1>
                                </div>
                                <div class="col">
                                    <i class="fa fa-credit-card fa-lg fa-4x"></i>
                                </div>
                            </div>
                        </div>
                        <div class="info">
                            <p class="card-text">
                            <h1 class="card-text display-5 text-white font-weight-bold">Pembayaran Piutang Usaha</h1>
                            <i class="fa fa-credit-card"></i>
                            </p>
                            <hr class="mr-1">
                            <p class="card-text">
                                Mencatat penerimaan Pembayaran piutang dagang
                            </p>
                            <p class="card-text">
                                <small class="text-light"></small>
                            </p>
                        </div>
                    </div>
                </div>
            </a>  
        </div>
    </div>
</section>