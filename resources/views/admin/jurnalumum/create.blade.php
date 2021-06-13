@extends('_layouts.main')
@section('title', 'Jurnal Umum')
    @push('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('admin.jurnalumum.index') }}">Jurnal Umum</a>
    </li>
    <li class="breadcrumb-item" aria-current="page">Buat Jurnal Umum</li>
    @endpush
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-header justify-content-between d-flex">
                        <div>
                            <h3>Tambah Jurnal Umum</h3>
                        </div>
                        <div>
                            No. Jurnal : <strong>{{ $kode }}</strong>
                        </div>
                    </div>
                    <div class="card-body">
                        <form class="forms-sample" action="{{ route('admin.jurnalumum.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="kode_jurnal" value="{{ $kode }}">
                            <input type="hidden" name="status" value="1">
                            <div class="row">
                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <label for="tanggal">{{ __('Tanggal') }}<span class="text-red">*</span></label>
                                        <input id="tanggal" type="date" value="{{ date('Y-m-d') }}"
                                            class="form-control @error('tanggal') is-invalid @enderror" name="tanggal">
                                        <div class="help-block with-errors"></div>
                                        @error('tanggal')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="kontak_id">{{ __('Kontak') }}<span class="text-red">*</span></label>
                                        <select name="kontak_id" id="kontak_id"
                                            class="form-control select2 @error('kontak_id') is-invalid @enderror">
                                            <option disabled selected>-- Pilih Kontak --</option>
                                            {{-- @foreach ($contacts as $contact)
                                                <option value="{{ $contact->id }}">{{ $contact->nama }}</option>
                                            @endforeach --}}
                                        </select>
                                        <div class="help-block with-errors"></div>
                                        @error('kontak_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
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
                            </div>
                            <div class="row">
                                <div class="col-sm-11">
                                    <div class="form-group">
                                        <label for="uraian">{{ __('Uraian') }}<span class="text-red">*</span></label>
                                        <input type="text" name="uraian" id="uraian" class="form-control"
                                            placeholder="uraian...">
                                        <div class="help-block with-errors"></div>
                                        @error('uraian')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
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
                            </div>

                            <hr>

                            <div class="col-md-12 mt-4">
                                <div class="form-group">
                                    <a href="{{ route('admin.jurnalumum.index') }}" class="btn btn-danger">KEMBALI</a>
                                    <button type="submit" class="btn btn-primary" id="btn-submit">
                                        TAMBAH</button>
                                </div>
                            </div>
                        </form>
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
    <script>
        let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content')
        $(document).ready(function() {
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
                templateSelection: data => {
                    return data.nama
                }
            })
        });
        async function jurnalEachColumn(index) {
            let fetchData = await fetch(`{{ route('api.select2.get-akun') }}`)
            let response = JSON.parse(await fetchData.text())
            let $select2 = $('select[name="jurnals['+index+'][akun_id]"]').select2({
                placeholder: "Pilih Akun"
            }).empty()
            $select2.append($("<option></option>").attr("value", '').text('Choose Type'))
            $.each(response, function(key, data){
                $select2.append($("<option></option>").attr("value", data.id).text(data.name))
            })
        }
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
                        <input type="text" name="jurnals[${index}][debit]" class="form-control debit" oninput="jumlahin()" placeholder="0" onkeypress="return onlyNumber(event)">
                    </td>
                    <td>
                        <input type="text" name="jurnals[${index}][kredit]" class="form-control kredit" oninput="jumlahin()" placeholder="0" onkeypress="return onlyNumber(event)">
                    </td>
                    <td>
                        <button type="button" name="remove" 
                            class="btn btn-danger btn-sm text-white btn_remove">
                            <i data-feather="trash-2"></i>
                        </button>
                    </td>
                </tr>
            `
            $("#dynamic_field").append(html)
            jurnalEachColumn(index)
            feather.replace()
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
        function onlyNumber(evt){
            let charCode = (evt.which) ? evt.which : evt.keyCode
            if (charCode > 32 && (charCode < 48 || charCode > 57)) {
                return false
            }
            return true
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
                total_debit += e_debit.value == "" ? 0 : parseInt(e_debit.value)
                total_kredit += e_kredit.value == "" ? 0 : parseInt(e_kredit.value)
            }
            if (total_debit > total_kredit) {
                difference = total_kredit - total_debit
            } else if (total_debit < total_kredit) {
                difference = total_debit - total_kredit
            } else {
                difference = 0
            }
            $("#total_debit").text(total_debit)
            $("#total_kredit").text(total_kredit)
            $("#difference").text(difference)
            if (difference === 0) {
                $("#btn-submit").attr('disabled', false)
                $("#btn-submit").attr('hidden', false)
            } else {
                $("#btn-submit").attr('disabled', true)
                $("#btn-submit").attr('hidden', true)
            }
        }
    </script>
@endpush
