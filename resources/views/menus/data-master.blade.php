@section('title', 'Data Master')

@push('breadcrumb')
    <li class="breadcrumb-item active">Data Master</li>
@endpush

<section id="card-content-types">
    <div class="row">
        <div class="col-md-3 col-xl-3">
            <a href="{{ route('admin.kontak.index') }}">
                <div class="card border-0 text-white" style="background-color: #542E71;">
                    <div class="card-body">
                        <div class="title">
                            <div class="row">
                                <div class="col">
                                    <h1 class="text-light">Kontak</h1>
                                </div>
                                <div class="col">
                                    <i class="fa fa-users fa-lg fa-5x"></i>
                                </div>
                            </div>
                        </div>
                        <div class="info">
                            <p class="card-text">
                            <h1 class="card-text display-5 text-white font-weight-bold">Data Kontak</h1>
                            <i class="fa fa-users"></i>
                            </p>
                            <hr class="mr-1">
                            <p class="card-text">
                                Membuat dan menyunting data pelanggan, pemasok, dan karyawan.
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
            <a href="{{ route('admin.akun.index') }}">
                <div class="card border-0 text-white" style="background-color: #FB3640;">
                    <div class="card-body">
                        <div class="title">
                            <div class="row">
                                <div class="col">
                                    <h1 class="text-light">Daftar Akun</h1>
                                </div>
                                <div class="col">
                                    <i class="fa fa-clipboard-list fa-lg fa-5x"></i>
                                </div>
                            </div>
                        </div>
                        <div class="info">
                            <p class="card-text">
                            <h1 class="card-text display-5 text-white font-weight-bold">Daftar Akun</h1>
                            <i class="fa fa-clipboard-list"></i>
                            </p>
                            <hr class="mr-1">
                            <p class="card-text">
                                Membuat dan menyunting data rekening
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
            <a href="{{ route('admin.bank.index') }}">
                <div class="card border-0 text-white" style="background-color: #A799B7;">
                    <div class="card-body">
                        <div class="title">
                            <div class="row">
                                <div class="col">
                                    <h1 class="text-light">Bank</h1>
                                </div>
                                <div class="col">
                                    <i class="fa fa-money-bill-alt fa-lg fa-5x"></i>
                                </div>
                            </div>
                        </div>
                        <div class="info">
                            <p class="card-text">
                            <h1 class="card-text display-5 text-white font-weight-bold">Bank</h1>
                            <i class="fa fa-money-bill-alt"></i>
                            </p>
                            <hr class="mr-1">
                            <p class="card-text">
                                Mengelola data bank
                            </p>
                            <p class="card-text">
                                <small class="text-light"></small>
                            </p>
                        </div>
                    </div>
                </div>
            </a>
        </div> --}}
        <div class="col-md-3 col-xl-3">
            <a href="{{ route('admin.divisi.index') }}">
                <div class="card border-0 text-white" style="background-color: #194350;">
                    <div class="card-body">
                        <div class="title">
                            <div class="row">
                                <div class="col">
                                    <h1 class="text-light">Divisi</h1>
                                </div>
                                <div class="col">
                                    <i class="fa fa-divide fa-lg fa-5x"></i>
                                </div>
                            </div>
                        </div>
                        <div class="info">
                            <p class="card-text">
                            <h1 class="card-text display-5 text-white font-weight-bold">Divisi</h1>
                            <i class="fa fa-divide"></i>
                            </p>
                            <hr class="mr-1">
                            <p class="card-text">
                                Mengelola data divisi
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
            <a href="{{ route('admin.unit.index') }}">
                <div class="card border-0 text-white" style="background-color: #FF8882;">
                    <div class="card-body">
                        <div class="title">
                            <div class="row">
                                <div class="col">

                                    <h1 class="text-light">Unit</h1>
                                </div>
                                <div class="col">
                                    <i class="fa fa-address-book fa-lg fa-5x"></i>
                                </div>
                            </div>
                        </div>
                        <div class="info">
                            <p class="card-text">
                            <h1 class="card-text display-5 text-white font-weight-bold">Unit</h1>
                            <i class="fa fa-address-book"></i>
                            </p>
                            <hr class="mr-1">
                            <p class="card-text">
                                Mengelola data unit
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
            <a href="{{ route('admin.product.index') }}">
                <div class="card border-0 text-white" style="background-color: #008891;">
                    <div class="card-body">
                        <div class="title">
                            <div class="row">
                                <div class="col">
                                    <h1 class="text-light">Produk</h1>
                                </div>
                                <div class="col">
                                    <i class="fa fa-chart-line fa-lg fa-5x"></i>
                                </div>
                            </div>
                        </div>
                        <div class="info">
                            <p class="card-text">
                            <h1 class="card-text display-5 text-white font-weight-bold">Produk</h1>
                            <i class="fa fa-chart-line"></i>
                            </p>
                            <hr class="mr-1">
                            <p class="card-text">
                                Mengelola data barang
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
            <a href="{{ route('admin.category.index') }}">
                <div class="card border-0 text-white" style="background-color: #7952B3;">
                    <div class="card-body">
                        <div class="title">
                            <div class="row">
                                <div class="col">
                                    <h1 class="text-light">Kategori</h1>
                                </div>
                                <div class="col">
                                    <i class="fa fa-box fa-lg fa-5x"></i>
                                </div>
                            </div>
                        </div>
                        <div class="info">
                            <p class="card-text">
                            <h1 class="card-text display-5 text-white font-weight-bold">Category</h1>
                            <i class="fa fa-box"></i>
                            </p>
                            <hr class="mr-1">
                            <p class="card-text">
                                Mengelola data Category
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
