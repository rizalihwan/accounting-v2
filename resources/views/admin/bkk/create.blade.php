@extends('_layouts.main')
@section('title', 'Buku Kas Keluar')
    @push('breadcrumb')
        <li class="breadcrumb-item">
            <a href="{{ route('admin.cash-bank') }}">Kas & Bank</a>
        </li>
        <li class="breadcrumb-item active">
            <a href="{{ route('admin.bkk.index') }}">Buku Kas Keluar</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">Tambah Buku kas Keluar</li>
    @endpush
@section('content')
    <div class="row">
        <!-- end message area-->
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
            <form action="{{ route('admin.bkk.store') }}" method="POST" class="form-repeater">
                @csrf
                <div class="card mb-2 ">
                    <div class="card-header">
                        <h4>Tambah Buku Kas Keluar</h4>
                        <button type="button" class="btn btn-light"
                            data-toggle="modal" data-target="#modalTemplateJurnal">
                            Gunakan Template
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="row d-flex align-items-end">
                            <div class="col-md-4 col-12 ">
                                <div class="form-group">
                                    <label for="tanggal">Tanggal</label>
                                    <input type="date" class="form-control" name="tanggal" value="{{ old('tanggal') }}" required />
                                </div>
                            </div>
                            <div class="col-md-3 col-12 ml-auto mr-4">
                                <div class="form-group">
                                    <label for="id">No Jurnal</label>
                                    <input type="text" class="form-control" value="{{ $kode }}" disabled />
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
                                    <input type="text" name="desk" id="desk" class="form-control" value="{{ old('desk') }}"
                                        placeholder="Deskripsi keterangan" />
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
                    <div class="card-body">
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
                            Simpan
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
        // ===== for function ======
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

        /**
        * @param {number} template_id The number
        */
        function chooseTemplate(template_id) {
            history.pushState({}, null, `?template_id=${template_id}`);
            getTemplate(template_id)
        }

        function getTemplate(template_id) {
            $.ajax({
                url: '{{ route('api.template-jurnal.selected', ':id') }}'.replace(':id', template_id),
                type: 'get',
                dataType: 'json',
                success: result => {
                    const data = result.data;
                    $('#dynamic_field').empty()

                    $('#save').attr('disabled', true);
                    Object.keys(data.template_details).forEach(index => {
                        const detail = data.template_details[index];

                        field_dinamis();
                        eventJumlah();
                        hitungTotal();

                        $('select[name="bkk['+ index +'][rekening]"]').attr('disabled', true);

                        $.ajax({
                            type: 'get',
                            url: '{{ route('api.select2.get-akun.selected', ':id') }}'.replace(':id', detail.akun_id),
                            dataType: 'json',
                            success: (akun) => {
                                let option = new Option(akun.text, akun.id, true, true)
                                $('select[name="bkk['+ index +'][rekening]"]').attr('disabled', false);
                                $('select[name="bkk['+ index +'][rekening]"]').append(option).trigger('change')
                                $('select[name="bkk['+ index +'][rekening]"]').trigger({
                                    type: 'select2:select',
                                    params: {
                                        data: akun
                                    }
                                })

                                if ((parseInt(index) + 1) == data.template_details.length) {
                                    $('#save').attr('disabled', false);
                                }
                            }
                        })
                    })

                    $("#desk").val(data.uraian)

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
                        url: '{{ route('api.select2.get-akun.selected', ':id') }}'.replace(':id', data.template_details[0].akun_id),
                        dataType: 'json',
                        success: (akun) => {
                            let option = new Option(akun.text, akun.id, true, true)
                            $('#rekening_id').append(option).trigger('change')
                            $('#rekening_id').trigger({
                                type: 'select2:select',
                                params: {
                                    data: akun
                                }
                            })
                        }
                    })

                    eventJumlah();
                    hitungTotal();
                }
            })
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

        function field_dinamis() {
            let index = $('#dynamic_field tr').length
            let uuid = generateUUID()
            let html = `
                <tr class="rowComponent">
                    <input type="hidden" width="10px" name="bkk[${index}][id]" class="id" value="${uuid}">
                    <td class="no" hidden>
                        <input type="text" value="${index + 1}" class="form-control" disabled>
                    </td>
                    <td>
                        <select name="bkk[${index}][rekening]" class="form-control select-${index} rekening"></select>
                    </td>
                    <td>
                        <input type="text" name="bkk[${index}][jumlah]" class="form-control jumlah"
                            onkeypress="onlyNumber(event)" placeholder="0" autocomplete="off" >
                    </td>
                    <td>
                        <input type="text" name="bkk[${index}][catatan]" class="form-control catatan">
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
    </script>
    <script>
        let url_template_id = parseURLParams(window.location.href);

        if (url_template_id !== undefined) {
            let template_id = parseInt(url_template_id.template_id[0])
            getTemplate(template_id)
        }

        field_dinamis()

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
            })
        })

    </script>
    <script>
        @if(!empty(old('kontak_id')))
            $.ajax({
                type: 'get',
                url: '{{ route('api.select2.get-kontak.selected', ':id') }}'.replace(':id', '{{ old('kontak_id') }}'),
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
        @endif

        @if (!empty(old('rekening_id')))
            $.ajax({
                type: 'get',
                url: '{{ route('api.select2.get-akun.selected', ':id') }}'.replace(':id', '{{ old('rekening_id') }}'),
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
        @endif

        @if (isset(session()->getOldInput()['bkk']))
            const bkk = @json(session()->getOldInput()['bkk']);
            $("#dynamic_field").empty()
            bkk.forEach((item, index) => {
                field_dinamis()

                if (item.rekening !== undefined) {
                    $('select[name="bkk['+ index +'][rekening]"]').attr('disabled', true);
                    $.ajax({
                        type: 'get',
                        url: '{{ route('api.select2.get-akun.selected', ':id') }}'.replace(':id', item.rekening),
                    }).then((data) => {
                        let option = new Option(data.text, data.id, true, true)
                        $('select[name="bkk['+ index +'][rekening]"]').append(option).trigger('change')
                        $('select[name="bkk['+ index +'][rekening]"]').trigger({
                            type: 'select2:select',
                            params: {
                                data: data
                            }
                        })
                        $('select[name="bkk['+ index +'][rekening]"]').attr('disabled', false);
                    })
                }

                $('[name="bkk['+ index +'][jumlah]"]').val(item.jumlah)
                $('[name="bkk['+ index +'][catatan]"]').val(item.catatan)
                eventJumlah()
                hitungTotal()
            })
        @endif
    </script>
    <script>
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
    </script>
@endpush
