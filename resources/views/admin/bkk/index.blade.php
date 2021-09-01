@extends('_layouts.main')
@section('title', 'Buku Kas Keluar')
    @push('breadcrumb')
        <li class="breadcrumb-item">
            <a href="{{ route('admin.cash-bank') }}">Kas & Bank</a>
        </li>
        <li class="breadcrumb-item active">Buku Kas Keluar</li>
    @endpush
@section('content')
    <div class="row">
        <!-- end message area-->
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <div class="d-flex">
                        <h4 class="card-title">List Buku Kas Keluar</h4>
                        <h4><span class="text-muted ml-1">{{ $countBkk }}</span></h4>
                    </div>
                    <a href="{{ route('admin.bkk.create') }}" class="btn btn-success">
                        <i data-feather="plus"></i>
                        Create New
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" @if (count($indeks) == 1) style="height: 140px" @endif>
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Tanggal</th>
                                    <th>Nomor Kas Keluar</th>
                                    <th>nama rekening</th>
                                    <th>untuk Pembayaran</th>
                                    <th>Value</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($indeks as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->tanggal }}</td>
                                        @if ($row > 0)
                                            @if ($item->id < 9)
                                                <td>KK0000{{ $item->id }}</td>
                                            @elseif ($item->id < 99) <td>KK000{{ $item->id }}</td>
                                                @elseif ($item->id < 999) <td>KK00{{ $item->id }}</td>
                                                    @elseif ($item->id < 9999) <td>KK0{{ $item->id }}</td>
                                                        @else
                                                            <td>KK{{ $item->id }}</td>
                                            @endif
                                        @endif
                                        <td>{{ $item->akun->name }} - {{ $item->akun->name }}</td>
                                        <td>{{ $item->desk }}</td>
                                        <td>{{ $item->value }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn btn-sm dropdown-toggle hide-arrow"
                                                    data-toggle="dropdown">
                                                    <i data-feather="more-vertical"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item"
                                                        href="{{ route('admin.bkk.edit', $item->id) }}">
                                                        <i data-feather="edit" class="text-warning"></i>
                                                        <span class="ml-1">Edit</span>
                                                    </a>
                                                    <a class="dropdown-item"
                                                        href="{{ route('admin.bkk.show', $item->id) }}">
                                                        <i data-feather="eye"></i>
                                                        <span class="ml-1">Show</span>
                                                    </a>
                                                    <a href="javascript:void('delete')" class="dropdown-item text-danger"
                                                        onclick="deleteConfirm('form-delete', '{{ $item->id }}')">
                                                        <i data-feather="trash"></i>
                                                        <span class="ml-1">Delete</span>
                                                    </a>
                                                    <form id="form-delete{{ $item->id }}"
                                                        action="{{ route('admin.bkk.destroy', $item->id) }}"
                                                        method="POST">
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
                        <div class="my-2">
                            {{ $indeks->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
