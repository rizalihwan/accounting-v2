@extends('_layouts.main')
@section('title', 'Pinjam')
@push('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('admin.simpanpinjam') }}">Simpan & Pinjam</a>
    </li>
    <li class="breadcrumb-item" aria-current="page">Pinjam</li>
@endpush
@section('content')
    <div class="row">
        <!-- end message area-->
        <div class="col-lg-12 col-md-6 col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex">
                        <h4 class="card-title">List Pinjaman</h4>
                        <h4><span class="text-muted ml-1">0</span></h4>
                    </div>
                    <div class="d-flex justify-content-around">
                        <a href="{{ route('admin.pinjam.import_form') }}" class="btn btn-info ml-1">
                            Import
                        </a>
                        <a href="{{ route('admin.pinjam.export') }}" class="btn btn-primary ml-1">
                            Export
                        </a>
                        <a href="{{ route('admin.pinjam.create') }}" class="btn btn-success ml-1">
                            <i data-feather="plus"></i>
                            Tambah Baru
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" @if($pinjam->count() == 1) style="height: 140px" @endif>
                            <thead>
                                <tr>
                                    <th style="width: 1px">#</th>
                                    <th>Jumlah Pinjaman</th>
                                    <th>Jangka</th>
                                    <th>Bunga</th>
                                    <th>Tipe</th>
                                    <th>Keterangan</th>
                                    <th style="width: 1px">ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($pinjam as $key)
                                    <tr>
                                        <td>{{ $loop->iteration++ }}</td>
                                        <td>{{ number_format($key->jumlah_pinjaman) }}</td>
                                        <td>{{ $key->jangka }} Bulan</td>
                                        <td>{{ $key->bungapersen }}%</td>
                                        <td>{{ $key->type }}</td>
                                        <td>{{ $key->keterangan }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn btn-sm dropdown-toggle hide-arrow" data-toggle="dropdown">
                                                    <i data-feather="more-vertical"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="{{ route('admin.pinjam.edit', $key->id) }}">
                                                        <i data-feather="edit" class="text-warning"></i>
                                                        <span class="ml-1">Edit</span>
                                                    </a>
                                                    <a class="dropdown-item"
                                                        href="{{ route('admin.pinjam.show', $key->id) }}">
                                                        <i data-feather="eye"></i>
                                                        <span class="ml-1">Show</span>
                                                    </a>
                                                    <a href="javascript:void('delete')" class="dropdown-item text-danger"
                                                        onclick="deleteConfirm('form-delete', '{{ $key->id }}')">
                                                        <i data-feather="trash"></i>
                                                        <span class="ml-1">Delete</span>
                                                    </a>
                                                    <form id="form-delete{{ $key->id }}" action="{{ route('admin.pinjam.destroy', $key->id) }}" method="POST">
                                                        @csrf
                                                        @method('delete')
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" align="center">Data kosong.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <hr style="margin-top: -1px">
                    </div>
                    {{ $pinjam->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
@endsection
