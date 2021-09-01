@extends('_layouts.main')
@section('title', 'Penawaran Harga')
@push('breadcrumb')
<li class="breadcrumb-item">
    <a href="{{ route('admin.sales.') }}">Penjualan</a>
</li>
<li class="breadcrumb-item active" aria-current="page">Pengiriman Barang</li>
@endpush
@section('content')

<div class="row">
    <div class="col-lg-12 col-md-12 col-12">
        <div class="card card-payment">
            <div class="card-header py-2 d-flex justify-content-between align-items-center">
                <div class="d-flex">
                    <h4 class="card-title">List Pengiriman Barang</h4>
                    <h4><span class="text-muted ml-1">{{ $countPengiriman }}</span></h4>
                </div>
                <a href="{{ route('admin.sales.pengiriman.create') }}" class="btn btn-sm btn-primary shadow"><i data-feather="plus"></i></a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover" @if($countPengiriman == 1) style="height: 140px" @endif>
                        <thead>
                            <tr>
                                <th style="width: 1px">#</th>
                                <th>Tanggal</th>
                                <th>kode Pengiriman</th>
                                <th>Nama Pelanggan</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th style="width: 1px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pengirimans as $pengiriman)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $pengiriman->tanggal }}</td>
                                <td>{{ $pengiriman->kode }}</td>
                                <td>{{ $pengiriman->pelanggan->nama }}</td>
                                <td>{{ 'Rp. ' . number_format($pengiriman->total, 0, ',', '.') }}</td>
                                <td>@if($pengiriman->status == 0)
                                    <span class="badge badge-success">Open</span>
                                    @else
                                    <span class="badge badge-warning">Closed</span>
                                    @endif</td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn btn-sm dropdown-toggle hide-arrow"
                                            data-toggle="dropdown">
                                            <i data-feather="more-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item"
                                                href="{{ route('admin.sales.pengiriman.show', $pengiriman->id) }}">
                                                <i data-feather="eye"></i>
                                                <span class="ml-1">Show</span>
                                            </a>
                                            <a class="dropdown-item" href="{{ route('admin.sales.pengiriman.edit', $pengiriman->id) }}">
                                                <i data-feather="edit"></i>
                                                <span class="ml-1">Edit</span>
                                            </a>
                                            <a href="javascript:void('delete')" class="dropdown-item text-danger" 
                                                onclick="deleteConfirm('form-delete', '{{ $pengiriman->id }}')">
                                                <i data-feather="trash"></i>
                                                <span class="ml-1">Delete</span>
                                            </a>
                                            <form id="form-delete{{ $pengiriman->id }}" action="{{ route('admin.sales.pengiriman.destroy', $pengiriman->id) }}" method="POST">
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
                    {{ $pengirimans->links() }}
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
