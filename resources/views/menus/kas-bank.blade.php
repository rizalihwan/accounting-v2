@section('title', 'Kas & Bank')

@push('breadcrumb')
    <li class="breadcrumb-item active">Kas & Bank</li>
@endpush

<section id="card-content-types">
    <div class="row">
        <div class="col-md-4">
            <a href="{{ route('admin.bkk.index') }}">
                <div class="card bg-warning border-0 text-white">
                    <div class="card-body">
                        <div class="title">
                            <div class="row">
                                <div class="col-md-10">
                                    <h1 class="text-light">Pengeluaran</h1>
                                </div>
                                <div class="col-md-2">
                                    <i class="fa fa-hand-holding-usd fa-lg fa-5x"></i>
                                </div>
                            </div>
                        </div>
                        <div class="info">
                            <p class="card-text">
                            <h1 class="card-text display-5 text-white font-weight-bold">Pengeluaran</h1>
                            <i class="fa fa-hand-holding-usd"></i>
                            </p>
                            <hr class="mr-1">
                            <p class="card-text">
                                Mencatat pengeluaran kas/bank
                            </p>
                            <p class="card-text">
                                <small class="text-light"></small>
                            </p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('admin.bkm.index') }}">
                <div class="card bg-success border-0 text-white">
                    <div class="card-body">
                        <div class="title">
                            <div class="row">
                                <div class="col-md-10">
                                    <h1 class="text-light">Penerimaan</h1>
                                </div>
                                <div class="col-md-2">
                                    <i class="fa fa-hand-holding-usd fa-lg fa-5x"></i>
                                </div>
                            </div>
                        </div>
                        <div class="info">
                            <p class="card-text">
                            <h1 class="card-text display-5 text-white font-weight-bold">Penerimaan</h1>
                            <i class="fa fa-hand-holding-usd"></i>
                            </p>
                            <hr class="mr-1">
                            <p class="card-text">
                                Mencatat penerimaan kas/bank
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