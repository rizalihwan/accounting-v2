@extends('_layouts.main')
@section('title', 'Jurnal Umum')
@push('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('admin.ledger') }}">Jurnal</a>
    </li>
    <li class="breadcrumb-item" aria-current="page">Jurnal Umum</li>
@endpush
@section('content')
        <div class="row">
            <!-- end message area-->
            <div class="col-lg-12 col-md-6 col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex">
                            <h4 class="card-title">List Jurnal Umum</h4>
                            <h4><span class="text-muted ml-1">{{ $countJurnal }}</span></h4>
                        </div>
                        <a href="{{ route('admin.jurnalumum.create') }}" class="btn btn-success">
                            <i data-feather="plus"></i>
                            Create New
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover" style="height: {{ $countJurnal == 1 ? '100px' : '' }}">
                                <thead>
                                    <tr>
                                        <th>TANGGAL</th>
                                        <th>NO. REFERENSI</th>
                                        <th>URAIAN</th>
                                        <th>NILAI</th>
                                        <th>STATUS</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($data as $key)
                                        <tr>
                                            <td>{{ $key->jurnalumum->tanggal }}</td>
                                            <td>{{ $key->jurnalumum->kode_jurnal }}</td>
                                            <td>{{ $key->jurnalumum->uraian }}</td>
                                            <td>{{ 'IDR ' . number_format($key->debit, 0, ',', '.') }}</td>
                                            <td>{!! $key->jurnalumum->StatusType !!}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn btn-sm dropdown-toggle hide-arrow" data-toggle="dropdown">
                                                        <i data-feather="more-vertical"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="{{ route('admin.jurnalumum.edit', $key->id) }}">
                                                            <i data-feather="edit" style="color: rgb(184, 184, 36)"></i>
                                                            <span class="ml-1">Edit</span>
                                                        </a>
                                                        <a href="javascript:void('delete')" class="dropdown-item text-danger" 
                                                            onclick="deleteConfirm('form-delete', '{{ $key->jurnalumum_id }}')">
                                                            <i data-feather="trash"></i>
                                                            <span class="ml-1">Delete</span>
                                                        </a>
                                                        <form id="form-delete{{ $key->jurnalumum_id }}" action="{{ route('admin.jurnalumum.destroy', $key->jurnalumum_id) }}" method="POST">
                                                            @csrf
                                                            @method('delete')
                                                        </form>
                                                        <a class="dropdown-item"
                                                            href="{{ route('admin.jurnalumum.show', $key->jurnalumum_id) }}">
                                                            <i data-feather="eye" style="color: blue"></i>
                                                            <span class="ml-1">Show</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" align="center">Data kosong.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            {{ $data->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection