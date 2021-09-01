@extends('_layouts.main')
@section('title', 'Jurnal Umum')
    @push('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('admin.jurnalumum.index') }}">Jurnal Umum</a>
    </li>
    <li class="breadcrumb-item" aria-current="page">Tambah</li>
    @endpush
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header justify-content-between d-flex">
                    <div>
                        <h3>Tambah Jurnal</h3>
                    </div>
                    <div>
                        No. Jurnal : <strong>{{ $kode }}</strong>
                    </div>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger alert-validation-msg" role="alert">
                            <div class="alert-body">
                                @foreach ($errors->all() as $error)
                                <ul style="margin: 5px 12px 0 -11px">
                                    <li>{{ $error }}</li>
                                </ul>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    <form class="forms-sample" action="{{ route('admin.jurnalumum.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="kode_jurnal" value="{{ $kode }}">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <button type="button" class="btn btn-light"
                                        data-toggle="modal" data-target="#modalTemplateJurnal">
                                        Gunakan Template
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-5">
                                <div class="form-group">
                                    <label for="tanggal">{{ __('Tanggal') }}<span class="text-danger">*</span></label>
                                    <input id="tanggal" type="date" value="{{ date('Y-m-d') }}"
                                        class="form-control" name="tanggal">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="kontak_id">{{ __('Kontak') }}<span class="text-danger">*</span></label>
                                    <select name="kontak_id" id="kontak_id"
                                        class="form-control select2">
                                    </select>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-sm-3" style="margin-top: 8px">
                                <div class="form-group"></div>
                                <div class="form-group">
                                    <a href="{{ route('admin.kontak.create') }}" class="btn btn-danger">
                                        <i data-feather="plus"></i>
                                        TAMBAH KONTAK
                                    </a>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="divisi_id">{{ __('Divisi') }}<span class="text-danger">*</span></label>
                                    <select name="divisi_id" id="divisi_id"
                                        class="form-control select2">
                                    </select>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <label for="uraian">{{ __('Uraian') }}<span class="text-danger">*</span></label>
                                    <input type="text" name="uraian" id="uraian" class="form-control"
                                        placeholder="uraian...">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="table-responsive">
                                    <table class="table table-borderless mt-2">
                                        <thead>
                                            <tr class="rowHead">
                                                <td>Akun</td>
                                                <td>Debit</td>
                                                <td>Kredit</td>
                                                <td style="width: 1px"></td>
                                            </tr>
                                        </thead>
                                        <tbody id="dynamic_field"></tbody>
                                    </table>
                                    <button type="button" id="add"
                                        class="btn btn-success my-2"
                                        style="width: 100%; height: 50px">
                                        <i data-feather="plus"></i>
                                        Tambah Row Baru
                                    </button>
                                    <table class="table table-borderless col-sm-6 ml-auto border-top">
                                        <tbody>
                                            <tr>
                                                <th style="width: 180px">Total</th>
                                                <td id="total_debit">Rp 0</td>
                                                <td id="total_kredit">Rp 0</td>
                                            </tr>
                                            <tr>
                                                <th>Difference</th>
                                                <td></td>
                                                <td id="difference" tit>0</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="col-md-12 mt-4">
                            <div class="form-group">
                                <a href="{{ route('admin.jurnalumum.index') }}" class="btn btn-danger">KEMBALI</a>
                                <button type="submit" class="btn btn-primary" id="btn-submit">
                                    TAMBAH
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
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
                                    <th>Sumber</th>
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
        .dataTables_scroll {
            overflow: auto;
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
    </style>
@endpush

@push('script')
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/responsive.bootstrap4.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery.repeater/jquery.repeater.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
    <script src="{{ asset('app-assets/js/scripts/forms/form-select2.min.js') }}"></script>
    <script src="{{ asset('js/helpers.js') }}"></script>
    <script>
        const CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        function eventJumlah () {
            const debit = document.querySelectorAll('.debit');
            const kredit = document.querySelectorAll('.kredit');
            debit.forEach(el => {
                el.addEventListener('keyup', function() {
                    const val = this.value == '' ? 0 : unformatter(this.value);
                    const n = parseInt(val, 10);
                    el.value = formatter(n);
                });
                el.addEventListener('focusout', function() {
                    jumlahin();
                });
            });

            kredit.forEach(el => {
                el.addEventListener('keyup', function() {
                    const val = this.value == '' ? 0 : unformatter(this.value);
                    const n = parseInt(val, 10);
                    el.value = formatter(n);
                });
                el.addEventListener('focusout', function() {
                    jumlahin();
                });
            });
        }

        function chooseTemplate(template_id) {
            history.pushState({}, null, `?template_id=${template_id}`);
            getTemplate(template_id)
        }

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
                        type: 'ju'
                    },
                    error: (response) => {
                        console.log(response);
                    },
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
                    { data: "sumber" },
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


        @if (request()->template_id)
            getTemplate('{{ request()->template_id }}')
        @endif

        $(document).ready(function() {
            $("#kontak_id").select2({
                placeholder: "-- Pilih Kontak --",
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
            
            $("#divisi_id").select2({
                placeholder: "-- Pilih Divisi --",
                ajax: {
                    url: '{{ route('api.select2.get-divisi') }}',
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
        });
        // async function jurnalEachColumn(index) {
        //     let fetchData = await fetch(`{{ route('api.select2.get-akun') }}`)
        //     let response = JSON.parse(await fetchData.text())
        //     let $select2 = $('select[name="jurnals['+index+'][akun_id]"]').select2({
        //         placeholder: "Pilih Akun"
        //     }).empty()
        //     $select2.append($("<option></option>").attr("value", '').text('Choose Type'))
        //     $.each(response, function(key, data){
        //         $select2.append($("<option></option>").attr("value", data.id).text(data.name))
        //     })
        // }
        function field_dinamis() {
            let index = $('#dynamic_field tr').length
            let uuid = generateUUID()
            let html = `
                <tr class="rowComponent">
                    <input type="hidden" width="10px" name="jurnals[${index}][id]" value="${uuid}">
                    <td class="no" hidden>
                        <input type="text" value="${index + 1}" class="form-control" disabled>
                    </td>
                    <td>
                        <select name="jurnals[${index}][akun_id]" class="form-control select-${index}"></select>
                    </td>
                    <td>
                        <input type="text" name="jurnals[${index}][debit]" class="form-control debit" placeholder="0" onkeypress="onlyNumber(event)">
                    </td>
                    <td>
                        <input type="text" name="jurnals[${index}][kredit]" class="form-control kredit" placeholder="0" onkeypress="onlyNumber(event)">
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
            } else {
                html += `<td></td></tr>`;
            }

            $("#dynamic_field").append(html)

            eventJumlah()
            feather.replace()

            $('select[name="jurnals['+index+'][akun_id]"]').select2({
                placeholder: '-- Pilih Akun --',
                ajax: {
                    url: '{{ route('api.select2.get-akun') }}',
                    type: 'post',
                    dataType: 'json',
                    data: params => {
                        return {
                            _token: CSRF_TOKEN,
                            search: params.term || '',
                            page: params.page || 1
                        }
                    },
                    cache: true
                },
                allowClear: true
            })
        }
        field_dinamis()
        $(document).ready(function(){
            getNumberOfTr()
            $('#add').click(function(){
                field_dinamis()
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
                jumlahin()
            })
        })
        function getNumberOfTr() {
            $('#dynamic_field tr').each(function(index, tr) {
                $(this).find("td.no input").val(index + 1)
            })
        }
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

        function jumlahin() {
            let total_debit = 0
            let total_kredit = 0
            let difference = 0
            let cols_debit = document.querySelectorAll('.debit')
            let cols_kredit = document.querySelectorAll('.kredit')
            for (let i = 0; i < cols_debit.length; i++) {
                let e_debit = cols_debit[i]
                let e_kredit = cols_kredit[i]
                total_debit += e_debit.value == "" ? 0 : unformatter(e_debit.value)
                total_kredit += e_kredit.value == "" ? 0 :unformatter(e_kredit.value)
            }
            if (total_debit > total_kredit) {
                difference = total_kredit - total_debit
            } else if (total_debit < total_kredit) {
                difference = total_debit - total_kredit
            } else {
                difference = 0
            }
            $("#total_debit").text("Rp " + formatter(total_debit))
            $("#total_kredit").text("Rp " + formatter(total_kredit))
            $("#difference").text(formatter(difference))
            if (difference === 0) {
                $("#btn-submit").attr('disabled', false)
            } else {
                $("#btn-submit").attr('disabled', true)
            }
        }

        function getTemplate(template_id) {
            $('#add').html(`
                <div class="d-flex justify-content-center">
                    <div class="spinner-border" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
            `).attr('disabled', true);
            $('#btn-submit').attr('disabled', true);

            $.ajax({
                url: '{{ route('api.template-jurnal.selected', ':id') }}'.replace(':id', template_id),
                type: 'get',
                dataType: 'json',
                success: result => {
                    const data = result.data;

                    $("#dynamic_field").empty()
                    $("#uraian").val(data.uraian)

                    Object.keys(data.template_details).forEach(index => {
                        const detail = data.template_details[index];

                        field_dinamis();
                        $('select[name="jurnals['+ index +'][akun_id]"]').attr('disabled', true);
                        $('[name="jurnals['+ index +'][debit]"]').val(formatter(detail.debit))
                        $('[name="jurnals['+ index +'][kredit]"]').val(formatter(detail.kredit))

                        $.ajax({
                            type: 'get',
                            url: '{{ route('api.select2.get-akun.selected', ':id') }}'.replace(':id', detail.akun_id),
                            dataType: 'json',
                            success: (akun) => {
                                let option = new Option(akun.text, akun.id, true, true)
                                $('select[name="jurnals['+ index +'][akun_id]"]').attr('disabled', false);
                                $('select[name="jurnals['+ index +'][akun_id]"]').append(option).trigger('change')
                                $('select[name="jurnals['+ index +'][akun_id]"]').trigger({
                                    type: 'select2:select',
                                    params: {
                                        data: akun
                                    }
                                })
                                if ((parseInt(index) + 1) == data.template_details.length) {
                                    $('#add').html(`
                                        <i data-feather="plus"></i>
                                        Tambah Row Baru
                                    `).attr('disabled', false);
                                    $('#btn-submit').attr('disabled', false);
                                    jumlahin();
                                    feather.replace();
                                }
                            }
                        })

                    })

                    $.ajax({
                        type: 'get',
                        url: '{{ route('api.select2.get-kontak.selected', ':id') }}'.replace(':id', data.kontak_id),
                        success: (data) => {
                            let option = new Option(data.text, data.id, true, true)
                            $("#kontak_id").append(option).trigger('change')
                            $("#kontak_id").trigger({
                                type: 'select2:select',
                                params: {
                                    data: data
                                }
                            })
                        }
                    })

                    $.ajax({
                        type: 'get',
                        url: '{{ route('api.select2.get-divisi.selected', ':id') }}'.replace(':id', data.divisi_id),
                        success: data => {
                            let option = new Option(data.text, data.id, true, true)
                            $("#divisi_id").append(option).trigger('change')
                            $("#divisi_id").trigger({
                                type: 'select2:select',
                                params: {
                                    data: data
                                }
                            })
                        }
                    })
                }
            })
        }
    </script>
@endpush
