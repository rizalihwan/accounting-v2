@extends('_layouts.main')
@section('title', 'Buku Kas Keluar')
    @push('breadcrumb')
        <li class="breadcrumb-item">
            <a href="{{ route('admin.cash-bank') }}">Kas & Bank</a>
        </li>
        <li class="breadcrumb-item active">
            <a href="{{ route('admin.bkk.index') }}">Buku Kas Keluar</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">Edit</li>
    @endpush
@section('content')
    <div class="row">
        <div class="col-md-12">
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <div class="alert-body">
                        @foreach ($errors->all() as $error)
                        <ul style="margin: 0 12px 0 -11px">
                            <li>{{ $error }}</li>
                        </ul>
                        @endforeach
                    </div>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <form action="{{ route('admin.bkk.update', $bkk->id) }}" method="POST" class="invoice-repeater">
                @csrf
                @method('put')
                <div class="card mb-2 ">
                    <div class="card-header">
                        <h4>Edit Expanse</h4>
                    </div>
                    <div class="card-body">
                        <div class="row d-flex align-items-end">
                            <div class="col-md-4 col-12 ">
                                <div class="form-group">
                                    <label for="tanggal">Tanggal</label>
                                    <input type="date" class="form-control" name="tanggal" value="{{  $bkk->tanggal }}" required />
                                </div>
                            </div>
                        </div>
                        <div class="row d-flex align-items-end">
                            <div class="col-md-4 col-12 ">
                                <div class="form-group">
                                    <label for="kontak_id">Sudah Bayar Ke</label>
                                    <select name="kontak_id" id="kontak_id" class="form-control"></select>
                                </div>
                            </div>
                            <div class="col-md-11 col-12 ">
                                <div class="form-group">
                                    <label for="desk">Untuk Pembayaran</label>
                                    <input type="text" name="desk" id="desk" class="form-control" 
                                        placeholder="Deskripsi keterangan" value="{{  $bkk->desk }}" />
                                </div>
                            </div>
                            <div class="col-md-4 col-12 ">
                                <div class="form-group">
                                    <label for="rekening_id">Rek.Kas/Bank[K]</label>
                                    <select name="rekening_id" id="rekening_id" class="form-control"></select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body mt-0">
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr class="rowHead">
                                        <td>No. Rekening</td>
                                        <td>Jumlah Uang</td>
                                        <td>Catatan</td>
                                        <td style="width: 1px"></td>
                                    </tr>
                                </thead>
                                <tbody id="dynamic_field"></tbody>
                            </table>
                        </div>
                        <div class="row ">
                            <div class="col-12">
                                <button type="button" id="add" class="btn btn-success my-2"
                                    style="width: 100%; height: 50px">
                                    <i data-feather="plus"></i>
                                    Tambah Row
                                </button>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 ml-auto">
                                <div class="form-group row">
                                    <label for="total" class="col-sm-3 col-form-label font-weight-bold">Total</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control text-right" id="total" placeholder="0" readonly />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <button type="submit" class="btn btn-primary" id="save">
                            Update
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="modalTemplateJurnal" tabindex="-1" role="dialog" aria-labelledby="modalTemplateJurnalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTemplateJurnalTitle">Pilih Template</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-borderless" id="template-datatables">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Template</th>
                                    <th>Kontak</th>
                                    <th>Frekuensi</th>
                                    <th>Per Tanggal</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('select2')
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/forms/select/select2.min.css') }}">
@endpush
@push('head')
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/tables/datatable/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/tables/datatable/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css') }}">
    <style>
        .select2 {
            width: 100%!important;
        }
        .select2-selection__clear {
            margin-right: 10px;
        }
        .rowComponent td{
            padding: 0px 8px 16px 0 !important
        }
        .rowHead td{
            padding: 0px 8px 16px 0 !important
        }
        .rowComponent td .form-control{
            border-radius:0px !important;
        }
        #dynamic_field td {
            transition: all 1s ease-in-out;
        }

        @media screen and (max-width: 768px) {
            .rowComponent td .jumlah {
                width: 120px;
            }
            .rowComponent td .catatan {
                width: 250px;
            }
        }
    </style>
@endpush

