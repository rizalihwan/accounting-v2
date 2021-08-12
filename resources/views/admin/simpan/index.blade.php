@extends('_layouts.main')
@section('title', 'Simpan')
@push('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('admin.simpanpinjam') }}">Simpan & Pinjam</a>
    </li>
    <li class="breadcrumb-item" aria-current="page">Simpan</li>
@endpush
@section('content')
    <div class="row">
        <!-- end message area-->
        <div class="col-lg-12 col-md-6 col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex">
                        <h4 class="card-title">List Simpanan</h4>
                        <h4><span class="text-muted ml-1">{{ \DB::table('simpans')->count() }}</span></h4>
                    </div>
                    <a href="{{ route('admin.simpan.create') }}" class="btn btn-success">
                        <i data-feather="plus"></i>
                        Tambah Baru
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        {{-- <table class="table table-hover" @if($data->count() == 1) style="height: 140px" @endif> --}}
                            <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th style="width: 1px">#</th>
                                    <th>KETERANGAN</th>
                                    <th>KODE KONTAK</th>
                                    <th>JENIS SIMPANAN</th>
                                    <th>NO. REKENING</th>
                                    <th>ADMINISTRASI</th>
                                    <th>SETORAN</th>
                                    <th>PETUGAS</th>
                                    {{-- <th style="width: 1px">ACTION</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data as $key)
                                    <tr>
                                        <td>{{ $loop->iteration + $data->firstItem() - 1 }}</td>
                                        <td>{{ $key->keterangan }}</td>
                                        <td>{{ $key->kontak->kode_kontak }}</td>
                                        <td>{{ $key->jenis_simpanan }}</td>
                                        <td>{{ $key->no_rekening }}</td>
                                        <td>{{ $key->administrasi }}</td>
                                        <td>{{ $key->setoran }}</td>
                                        <td>{{ $key->petugas }}</td>
                                        {{-- <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn btn-sm dropdown-toggle hide-arrow" data-toggle="dropdown">
                                                    <i data-feather="more-vertical"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="{{ route('admin.jurnalumum.edit', $key->id) }}">
                                                        <i data-feather="edit" class="text-warning"></i>
                                                        <span class="ml-1">Edit</span>
                                                    </a>
                                                    <a class="dropdown-item"
                                                        href="{{ route('admin.jurnalumum.show', $key->id) }}">
                                                        <i data-feather="eye"></i>
                                                        <span class="ml-1">Show</span>
                                                    </a>
                                                    <a href="javascript:void('delete')" class="dropdown-item text-danger"
                                                        onclick="deleteConfirm('form-delete', '{{ $key->id }}')">
                                                        <i data-feather="trash"></i>
                                                        <span class="ml-1">Delete</span>
                                                    </a>
                                                    <form id="form-delete{{ $key->id }}" action="{{ route('admin.jurnalumum.destroy', $key->id) }}" method="POST">
                                                        @csrf
                                                        @method('delete')
                                                    </form>
                                                </div>
                                            </div>
                                        </td> --}}
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" align="center">Data kosong.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <hr style="margin-top: -1px">
                    </div>
                    {{ $data->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
@endsection
