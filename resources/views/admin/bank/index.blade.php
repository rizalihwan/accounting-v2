@extends('_layouts.main')
@section('title', 'Data Bank')
    @push('breadcrumb')
        <li class="breadcrumb-item">
            <a href="{{ route('admin.ledger') }}">Data Master</a>
        </li>
        <li class="breadcrumb-item" aria-current="page">Data Bank</li>
    @endpush
@section('content')
    <div class="row">
        <!-- end message area-->
        <div class="col-lg-12 col-md-6 col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex">
                        <h4 class="card-title">List Data Bank</h4>
                        {{-- <h4><span class="text-muted ml-1">{{ $countJurnal }}</span></h4> --}}
                    </div>
                    <a href="{{ route('admin.bank.create') }}" class="btn btn-success">
                        <i data-feather="plus"></i>
                        Create New
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" @if ($banks->count() == 1) style="height: 140px" @endif>
                            <thead>
                                <tr>
                                    <th>Kode</th>
                                    <th>Nama Bank</th>
                                    <th>Alamat</th>
                                    <th>Kota</th>
                                    <th>Telepon</th>
                                    <th style="width: 1px">ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($banks as $bank)
                                    <tr>
                                        <td>{{ $bank->kode }}</td>
                                        <td><a href="{{ route('admin.bank.show', $bank->id) }}"
                                                style="color: blue;">{{ $bank->nama_bank }}</a></td>
                                        <td>{{ $bank->alamat }}</td>
                                        <td>{{ $bank->kota }}</td>
                                        <td>{{ $bank->telepon }}</td>
                                        <td>
                                            {{-- <a href="{{ route('admin.bank.edit',$bank->id) }}" class="btn btn-info btn-sm mr-1" style="float: left;"><i class="fa fa-edit"></i></a>
                                        <form action="#" method="post">
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                        </form> --}}
                                            <div class="dropdown">
                                                <button type="button" class="btn btn-sm dropdown-toggle hide-arrow"
                                                    data-toggle="dropdown">
                                                    <i data-feather="more-vertical"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item"
                                                        href="{{ route('admin.bank.edit', $bank->id) }}">
                                                        <i data-feather="edit"></i>
                                                        <span class="ml-1">Edit</span>
                                                    </a>
                                                    <a href="javascript:void('delete')" class="dropdown-item text-danger"
                                                        onclick="deleteConfirm('form-delete', '{{ $bank->id }}')">
                                                        <i data-feather="trash"></i>
                                                        <span class="ml-1">Delete</span>
                                                    </a>
                                                    <form id="form-delete{{ $bank->id }}"
                                                        action="{{ route('admin.bank.destroy', $bank->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('delete')
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $banks->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
@endsection
