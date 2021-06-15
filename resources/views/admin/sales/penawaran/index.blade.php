@extends('_layouts.main')
@section('title', 'Data Product')
@push('breadcrumb')
<li class="breadcrumb-item">
    <a href="{{ route('admin.sales') }}">Penjualan</a>
</li>
<li class="breadcrumb-item" aria-current="page">Penawaran Harga</li>
@endpush
@section('content')

<div class="row">
    <div class="col-lg-12 col-md-12 col-12">
        <div class="card card-payment">
            <div class="card-header py-2 d-flex justify-content-between align-items-center">
                <h4 class="card-title">Penawaran Harga</h4>
                <a href="{{ route('admin.penawaran.create') }}" class="btn btn-sm btn-primary shadow"><i data-feather="plus"></i></a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th style="width: 1px">#</th>
                                <th>Tanggal</th>
                                <th>No Penawaran</th>
                                <th>Nama Pelanggan</th>
                                <th>Nilai</th>
                                <th>Status</th>
                                <th style="width: 1px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($penawarans as $penawaran)
                            
                            @empty
                            <tr>
                                <td colspan="6" align="center">
                                    Tidak ada data
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <hr style="margin-top: -1px">
                    {{ $penawarans->links() }}
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
