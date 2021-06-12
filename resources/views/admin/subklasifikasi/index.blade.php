@extends('_layouts.main')
@section('title', 'Subklasifikasi')
    @push('breadcrumb')
        <li class="breadcrumb-item active">Subklasifikasi</li>
    @endpush
@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- end message area-->
            <div class="col-md-12">
                <div class="card p-3">
                    <div class="card-header justify-content-between d-flex">
                        <div>
                            <a href="{{ route('admin.subklasifikasi.create') }}" class="btn btn-primary btn-lg"><i class="fa fa-plus"></i> TAMBAH SUBKLASIFIKASI</a>
                        </div>
                        <div class="d-flex">
                            <input id="myInput" type="text" class="form-control" onkeyup="searchData()" placeholder="Search...">
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="myTable" class="table table-light table-hover">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Subklasifikasi</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data as $item)
                                <tr>
                                    <th>{{ $loop->iteration + $data->firstItem() - 1 . '.' }}</th>
                                    <td>{{ $item->name }}</td>
                                    <td>
                                        <a href="{{ route('admin.subklasifikasi.edit', $item->id) }}" class="btn btn-info btn-sm mr-1" style="float: left;"><i class="fa fa-edit"></i></a>
                                        <form action="{{ route('admin.subklasifikasi.destroy', $item->id) }}" method="post" onclick="return confirm('Apakah yakin?')">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <th colspan="3" style="color: red; text-align: center;">Data Empty!</th>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $data->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
