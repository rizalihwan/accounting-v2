@extends('_layouts.main')
@section('title', 'Akun')
    @push('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('admin.data-store') }}">Data Master</a>
    </li>
        <li class="breadcrumb-item active">Chart of Account</li>
    @endpush
@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- end message area-->
            <div class="col-md-12">
                <div class="card p-3">
                    <div class="card-header justify-content-between d-flex">
                        <div>
                            <a href="{{ route('admin.akun.create') }}" class="btn btn-primary btn-lg"><i
                                    class="fa fa-plus"></i> TAMBAH AKUN</a>
                        </div>
                        <div class="d-flex">
                            <input id="myInput" type="text" class="form-control" onkeyup="searchData()" placeholder="Search...">
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Kode Akun</th>
                                        <th>Nama akun</th>
                                        <th>Subklasifikasi</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($data as $item)
                                        <tr>
                                            <th>{{ $loop->iteration + $data->firstItem() - 1 . '.' }}</th>
                                            <td>
                                                <span class="badge badge-success">{{ $item->kode }}</span>
                                            </td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->subklasifikasi->name }}</td>
                                            <td>
                                                {{-- <a href="{{ route('admin.akun.edit', $item->id) }}"
                                                    class="btn btn-info btn-sm mr-1" style="float: left;"><i
                                                        class="fa fa-edit"></i></a>
                                                <form action="{{ route('admin.akun.destroy', $item->id) }}" method="post"
                                                    onclick="return confirm('Apakah yakin?')">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i
                                                            class="fa fa-trash"></i></button>
                                                </form> --}}
                                                <div class="dropdown">
                                                    <button type="button" class="btn btn-sm dropdown-toggle hide-arrow" data-toggle="dropdown">
                                                        <i data-feather="more-vertical"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="{{ route('admin.akun.edit', $item->id) }}">
                                                            <i data-feather="edit"></i>
                                                            <span class="ml-1">Edit</span>
                                                        </a>
                                                        <a href="javascript:void('delete')" class="dropdown-item text-danger" 
                                                            onclick="deleteConfirm('form-delete', '{{ $item->id }}')">
                                                            <i data-feather="trash"></i>
                                                            <span class="ml-1">Delete</span>
                                                        </a>
                                                        <form id="form-delete{{ $item->id }}" action="{{ route('admin.akun.destroy', $item->id) }}" method="POST">
                                                            @csrf
                                                            @method('delete')
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <th colspan="5" style="color: red; text-align: center;">Data Empty!</th>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        {{ $data->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
