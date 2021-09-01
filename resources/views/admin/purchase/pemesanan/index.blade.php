@extends('_layouts.main')
@section('title', 'Penawaran Harga')
@push('breadcrumb')
<li class="breadcrumb-item">
    <a href="{{ route('admin.purchase.') }}">Pembelian</a>
</li>
<li class="breadcrumb-item" aria-current="page">Pesanan Pembelian</li>
@endpush
@section('content')

<div class="row">
    <div class="col-lg-12 col-md-12 col-12">
        <div class="card card-payment">
            <div class="card-header py-2 d-flex justify-content-between align-items-center">
                <div class="d-flex">
                    <h4 class="card-title">List Pesanan Pembelian</h4>
                    <h4><span class="text-muted ml-1">{{ $countPesanan }}</span></h4>
                </div>
                <a href="{{ route('admin.purchase.pesanan.create') }}" class="btn btn-sm btn-primary shadow"><i data-feather="plus"></i></a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover" @if($countPesanan == 1) style="height: 140px" @endif>
                        <thead>
                            <tr>
                                <th style="width: 1px">#</th>
                                <th>Tanggal</th>
                                <th>kode Pesanan</th>
                                <th>Nama Pelanggan</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th style="width: 1px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pesanans as $pesanan)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $pesanan->tanggal }}</td>
                                <td>{{ $pesanan->kode }}</td>
                                <td>{{ $pesanan->pemasok->nama }}</td>
                                <td>{{ 'Rp. ' . number_format($pesanan->total, 0, ',', '.') }}</td>
                                <td>@if($pesanan->status == 1)
                                    <span class="badge badge-success">Open</span>
                                    @else
                                    <span class="badge badge-info">Delivered</span>
                                    @endif</td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn btn-sm dropdown-toggle hide-arrow"
                                            data-toggle="dropdown">
                                            <i data-feather="more-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item"
                                                href="{{ route('admin.purchase.pesanan.show', $pesanan->id) }}">
                                                <i data-feather="eye"></i>
                                                <span class="ml-1">Show</span>
                                            </a>
                                            <a class="dropdown-item" href="{{ route('admin.purchase.pesanan.edit', $pesanan->id) }}">
                                                <i data-feather="edit"></i>
                                                <span class="ml-1">Edit</span>
                                            </a>
                                            <a href="javascript:void('delete')" class="dropdown-item text-danger"
                                                onclick="deleteConfirm('form-delete', '{{ $pesanan->id }}')">
                                                <i data-feather="trash"></i>
                                                <span class="ml-1">Delete</span>
                                            </a>
                                            <form id="form-delete{{ $pesanan->id }}" action="{{ route('admin.purchase.pesanan.destroy', $pesanan->id) }}" method="POST">
                                                @csrf
                                                @method('delete')
                                            </form>
                                        </div>
                                    </div>
                                </td>
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
                    {{ $pesanans->links() }}
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
