@extends('_layouts.main')
@section('title', 'Penjualan')
@push('breadcrumb')
<li class="breadcrumb-item">
    <a href="{{ route('admin.sales.') }}">Penjualan</a>
</li>
<li class="breadcrumb-item">
    <a href="{{ route('admin.sales.pembayaran.index') }}">Pembayaran Piutang</a>
</li>
<li class="breadcrumb-item" aria-current="page">Tambah Pembayaran Piutang</li>
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
        <form class="forms-sample" class="repeater" action="{{ route('admin.purchase.pembayaran.store') }}" method="POST">
            <div class="card ">
                <div class="card-body">
                    @csrf
                    <input type="hidden" name="kode" value="{{ $kode }}">
                    <div class="row">
                        <div class="col-sm-3">
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

                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="kode">{{ __('Kode Penawaran') }}<span class="text-red">*</span></label>
                                <input class="form-control" id="kode" type="text" value="{{ $kode }}" name="kode"
                                    readonly>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="pemasok_id">{{ __('Pemasok') }}<span class="text-red">*</span></label>
                                <select name="pemasok_id" id="pemasok_id"
                                    class="form-control select2 @error('pemasok_id') is-invalid @enderror">
                                </select>
                                <div class="help-block with-errors"></div>
                                @error('pemasok_id')
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
                                    TAMBAH Pemasok
                                </a>
                            </div>
                        </div>

                        <div class="col-sm-3">
                          <div class="form-group">
                              <label for="akun_id">{{ __('Akun') }}<span class="text-red">*</span></label>
                              <select name="akun_id" id="akun_id"
                                  class="form-control select2 @error('akun_id') is-invalid @enderror">
                              </select>
                              <div class="help-block with-errors"></div>
                              @error('akun_id')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                              @enderror
                          </div>
                      </div>
                    </div>
                </div>
            </div>
            <div class="card ">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="table-responsive">
                                <table class="table table-borderless mt-2">
                                    <thead>
                                        <tr class="rowHead">
                                            <td>Faktur</td>
                                            <td>Jumlah</td>
                                            <td>bayar</td>
                                        </tr>
                                    </thead>
                                    <tbody id="dynamic_field"></tbody>
                                </table>
                                <button type="button" id="add" class="btn btn-success my-2"
                                    style="width: 100%; height: 50px">
                                    <i data-feather="plus"></i>
                                    Tambah Row Baru
                                </button>
                                <table class="table table-borderless col-sm-6 ml-auto border-top">
                                    <tbody>
                                        <tr>
                                            <th style="width: 180px">Total</th>
                                            <td>
                                                <input type="text" name="total" class="form-control" id="total" placeholder="0" readonly>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="col-md-12 mt-4">
                <div class="form-group">
                    <a href="{{ route('admin.sales.pembayaran.index') }}" class="btn btn-danger">KEMBALI</a>
                    <button type="submit" class="btn btn-primary" id="btn-submit">
                        TAMBAH</button>
                </div>
            </div>
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
        width: 100% !important;
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

    $(document).ready(function () {
        $("#pemasok_id").select2({
            placeholder: "-- Pilih Pemasok --",
            ajax: {
                url: '{{ route('api.select2.get-pemasok') }}',
                type: 'post',
                dataType: 'json',
                data: params => {
                    return {
                        _token: CSRF_TOKEN,
                        search: params.term
                    }
                },
                error: (err) => {
                    console.log(err)
                },
                processResults: data => {
                    return {
                        results: data
                    }
                },
                cache: true
            },
        });

        $("#akun_id").select2({
            placeholder: "-- Pilih Akun --",
            ajax: {
                url: '{{ route('api.select2.get-akun-faktur') }}',
                type: 'post',
                dataType: 'json',
                data: params => {
                    return {
                        _token: CSRF_TOKEN,
                        search: params.term
                    }
                },
                error: (err) => {
                    console.log(err)
                },
                processResults: data => {
                    return {
                        results: data
                    }
                },
                cache: true
            },
        });
    });

