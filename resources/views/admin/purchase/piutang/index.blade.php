@extends('_layouts.main')
@section('title', 'Daftar Utang')
@push('breadcrumb')
<li class="breadcrumb-item">
    <a href="{{ route('admin.purchase.') }}">Pembelian</a>
</li>
<li class="breadcrumb-item" aria-current="page">Daftar Utang Usaha</li>
@endpush
@section('content')

<div class="row">
    <div class="col-lg-12 col-md-12 col-12">
        <div class="card card-payment">
            <div class="card-header py-2 d-flex justify-content-between align-items-center">
                <div class="d-flex">
                    <h4 class="card-title">Utang usaha</h4>
                    <h4><span class="text-muted ml-1">{{ $piutangs->count() }}</span></h4>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th style="width: 1px">#</th>
                                <th>Nama Pemasok</th>
                                <th>Total Piutang</th>
                                <th>Lunas</th>
                                <th>Sisa</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($piutangs as $piutang)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $piutang->pemasok->nama }}</td>
                                <td>{{ 'Rp. ' . number_format($piutang->total_hutang) }}</td>
                                <td>{{ 'Rp. ' . number_format($piutang->lunas) }}</td>
                                <td>{{ 'Rp. ' . number_format($piutang->sisa) }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" align="center">
                                    Tidak ada data
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <hr style="margin-top: -1px">
                    {{ $piutangs->links() }}
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
