@extends('_layouts.main')
@section('title', 'Jurnal Umum')
    @push('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('admin.jurnalumum.index') }}">Jurnal Umum</a>
    </li>
    <li class="breadcrumb-item" aria-current="page">Edit Jurnal Umum</li>
    @endpush
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header justify-content-between d-flex">
                    <div>
                        <h3>Tambah Jurnal Umum</h3>
                    </div>
                    <div>
                        No. Jurnal : <strong>{{ $jurnal->kode_jurnal }}</strong>
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
                    <form class="forms-sample" action="{{ route('admin.jurnalumum.update', $jurnal->id) }}" method="POST">
                        @csrf
                        @method('put')
                        <input type="hidden" name="kode_jurnal" value="{{ $jurnal->kode_jurnal }}">
                        <input type="hidden" name="status" value="1">
                        <div class="row">
                            <div class="col-sm-5">
                                <div class="form-group">
                                    <label for="tanggal">{{ __('Tanggal') }}<span class="text-red">*</span></label>
                                    <input id="tanggal" type="date" value="{{ old('tanggal') ?? $jurnal->tanggal }}"
                                        class="form-control" name="tanggal">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="kontak_id">{{ __('Kontak') }}<span class="text-red">*</span></label>
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
                                    <label for="divisi_id">{{ __('Divisi') }}<span class="text-red">*</span></label>
                                    <select name="divisi_id" id="divisi_id"
                                        class="form-control select2">
                                    </select>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <label for="uraian">{{ __('Uraian') }}<span class="text-red">*</span></label>
                                    <input type="text" name="uraian" id="uraian" class="form-control"
                                        value="{{ old('uraian') ?? $jurnal->uraian }}" placeholder="Uraian...">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="table-responsive">
                                    <table class="table table-borderless mt-2" id="table-dynamic_field">
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
                                    UPDATE</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('select2')
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/forms/select/select2.min.css') }}">
@endpush
@push('head')
    <style>
        .select2 {
            width: 100%!important;
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
    <script src="{{ asset('plugins/jquery.repeater/jquery.repeater.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
    <script src="{{ asset('app-assets/js/scripts/forms/form-select2.min.js') }}"></script>
    <script src="{{ asset('js/helpers.js') }}"></script>
    <script>
        let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content')

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

        $(document).ready(function() {
            $("#kontak_id").select2({
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
                placeholder: "Pilih Kontak",
                allowClear: true
            })
            let kontakSelect = $("#kontak_id")
            let kontak_url = '{{ route('api.select2.get-kontak.selected', ':id') }}'
            let url_kontak = kontak_url.replace(':id', '{{ $jurnal->kontak_id }}')
            $.ajax({
                type: 'get',
                url: url_kontak,
                error: err => {
                    console.log(err)
                }
            }).then((data) => {
                let option = new Option(data.text, data.id, true, true)
                kontakSelect.append(option).trigger('change')
                kontakSelect.trigger({
                    type: 'select2:select',
                    params: {
                        data: data
                    }
                })
            })

            $("#divisi_id").select2({
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
                placeholder: "Pilih Divisi",
                allowClear: true
            })
            let divisiSelect = $("#divisi_id")
            let divisi_url = '{{ route('api.select2.get-divisi.selected', ':id') }}'
            let url_divisi = divisi_url.replace(':id', '{{ $jurnal->divisi_id }}')
            $.ajax({
                type: 'get',
                url: url_divisi,
                error: err => {
                    console.log(err)
                }
            }).then((data) => {
                let option = new Option(data.text, data.id, true, true)
                divisiSelect.append(option).trigger('change')
                divisiSelect.trigger({
                    type: 'select2:select',
                    params: {
                        data: data
                    }
                })
            })
        })

        function field_dinamis() {
            Object.keys(arguments).forEach(el => {
                arguments[el] = parseInt(arguments[el])
            })

            let id = arguments[0]
            let akun_id = arguments[1]
            let debit = arguments[2]
            let kredit = arguments[3]

            if (id == undefined) {
                id = ''
            }
            if (debit == undefined) {
                debit = ''
            } else {
                debit = formatter(debit);
            }

            if (kredit == undefined) {
                kredit = ''
            } else {
                kredit = formatter(kredit);
            }
            let index = $('#dynamic_field tr').length
            let uuid = generateUUID()
            let akun_url = '{{ route('api.select2.get-akun.selected', ':id') }}'
            let url = akun_url.replace(':id', akun_id)

            let html = `
                <tr class="rowComponent">
                    <input type="hidden" width="10px" name="jurnals[${index}][id]" value="${id}">
                    <td class="no" hidden>
                        <input type="text" value="${index + 1}" class="form-control" disabled>
                    </td>
                    <td>
                        <select name="jurnals[${index}][akun_id]" class="form-control select-${index}"></select>
                    </td>
                    <td>
                        <input type="text" name="jurnals[${index}][debit]" class="form-control debit" placeholder="0" onkeypress="return onlyNumber(event)"
                            value="${debit}">
                    </td>
                    <td>
                        <input type="text" name="jurnals[${index}][kredit]" class="form-control kredit" placeholder="0" onkeypress="return onlyNumber(event)"
                            value="${kredit}">
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
            feather.replace()
            eventJumlah()
            jumlahin()
            countTr()

            $('select[name="jurnals['+index+'][akun_id]"]').select2({
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
                placeholder: "Pilih Akun",
                allowClear: true
            })

            let akunSelect = $('select[name="jurnals['+index+'][akun_id]"]')
            $.ajax({
                type: 'get',
                url: url
            }).then((data) => {
                let option = new Option(data.name, data.id, true, true)
                akunSelect.append(option).trigger('change')
                akunSelect.trigger({
                    type: 'select2:select',
                    params: {
                        data: data
                    }
                })
            })
        }
        @foreach ($jurnal->jurnalumumdetails as $item)
            field_dinamis('{{ $item->id }}', '{{ $item->akun_id }}', '{{ $item->debit }}', '{{ $item->kredit }}')
        @endforeach
        $(document).ready(function(){
            getNumberOfTr()
            jumlahin()
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
                countTr()
                jumlahin()
            })
        })
        function getNumberOfTr() {
            $('#dynamic_field tr').each(function(index, tr) {
                $(this).find("td.no input").val(index + 1)
            })
        }
        function countTr() {
            let table = document.getElementById('table-dynamic_field')
            let tbodyCount = table.tBodies[0].rows.length
            
            if (tbodyCount == 0) {
                $("#btn-submit").attr('disabled', true);
            } else {
                $("#btn-submit").attr('disabled', false);
            }
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
                total_kredit += e_kredit.value == "" ? 0 : unformatter(e_kredit.value)
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

            if (difference != 0) {
                $("#btn-submit").attr('disabled', true)
            } else {
                $("#btn-submit").attr('disabled', false)
            }
        }
    </script>
@endpush