</script>
<script>

</script>
<script>

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
        let total =  0
        let cols_debit = document.querySelectorAll('.bayar')
        for (let i = 0; i < cols_debit.length; i++) {
            let e_debit = cols_debit[i];
            total += parseFloat(e_debit.value.replace(/,/g, '')) == "" ? 0 : parseFloat(e_debit.value.replace(/,/g, ''))
        }
        return total;
    }

    function field_dinamis() {
            let index = $('#dynamic_field tr').length
            let uuid = generateUUID()
            let html = `
                <tr class="rowComponent">
                    <input type="hidden" width="10px" name="pembayarans[${index}][id]" value="${uuid}">
                    <td class="no" hidden>
                        <input type="text" value="${index + 1}" class="form-control" disabled>
                    </td>
                    <td>
                        <select name="pembayarans[${index}][faktur_id]" class="form-control select-${index}"></select>
                    </td>
                    <td>
                        <input type="text" name="pembayarans[${index}][jumlah]"  class="form-control jumlah" readonly>
                    </td>
                    <td>
                        <input type="text" name="pembayarans[${index}][bayar]" class="form-control bayar"  readonly>
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

      
            $('[name="pembayarans['+index+'][bayar]"]').on('change', function () {
                // const harga = $('[name="pembayarans['+index+'][jumlah]"]').val();
                // const total = parseFloat(harga.replace(/,/g, '')) * parseInt($(this).val());
                // $('[name="pembayarans['+index+'][total]"]').val(formatter(total));

                $("#total").val(formatter(jumlahin()))
                
            });
            // jurnalEachColumn(index)
            feather.replace()
            $('select[name="pembayarans['+index+'][faktur_id]"]').select2({
                placeholder: '-- Pilih Faktur --',
                ajax: {
                    url: '{{ route('api.select2.get-buy-faktur') }}',
                    type: 'post',
                    dataType: 'json',
                    data: params => {
                        return {
                            _token: CSRF_TOKEN,
                            search: params.term
                        }
                    },
                    error: (err) => {
                        console.log(err)
                    },
                    processResults: data => {
                        return {
                            results: data
                        }
                    },
                    cache: true,
                },
                allowClear: true
            })

            $('select[name="pembayarans['+index+'][faktur_id]"]').on('select2:select', function (e) {
				        const total = e.params.data.total

                $('[name="pembayarans['+index+'][bayar]"]').attr('readonly', false)
                $('[name="pembayarans['+index+'][jumlah]"]').val(formatter(total))
            
            })

            document.querySelectorAll('.bayar').forEach(item => {
                item.addEventListener('keyup', function(event) {
                    
                    const n = parseInt(this.value.replace(/\D/g,''),10);
                    item.value = formatter(n);
                    
                    // const total = parseFloat(item.value.replace(/,/g, '')) * parseInt($('[name="pembayarans['+index+'][jumlah]"]').val());
                    // $('[name="pembayarans['+index+'][total]"]').val(formatter(total));
    
                })
            })

            // $('[name="pembayarans['+index+'][bayar]"]').on('change', function () {

            //     const jumlahDua = parseInt($('[name="pembayarans['+index+'][bayar]"]').val());
            //     const hargaDua = $(this).val();
            //     const totalDua = jumlahDua * parseFloat(hargaDua.replace(/,/g, ''))
            //     $('[name="pembayarans['+index+'][bayar]"]').val(formatter(totalDua));

            //     $("#total").val(formatter(jumlahin()))
                
            // });


    }

    function getNumberOfTr() {
        $('#dynamic_field tr').each(function(index, tr) {
            $(this).find("td.no input").val(index + 1)
        })
    }
</script>
<script>
    field_dinamis();
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
            $("#total").val(formatter(jumlahin()))
        })
    })
</script>
@endpush
