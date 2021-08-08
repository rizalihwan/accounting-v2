@extends('_layouts.main')
@section('title', 'Buku Kas Masuk')
@section('content')
    @push('breadcrumb')
        <li class="breadcrumb-item">
            <a href="{{ route('admin.cash-bank') }}">Kas & Bank</a>
        </li>
        <li class="breadcrumb-item active">
            <a href="{{ route('admin.bkm.index') }}">Buku Kas Masuk</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">Create</li>
    @endpush
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
            <form action="{{ route('admin.bkm.store') }}" method="POST" class="invoice-repeater">
                @csrf
                <div class="card mb-2 ">
                    <div class="card-header">
                        <h4>Create Income</h4>
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
@endsection

@push('select2')
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/forms/select/select2.min.css') }}">
@endpush
@push('head')
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
            $('select[name="bkm['+index+'][rekening]"]').select2({
                placeholder: '-- No. Rekening --',
                ajax: {
                    url: '{{ route('api.select2.get-akun') }}',
                    type: 'post',
                    dataType: 'json',
                    data: params => {
                        return {
                            _token: CSRF_TOKEN,
                            search: params.term,
                            kas_bank: 'no',
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
            });
        }

        function getNumberOfTr() {
            $('#dynamic_field tr').each(function(index, tr) {
                $(this).find("td.no input").val(index + 1)
                $(this).find("input.id").attr('name', `bkm[${index}][id]`);
                select2Rekening(index);
                $(this).find("td select.rekening").attr('name', `bkm[${index}][rekening]`);
                $(this).find("td input.jumlah").attr('name', `bkm[${index}][jumlah]`);
                $(this).find("td input.catatan").attr('name', `bkm[${index}][catatan]`);
            })

            checkRowLength()
        }

        function checkRowLength() {
            let length = $("#dynamic_field tr").length;
            if (length > 0) {
                $("#save").attr('disabled', false)
            } else {
                $("#save").attr('disabled', true)
            }
        }

        function field_dinamis() {
            let index = $('#dynamic_field tr').length
            let uuid = generateUUID()
            let html = `
                <tr class="rowComponent">
                    <input type="hidden" width="10px" name="bkm[${index}][id]" class="id" value="${uuid}">
                    <td class="no" hidden>
                        <input type="text" value="${index + 1}" class="form-control" disabled>
                    </td>
                    <td>
                        <select name="bkm[${index}][rekening]" class="form-control select-${index} rekening"></select>
                    </td>
                    <td>
                        <input type="text" name="bkm[${index}][jumlah]" class="form-control jumlah" 
                            onkeypress="onlyNumber(event)" placeholder="0" autocomplete="off" >
                    </td>
                    <td>
                        <input type="text" name="bkm[${index}][catatan]" class="form-control catatan">
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
        
        field_dinamis()
    </script>
    <script>
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
                        search: params.term,
                        kas_bank: 'yes',
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
        });
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

        @if (isset(session()->getOldInput()['bkm']))
            const bkm = @json(session()->getOldInput()['bkm']);
            $("#dynamic_field").empty()
            bkm.forEach((item, index) => {
                field_dinamis()

                if (item.rekening !== undefined) {
                    $('select[name="bkm['+ index +'][rekening]"]').attr('disabled', true);
                    $.ajax({
                        type: 'get',
                        url: '{{ route('api.select2.get-akun.selected', ':id') }}'.replace(':id', item.rekening),
                    }).then((data) => {
                        let option = new Option(data.text, data.id, true, true)
                        $('select[name="bkm['+ index +'][rekening]"]').append(option).trigger('change')
                        $('select[name="bkm['+ index +'][rekening]"]').trigger({
                            type: 'select2:select',
                            params: {
                                data: data
                            }
                        })
                        $('select[name="bkm['+ index +'][rekening]"]').attr('disabled', false);
                    })
                }

                $('[name="bkm['+ index +'][jumlah]"]').val(item.jumlah)
                $('[name="bkm['+ index +'][catatan]"]').val(item.catatan)
                eventJumlah()
                hitungTotal()
            })
        @endif
    </script>
    <script>
        $(document).ready(function() {
            $('#add').click(function(){
                field_dinamis()
                hitungTotal()
                checkRowLength()
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
@endpush
