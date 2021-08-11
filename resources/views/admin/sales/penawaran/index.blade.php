@extends('_layouts.main')
@section('title', 'Penawaran Harga')
@push('breadcrumb')
<li class="breadcrumb-item">
    <a href="{{ route('admin.sales.') }}">Penjualan</a>
</li>
<li class="breadcrumb-item" aria-current="page">Penawaran Harga</li>
@endpush
@section('content')

<div class="row">
    <div class="col-lg-12 col-md-12 col-12">
        <div class="card card-payment">
            <div class="card-header py-2 d-flex justify-content-between align-items-center">
                <div class="d-flex">
                    <h4 class="card-title">List Penawaran Harga</h4>
                    <h4><span class="text-muted ml-1">{{ $countPenawaran }}</span></h4>
                </div>
                <a href="{{ route('admin.sales.penawaran.create') }}" class="btn btn-sm btn-primary shadow"><i data-feather="plus"></i></a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover " @if($countPenawaran == 1) style="height: 140px" @endif>
                        <thead>
                            <tr>
                                <th style="width: 1px">#</th>
                                <th>Tanggal</th>
                                <th>kode Penawaran</th>
                                <th>Nama Pelanggan</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th style="width: 1px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($penawarans as $penawaran)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $penawaran->tanggal }}</td>
                                <td>{{ $penawaran->kode }}</td>
                                <td>{{ $penawaran->pelanggan->nama }}</td>
                                <td>{{ 'Rp. ' . number_format($penawaran->total, 0, ',', '.') }}</td>
                                <td>@if($penawaran->status == 0)
                                    <span class="badge badge-success">Open</span>
                                    @else
                                    <span class="badge badge-warning">Closed</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn btn-sm dropdown-toggle hide-arrow"
                                            data-toggle="dropdown">
                                            <i data-feather="more-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item"
                                                href="{{ route('admin.sales.penawaran.show', $penawaran->id) }}">
                                                <i data-feather="eye"></i>
                                                <span class="ml-1">Show</span>
                                            </a>
                                            <a class="dropdown-item" href="{{ route('admin.sales.penawaran.edit', $penawaran->id) }}">
                                                <i data-feather="edit"></i>
                                                <span class="ml-1">Edit</span>
                                            </a>
                                            <a href="javascript:void('delete')" class="dropdown-item text-danger" 
                                                onclick="deleteConfirm('form-delete', '{{ $penawaran->id }}')">
                                                <i data-feather="trash"></i>
                                                <span class="ml-1">Delete</span>
                                            </a>
                                            <form id="form-delete{{ $penawaran->id }}" action="{{ route('admin.sales.penawaran.destroy', $penawaran->id) }}" method="POST">
                                                @csrf
                                                @method('delete')
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>      
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
