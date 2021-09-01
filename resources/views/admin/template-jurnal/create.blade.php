@extends('_layouts.main')
@section('title', 'Template Jurnal')

@push('breadcrumb')
<li class="breadcrumb-item">
    <a href="{{ route('admin.template-jurnal.index') }}">Template Jurnal</a>
</li>
<li class="breadcrumb-item active" aria-current="page">Tambah</li>
@endpush

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header justify-content-between d-flex">
                    <div>
                        <h3>Tambah Template</h3>
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
                    <form class="forms-sample" action="{{ route('admin.template-jurnal.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-lg-4 col-md-6 col-sm-6 ">
                                <div class="form-group">
                                    <label for="nama_template">{{ __('Nama Template') }}<span class="text-danger">*</span></label>
                                    <input type="text" name="nama_template" id="nama_templat" value="{{ old('nama_template') }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-8 col-md-6 col-sm-6 ">
                                <div class="form-group">
                                    <label for="keterangan">{{ __('Keterangan') }} <span class="text-danger">*</span> </label>
                                    <input type="text" name="keterangan" id="keterangan" value="{{ old('keterangan') }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group">
                                    <label for="kontak_id">{{ __('Kontak') }} <span class="text-danger">*</span> </label>
                                    <select name="kontak_id" id="kontak_id" class="form-control"></select>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="form-group">
                                    <label for="sumber">{{ __('Sumber') }} <span class="text-danger">*</span> </label>
                                    <select name="sumber" id="sumber" class="form-control"></select>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="form-group">
                                    <label for="frekuensi">{{ __('Frekuensi') }} <span class="text-danger">*</span> </label>
                                    <select name="frekuensi" id="frekuensi" class="form-control"></select>
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-6">
                                <div class="form-group">
                                    <label for="per_tanggal">{{ __('Per Tanggal') }} <span class="text-danger">*</span> </label>
                                    <select name="per_tanggal" id="per_tanggal" class="form-control">
                                        @for($i = 1; $i < 31; $i++)
                                            <option value="{{ $i }}" {{ $i == old('per_tanggal') ? 'selected' : '' }}>{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4">
                                <div class="form-group">
                                    <label for="divisi_id">{{ __('Divisi') }} <span class="text-danger">*</span> </label>
                                    <select name="divisi_id" id="divisi_id" class="form-control"></select>
                                </div>
                            </div>
                            <div class="col-lg-9 col-md-8">
                                <div class="form-group">
                                    <label for="uraian">{{ __('Uraian') }} <span class="text-danger">*</span> </label>
                                    <input type="text" name="uraian" id="uraian" value="{{ old('uraian') }}" class="form-control">
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
                                </div>
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
                                            <td id="total_debit">0</td>
                                            <td id="total_kredit">0</td>
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

                        <hr>

                        <div class="col-md-12 mt-4">
                            <div class="form-group">
                                <a href="{{ route('admin.template-jurnal.index') }}" class="btn btn-danger">KEMBALI</a>
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
        const CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content')

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
            let sumber = $("#sumber").val()
            let total_debit = 0
            let total_kredit = 0
            let difference = 0
            let cols_debit = document.querySelectorAll('.debit')
            let cols_kredit = document.querySelectorAll('.kredit')
            for (let i = 0; i < cols_debit.length; i++) {
                let e_debit = cols_debit[i]
                let e_kredit = cols_kredit[i]
                total_debit += e_debit.value == "" ? 0 : parseInt(e_debit.value.replace(/\D/g, ""))
                total_kredit += e_kredit.value == "" ? 0 : parseInt(e_kredit.value.replace(/\D/g, ""))
            }
            if (total_debit > total_kredit) {
                difference = total_kredit - total_debit
            } else if (total_debit < total_kredit) {
                difference = total_debit - total_kredit
            } else {
                difference = 0
            }
            $("#total_debit").text(formatter(total_debit))
            $("#total_kredit").text(formatter(total_kredit))
            $("#difference").text(formatter(difference))
            if (sumber == "JU") {
                if (difference === 0) {
                    $("#btn-submit").attr('disabled', false)
                } else {
                    $("#btn-submit").attr('disabled', true)
                }
            } else {
                $("#btn-submit").attr('disabled', false)
            }
        }

        function select2Akun(index) {
            let sumber = $("#sumber").val();
            if (index === 0) {
                if (sumber == "KM" || sumber == "KK") {
                    $('select[name="jurnals[0][akun_id]"]').select2({
                        placeholder: '-- Pilih Akun --',
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
                    })
                } else {
                    $('select[name="jurnals[0][akun_id]"]').select2({
                        placeholder: '-- Pilih Akun --',
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
                    })
                }
            } else {
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
                                page: params.page || 1,
                                kas_bank: 'no',
                            }
                        },
                        cache: true
                    },
                    allowClear: true
                })
            }
        }

        function getNumberOfTr() {
            $('#dynamic_field tr').each(function(index, tr) {
                $(this).find("td.no input").val(index + 1)
                $(this).find("input.id").attr('name', `jurnals[${index}][id]`);
                select2Akun(index);
                $(this).find("td select.akun_id").attr('name', `jurnals[${index}][akun_id]`);
                $(this).find("td input.debit").attr('name', `jurnals[${index}][debit]`);
                $(this).find("td input.kredit").attr('name', `jurnals[${index}][kredit]`);
            })
        }

        function field_dinamis() {
            let index = $('#dynamic_field tr').length
            let uuid = generateUUID()
            let html = `
                <tr class="rowComponent">
                    <input type="hidden" width="10px" name="jurnals[${index}][id]" class="id" value="${uuid}">
                    <td class="no" hidden>
                        <input type="text" value="${index + 1}" class="form-control" disabled>
                    </td>
                    <td>
                        <select name="jurnals[${index}][akun_id]" class="form-control select-${index} akun_id"></select>
                    </td>
                    <td>
                        <input type="text" name="jurnals[${index}][debit]" class="form-control debit" 
                            placeholder="0" onkeypress="onlyNumber(event)" oninput="jumlahin()" autocomplete="off">
                    </td>
                    <td>
                        <input type="text" name="jurnals[${index}][kredit]" class="form-control kredit" 
                            placeholder="0" onkeypress="onlyNumber(event)" oninput="jumlahin()" autocomplete="off">
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
            // jurnalEachColumn(index)
            feather.replace()
            select2Akun(index)

            document.querySelectorAll(".debit").forEach((item) => {
                item.addEventListener("keyup", function (event) {
                    const val = this.value == '' ? 0 : this.value.replace(/\D/g, "")
                    const n = parseInt(val, 10);
                    item.value = formatter(n);

                    // const total = parseFloat(item.value.replace(/,/g, '')) * parseInt($('[name="' + form + '['+index+'][jumlah]"]').val());
                    // $('[name="' + form + '['+index+'][total]"]').val(formatter(total));
                });
            });

            document.querySelectorAll(".kredit").forEach((item) => {
                item.addEventListener("keyup", function (event) {
                    const val = this.value == '' ? 0 : this.value.replace(/\D/g, "")
                    const n = parseInt(val, 10);
                    item.value = formatter(n);

                    // const total = parseFloat(item.value.replace(/,/g, '')) * parseInt($('[name="' + form + '['+index+'][jumlah]"]').val());
                    // $('[name="' + form + '['+index+'][total]"]').val(formatter(total));
                });
            });
        }
        
        field_dinamis()

        let dataSelect2 = {
            sumber: [{ id: 'KM', text: 'KM (Kas Masuk)' }, { id: 'KK', text: 'KK (Kas Keluar)' }, { id: 'JU', text: 'JU (Jurnal Umum)' }],
            frekuensi: [{ id: 'Harian', text: 'Harian' }, { id: 'Bulanan', text: 'Bulanan' }, { id: 'Tahunan', text: 'Tahunan' }],
        };

        $(document).ready(function() {
            $("#sumber").select2({
                placeholder: '-- Pilih Sumber --',
                data: dataSelect2.sumber,
                allowClear: true,
                minimumResultsForSearch: Infinity
            })
            $('#sumber').val(null).trigger('change');
            $("#sumber").on('select2:select', function(e) {
                jumlahin()
                getNumberOfTr()
            })

            $("#frekuensi").select2({
                placeholder: '-- Pilih Frekuensi --',
                data: dataSelect2.frekuensi,
                allowClear: true,
                minimumResultsForSearch: Infinity
            })
            $('#frekuensi').val(null).trigger('change');

            $("#per_tanggal").select2({
                placeholder: '-- Pilih Tanggal --',
                allowClear: true,
                minimumResultsForSearch: Infinity
            })
            $('#per_tanggal').val(null).trigger('change');

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
        
    </script>
@endpush
