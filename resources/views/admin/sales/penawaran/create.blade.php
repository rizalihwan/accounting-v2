@extends('_layouts.main')
@section('title', 'Jurnal Umum')
@push('breadcrumb')
<li class="breadcrumb-item">
    <a href="{{ route('admin.sales') }}">Penjualan</a>
</li>
<li class="breadcrumb-item">
    <a href="{{ route('admin.penawaran.index') }}">Penawaran Harga</a>
</li>
<li class="breadcrumb-item" aria-current="page">Tambah Penawaran Harga</li>
@endpush
@section('content')

@endsection

@push('select2')
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/forms/select/select2.min.css') }}">
@endpush
@push('head')
    <style>
        .select2 {
            width: 100%!important;
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
            `
            if (index >= 1) {
                html += `
                    <td>
                        <button type="button" name="remove" 
                            class="btn btn-danger text-white btn_remove">
                            <i data-feather="trash-2"></i>
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