@push('script')
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/responsive.bootstrap4.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
    <script src="{{ asset('js/helpers.js') }}"></script>
    <script>
        const CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content')
        const totalInput = document.getElementById('total');

        function generateUUID() {
            var d = new Date().getTime();
            var d2 = (performance && performance.now && (performance.now()*1000)) || 0;
            return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
                var r = Math.random() * 16;
                if (d > 0) {
                    r = (d + r)%16 | 0;
                    d = Math.floor(d/16);
                } else {
                    r = (d2 + r)%16 | 0;
                    d2 = Math.floor(d2/16);
                }
                return (c === 'x' ? r : (r & 0x3 | 0x8)).toString(16);
            });
        }

        function hitungTotal () {
            let total = 0;
            document.querySelectorAll('.jumlah').forEach((el) => {
                total += el.value == '' ? 0 : unformatter(el.value);
            })

            totalInput.value = formatter(total);
        }

        function eventJumlah () {
            document.querySelectorAll('.jumlah').forEach(el => {
                el.addEventListener('keyup', function() {
                    const val = this.value == '' ? 0 : unformatter(this.value);
                    const n = parseInt(val, 10);
                    el.value = formatter(n);
                });
                el.addEventListener('focusout', function() {
                    hitungTotal();
                });
            });
        }

        function select2Rekening(index) {
            $('select[name="bkk['+index+'][rekening]"]').select2({
                placeholder: '-- No. Rekening --',
                ajax: {
                    url: '{{ route('api.select2.get-akun') }}',
                    type: 'post',
                    dataType: 'json',
                    data: params => {
                        return {
                            _token: CSRF_TOKEN,
                            search: params.term || '',
                            page: params.page || 1,
                            kas_bank: 'no',
                        }
                    },
                    cache: true
                },
                allowClear: true
            });
        }

        function getNumberOfTr() {
            $('#dynamic_field tr').each(function(index, tr) {
                $(this).find("td.no input").val(index + 1)
                $(this).find("input.id").attr('name', `bkk[${index}][id]`);
                select2Rekening(index);
                $(this).find("td select.rekening").attr('name', `bkk[${index}][rekening]`);
                $(this).find("td input.jumlah").attr('name', `bkk[${index}][jumlah]`);
                $(this).find("td input.catatan").attr('name', `bkk[${index}][catatan]`);
            })
        }

        function checkRowLength() {
            let length = $("#dynamic_field tr").length;
            if (length > 0) {
                $("#save").attr('disabled', false)
            } else {
                $("#save").attr('disabled', true)
            }
        }

        function field_dinamis(id = undefined, jml_uang = undefined, catatan = undefined) {
            if (id == undefined) {
                id = "";
            } else {
                id = parseInt(id);
            }

            if (jml_uang == undefined) {
                jml_uang = "";
            } else {
                jml_uang = jml_uang;
            }

            if (catatan == undefined) {
                catatan = "";
            } else {
                catatan = catatan;
            }

            let index = $('#dynamic_field tr').length
            let uuid = generateUUID()
            let html = `
                <tr class="rowComponent">
                    <input type="hidden" width="10px" name="bkk[${index}][id]" class="id" value="${id}">
                    <td class="no" hidden>
                        <input type="text" value="${index + 1}" class="form-control" disabled>
                    </td>
                    <td>
                        <select name="bkk[${index}][rekening]" class="form-control select-${index} rekening"></select>
                    </td>
                    <td>
                        <input type="text" name="bkk[${index}][jumlah]" class="form-control jumlah" value="${jml_uang}" 
                            onkeypress="onlyNumber(event)" placeholder="0" autocomplete="off" >
                    </td>
                    <td>
                        <input type="text" name="bkk[${index}][catatan]" class="form-control catatan" value="${catatan}">
                    </td>
            `
            if (index > 0) {
                html += `<td>
                        <button type="button" name="remove" 
                            class="btn btn-danger btn-sm text-white btn_remove">
                            <i data-feather="trash-2"></i>
                        </button>
                    </td>
                </tr>`
                $("#dynamic_field").append(html)
            } else {
                html += `<td></td></tr>`;
                $("#dynamic_field").append(html)
            }
            
            feather.replace()
            select2Rekening(index)
            eventJumlah()
            hitungTotal()
        }

        $("#save").attr('disabled', true)
        $("#add").attr('disabled', true).html(`
            <div class="d-flex justify-content-center">
                <div class="spinner-border" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
        `);
        $.ajax({
            type: 'get',
            url: '{{ route('api.bkk.details', ':id') }}'.replace(':id', '{{ $bkk->id }}'),
            dataType: 'json',
            success: results => {
                Object.keys(results.data).forEach(i => {
                    const data = results.data[i];
                    const rekening = results.data[i].rekening;
                    const option = new Option(rekening.name, rekening.id, true, true);

                    field_dinamis(data.id, data.jml_uang, data.catatan);

                    $(".btn_remove").attr('disabled', true);

                    if ((parseInt(i) + 1) == results.length) {
                        $("#save").attr('disabled', false)
                        $("#add").attr('disabled', false).html(`
                            <i data-feather="plus"></i>
                            Tambah Row
                        `);
                        feather.replace()
                        $(".btn_remove").attr('disabled', false);
                    }

                    $('select[name="bkk['+ i +'][rekening]"]').append(option).trigger('change')
                    $('select[name="bkk['+ i +'][rekening]"]').trigger({
                        type: 'select2:select',
                        params: {
                            data: rekening
                        }
                    })

                    $('[name="bkk[' + i + '][jumlah]"]').val(formatter(data.jml_uang));
                    
                });
            }
        })
    </script>
    <script>
        $(document).ready(function() {
            $('#add').click(function(){
                field_dinamis()
                hitungTotal()
            })

            $(document).on('click', '.btn_remove', function() {
                let parent = $(this).parent()
                let id = parent.data('id')
                let delete_data = $("input[name='delete_data']").val()
                if(id !== 'undefined' && id !== undefined) {
                    $("input[name='delete_data']").val(delete_data + ';' + id)
                }
                $('.btn_remove').eq($('.btn_remove').index(this)).parent().parent().remove()
                getNumberOfTr()
                hitungTotal()
                checkRowLength()
            })

            $("#kontak_id").select2({
                placeholder: "Pilih Kontak",
                ajax: {
                    url: '{{ route('api.select2.get-kontak') }}',
                    type: 'post',
                    dataType: 'json',
                    data: params => {
                        return {
                            _token: CSRF_TOKEN,
                            search: params.term
                        }
                    },
                    processResults: data => {
                        return {
                            results: data
                        }
                    },
                    cache: true
                },
                allowClear: true
            })

            $.ajax({
                type: 'get',
                url: '{{ route('api.select2.get-kontak.selected', ':id') }}'.replace(':id', '{{ $bkk->kontak_id }}'),
            }).then((data) => {
                let option = new Option(data.text, data.id, true, true)
                $("#kontak_id").append(option).trigger('change')
                $("#kontak_id").trigger({
                    type: 'select2:select',
                    params: {
                        data: data
                    }
                })
            })

            $("#rekening_id").select2({
                placeholder: 'Rekening Kas/Bank',
                ajax: {
                    url: '{{ route('api.select2.get-akun') }}',
                    type: 'post',
                    dataType: 'json',
                    data: params => {
                        return {
                            _token: CSRF_TOKEN,
                            search: params.term || '',
                            page: params.page || 1,
                            kas_bank: 'yes',
                        }
                    },
                    cache: true
                },
                allowClear: true
            });
            
            $.ajax({
                type: 'get',
                url: '{{ route('api.select2.get-akun.selected', ':id') }}'.replace(':id', '{{ $bkk->rekening_id }}'),
            }).then((data) => {
                let option = new Option(data.text, data.id, true, true)
                $("#rekening_id").append(option).trigger('change')
                $("#rekening_id").trigger({
                    type: 'select2:select',
                    params: {
                        data: data
                    }
                })
            })

            $("#modalTemplateJurnal").on("show.bs.modal", function () {
                $("#template-datatables").DataTable({
                    // responsive: true,
                    destroy: true,
                    serverSide: true,
                    processing: true,
                    ordering: false,
                    ajax: {
                        url: '{{ route('api.template-jurnal.datatables') }}',
                        type: "post",
                        dataType: 'json',
                        data: {
                            _token: CSRF_TOKEN,
                            type: 'kk'
                        }
                    },
                    searching: true,
                    columns: [
                        {
                            data: null,
                            sortable: false,
                            searchable: false,
                            render: function (data, type, row, meta) {
                                return meta.row + meta.settings._iDisplayStart + 1;
                            },
                        },
                        { data: "nama_template" },
                        { data: "kontak_id" },
                        { data: "frekuensi" },
                        { data: "per_tanggal" },
                        {
                            data: "#",
                            orderable: false,
                            searchable: false,
                        },
                    ],
                    
                });

                $('.dataTable').wrap('<div class="dataTables_scroll" />');
            });
        })
    </script>
@endpush
