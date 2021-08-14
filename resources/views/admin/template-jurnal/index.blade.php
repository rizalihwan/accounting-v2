@extends('_layouts.main')
@section('title', 'Template Jurnal')
@push('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('admin.ledger') }}">Jurnal</a>
    </li>
    <li class="breadcrumb-item" aria-current="page">Template Jurnal</li>
@endpush
@section('content')
    <div class="row">
        <!-- end message area-->
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex">
                        <h4 class="card-title">List Template Jurnal</h4>
                        <h4><span class="text-muted ml-1">{{ $data->count() }}</span></h4>
                    </div>
                    <a href="{{ route('admin.template-jurnal.create') }}" class="btn btn-success">
                        <i data-feather="plus"></i>
                        Tambah
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" @if($data->count() == 1) style="height: 140px" @endif>
                            <thead>
                                <tr>
                                    <th style="width: 1px">#</th>
                                    <th>Sumber</th>
                                    <th>Nama Template</th>
                                    <th>Kontak</th>
                                    <th>Frekuensi</th>
                                    <th>Tanggal</th>
                                    <th style="width: 1px" {{-- colspan="2" --}}>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data as $key)
                                    <tr>
                                        <td>{{ $loop->iteration + $data->firstItem() - 1 }}</td>
                                        <td>{{ $key->sumber }}</td>
                                        <td>{{ $key->nama_template }}</td>
                                        <td>{{ $key->kontak->nama }}</td>
                                        <td>{{ $key->frekuensi }}</td>
                                        <td>{{ $key->per_tanggal }}</td>
                                        {{-- <td class="px-1">
                                            <a href="{{ route('admin.jurnalumum.create').'?template_id='.$key->id }}" class="btn btn-warning btn-sm" 
                                                style="width: 140px">
                                                <span class="ml-1">Buat Jurnal</span>
                                                <i data-feather="external-link"></i>
                                            </a>
                                        </td> --}}
                                        <td {{-- class="px-1" --}}>
                                            <div class="dropdown">
                                                <button type="button" class="btn btn-sm dropdown-toggle hide-arrow" data-toggle="dropdown">
                                                    <i data-feather="more-vertical"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    {{-- <a class="dropdown-item" href="{{ route('admin.template-jurnal.edit', $key->id) }}">
                                                        <i data-feather="edit" class="text-warning"></i>
                                                        <span class="ml-1">Edit</span>
                                                    </a>
                                                    <a class="dropdown-item"
                                                        href="{{ route('admin.template-jurnal.show', $key->id) }}">
                                                        <i data-feather="eye"></i>
                                                        <span class="ml-1">Show</span>
                                                    </a> --}}
                                                    <a href="javascript:void('delete')" class="dropdown-item text-danger" 
                                                        onclick="deleteConfirm('form-delete', '{{ $key->id }}')">
                                                        <i data-feather="trash"></i>
                                                        <span class="ml-1">Delete</span>
                                                    </a>
                                                    <form id="form-delete{{ $key->id }}" action="{{ route('admin.template-jurnal.destroy', $key->id) }}" method="POST">
                                                        @csrf
                                                        @method('delete')
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
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