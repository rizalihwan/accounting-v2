@extends('_layouts.main')
@section('title', 'Jurnal Umum')
@section('content')
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-user-plus bg-blue"></i>
                        <div class="d-inline">
                            <h5>Jurnal Umum</h5>
                            <span>Form tambah jurnal umum</span>
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
                                <a href="{{ route('admin.jurnalumum.create') }}">Tambah Jurnal Umum</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-header justify-content-between d-flex">
                        <div>
                            <h3>Tambah Jurnal Umum</h3>
                        </div>
                        <div>
                            No. Jurnal : <strong>JU000043</strong>
                        </div>
                    </div>
                    <div class="card-body">
                        <form class="forms-sample" action="{{ route('admin.jurnalumum.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <label for="tanggal">{{ __('Tanggal') }}<span class="text-red">*</span></label>
                                        <input id="tanggal" type="date"
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
                                            <option value="" selected>Pilih Kontak</option>
                                        </select>
                                        <div class="help-block with-errors"></div>
                                        @error('kontak_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-3 mt-2">
                                    <div class="form-group"></div>
                                    <div class="form-group">
                                        <a href="{{ route('admin.kontak.create') }}" class="btn btn-danger"> <i
                                            class="fa fa-plus"></i>
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
                                        <table class="table table-borderless">
                                            <thead>
                                                <td>Akun</td>
                                                <td>Debit</td>
                                                <td>Kredit</td>
                                                <td style="width: 1px"></td>
                                            </thead>
                                            <tbody id="dynamic_field"></tbody>
                                        </table>
                                        <button type="button" id="add"
                                            class="btn btn-success my-2"
                                            style="width: 100%; height: 40px">
                                            <i class="ik ik-plus"></i>
                                            Tambah Row Baru
                                        </button>
                                        <table class="table table-borderless col-sm-6 ml-auto">
                                            <hr class="col-sm-6 ml-auto">
                                            <tbody>
                                                <tr>
                                                    <th style="width: 180px">Total</th>
                                                    <td id="total_debit">0</td>
                                                    <td id="total_kredit">0</td>
                                                </tr>
                                                <tr>
                                                    <th>Difference</th>
                                                    <td></td>
                                                    <td id="difference">0</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <hr>
                                </div>
                            </div>

                            <div class="col-md-12 mt-4">
                                <div class="form-group">
                                    <a href="{{ route('admin.jurnalumum.index') }}" class="btn btn-danger">KEMBALI</a>
                                    <button type="submit" class="btn btn-primary">
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

@push('head')
    <style>
        .select2 {
            width: 100%!important;
        }
    </style>
@endpush

@push('script')
    <script src="{{ asset('plugins/jquery.repeater/jquery.repeater.min.js') }}"></script>
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
                        <input type="text" name="jurnals[${index}][debit]" class="form-control" placeholder="0" onkeypress="return onlyNumber(event)">
                    </td>
                    <td>
                        <input type="text" name="jurnals[${index}][kredit]" class="form-control" placeholder="0" onkeypress="return onlyNumber(event)">
                    </td>
            `
            if (index >= 1) {
                html += `
                    <td>
                        <button type="button" name="remove" 
                            class="btn btn-danger text-white btn_remove">
                            <i class="ik ik-trash-2"></i>
                        </button>
                    </td></tr>
                `
                $("#dynamic_field").append(html)
            } else {
                $("#dynamic_field").append(html)
            }

            jurnalEachColumn(index)
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
    </script>
@endpush
