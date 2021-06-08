@extends('_layouts.main')
@section('title', 'Laporan Neraca Keuangan')
@section('content')
<div class="container-fluid">
    <div class="page-header">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="ik ik-bar-chart-line- bg-red"></i>
                    <div class="d-inline">
                        <h5>Laporan</h5>
                        <span>Neraca Keuangan</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <nav class="breadcrumb-container" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}"><i class="ik ik-home"></i></a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.neracakeuangan.index') }}">Neraca Keuangan</a>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header row justify-content-between">
                    <div class="d-flex">
                        <a href="" onclick="" class="btn m-2 btn-danger">Print</a>
                        <a href="" onclick="" class="btn m-2 btn-success" id="export">Export</a>
                        <a href="" onclick="" class="btn m-2 btn-info">Info</a>
                    </div>
                    <div class="d-flex">
                        <input type="month" class="form-control" name="date" id="date">
                        <button type="submit" class="btn m-2 btn-primary"><i class="fa fa-search"></i> Filter</button>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-hover table-borderless" id="user_table">
                        <thead>
                            <tr>
                                <th>aktiva</th>
                                <th>passiva</th>
                            </tr>
                        </thead>
                        <!-- foreach -->
                        <!-- endforeach -->
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@push('script')

<script src="{{ asset('plugins/DataTables/datatables.min.js') }}"></script>
<script>
    $('#user_table').DataTable({
        processing: true,
        serverSide: true,
        language: {
              processing: '<i class="ace-icon fa fa-spinner fa-spin orange bigger-500" style="font-size:60px;margin-top:50px;"></i>'
        },
        ajax: `/admin/neracakeuangan/get/data`,
        columns: [{
                data: 'aktiva',
                name: 'aktiva'
            },
            {
                data: 'passiva',
                name: 'passiva'
            }
        ],
        buttons: [
                {
                    extend: 'copy',
                    className: 'btn-sm btn-info',
                    title: 'Roles',
                    header: false,
                    footer: true,
                    exportOptions: {
                        // columns: ':visible'
                    }
                },
                {
                    extend: 'csv',
                    className: 'btn-sm btn-success',
                    title: 'Roles',
                    header: false,
                    footer: true,
                    exportOptions: {
                        // columns: ':visible'
                    }
                },
                {
                    extend: 'excel',
                    className: 'btn-sm btn-warning',
                    title: 'Roles',
                    header: false,
                    footer: true,
                    exportOptions: {
                        // columns: ':visible',
                    }
                },
                {
                    extend: 'pdf',
                    className: 'btn-sm btn-primary',
                    title: 'Roles',
                    pageSize: 'A2',
                    header: false,
                    footer: true,
                    exportOptions: {
                        // columns: ':visible'
                    }
                },
                {
                    extend: 'print',
                    className: 'btn-sm btn-default',
                    title: 'Roles',
                    // orientation:'landscape',
                    pageSize: 'A2',
                    header: true,
                    footer: false,
                    orientation: 'landscape',
                    exportOptions: {
                        // columns: ':visible',
                        stripHtml: false
                    }
                }
            ],
    })
</script>
@endpush
@endsection
