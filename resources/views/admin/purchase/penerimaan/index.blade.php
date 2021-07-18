@extends('_layouts.main')
@section('title', 'Penerimaan Barang')
@push('breadcrumb')
<li class="breadcrumb-item">
  <a href="{{ route('admin.purchase.') }}">Pembelian</a>
</li>
<li class="breadcrumb-item active" aria-current="page">Penerimaan Barang</li>
@endpush
@section('content')

<div class="row">
    <div class="col-lg-12 col-md-12 col-12">
        <div class="card card-payment">
            <div class="card-header py-2 d-flex justify-content-between align-items-center">
                <div class="d-flex">
                    <h4 class="card-title">List Penerimaan Barang</h4>
                    <h4><span class="text-muted ml-1">{{ $countPenerimaan }}</span></h4>
                </div>
                <a href="{{ route('admin.purchase.terima.create') }}" class="btn btn-sm btn-primary shadow"><i data-feather="plus"></i></a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover" @if($countPenerimaan == 1) style="height: 140px" @endif>
                        <thead>
                            <tr>
                                <th style="width: 1px">#</th>
                                <th>Tanggal</th>
                                <th>Kode Penerimaan</th>
                                <th>Nama Pelanggan</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th style="width: 1px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($penerimaans as $terima)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $terima->tanggal }}</td>
                                <td>{{ $terima->kode }}</td>
                                <td>{{ $terima->pemasok->nama }}</td>
                                <td>{{ 'Rp. ' . number_format($terima->total, 0, ',', '.') }}</td>
                                <td>{{ $terima->status == 1 ? 'Aktif' : 'Tidak Aktif' }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn btn-sm dropdown-toggle hide-arrow"
                                            data-toggle="dropdown">
                                            <i data-feather="more-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item"
                                                href="{{ route('admin.purchase.terima.show', $terima->id) }}">
                                                <i data-feather="eye"></i>
                                                <span class="ml-1">Show</span>
                                            </a>
                                            <a class="dropdown-item" href="{{ route('admin.purchase.terima.edit', $terima->id) }}">
                                                <i data-feather="edit"></i>
                                                <span class="ml-1">Edit</span>
                                            </a>
                                            <a href="javascript:void('delete')" class="dropdown-item text-danger" 
                                                onclick="deleteConfirm('form-delete', '{{ $terima->id }}')">
                                                <i data-feather="trash"></i>
                                                <span class="ml-1">Delete</span>
                                            </a>
                                            <form id="form-delete{{ $terima->id }}" action="{{ route('admin.purchase.terima.destroy', $terima->id) }}" method="POST">
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
                    {{ $penerimaans->links() }}
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
