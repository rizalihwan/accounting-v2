@section('title', 'Jurnal')

@push('breadcrumb')
    <li class="breadcrumb-item active">Jurnal</li>
@endpush

<section>
    <div class="row">
        <div class="col-md-3 col-xl-3">
            <a href="{{ route('admin.simpan.index') }}">
                <div class="card bg-primary border-0 text-white">
                    <div class="card-body">
                        <div class="title">
                            <div class="row">
                                <div class="col">
                                    <h1 class="text-light">Simpan</h1>
                                </div>
                                <div class="col">
                                    <i class="fa fa-book-open fa-lg fa-5x"></i>
                                </div>
                            </div>
                        </div>
                        <div class="info">
                            <p class="card-text">
                            <h1 class="card-text display-5 text-white font-weight-bold">Simpan</h1>
                            <i class="fa fa-book-open"></i>
                            </p>
                            <hr class="mr-1">
                            <p class="card-text">
                                Menu simpan untuk koperasi
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
            <a href="{{ route('admin.pinjam.index') }}">
                <div class="card bg-warning border-0 text-white">
                    <div class="card-body">
                        <div class="title">
                            <div class="row">
                                <div class="col">
                                    <h1 class="text-light">Pinjam</h1>
                                </div>
                                <div class="col">
                                    <i class="fa fa-book fa-lg fa-5x"></i>
                                </div>
                            </div>
                        </div>
                        <div class="info">
                            <p class="card-text">
                            <h1 class="card-text display-5 text-white font-weight-bold">Pinjam</h1>
                            <i class="fa fa-book"></i>
                            </p>
                            <hr class="mr-1">
                            <p class="card-text">
                                Menu pinjam
                            </p>
                            <p class="card-text">
                                <small class="text-light"> </small>
                            </p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
</section>
