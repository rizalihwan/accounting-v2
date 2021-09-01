@extends('_layouts.main')
@section('title', 'Penjualan')
@push('breadcrumb')
<li class="breadcrumb-item">
    <a href="{{ route('admin.sales.') }}">Penjualan</a>
</li>
<li class="breadcrumb-item">
    <a href="{{ route('admin.sales.pesanan.index') }}">Pesanan Penjualan</a>
</li>
<li class="breadcrumb-item" aria-current="page">Tambah Pesanan Penjualan</li>
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
        <form class="forms-sample" class="repeater" action="{{ route('admin.sales.pesanan.store') }}" method="POST">
            <div class="card ">
                <div class="card-body">
                    @csrf
                    <input type="hidden" name="kode" value="{{ $kode }}">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="pelanggan_id">{{ __('Pelanggan') }}<span class="text-red">*</span></label>
                                <select name="pelanggan_id" id="pelanggan_id"
                                    class="form-control select2 @error('pelanggan_id') is-invalid @enderror">
                                </select>
                                <div class="help-block with-errors"></div>
                                @error('pelanggan_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <a href="{{ route('admin.kontak.create') }}" class="btn btn-outline-danger tambah-pelanggan">
                                    <i data-feather="plus"></i>
                                    Tambah Pelanggan
                                </a>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-4">
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

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="kode">{{ __('Kode Pesanan') }}<span class="text-red">*</span></label>
                                <input class="form-control" id="kode" type="text" value="{{ $kode }}" name="kode"
                                    readonly>
                            </div>
                        </div>

                        @if($penawaran)
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="penawaran_id">{{ __('Penawaran') }}<span class="text-red">*</span></label>
                                    <select name="penawaran_id" id="penawaran_id"
                                        class="form-control select2 @error('penawaran_id') is-invalid @enderror">
                                    </select>
                                    <div class="help-block with-errors"></div>
                                    @error('penawaran_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="card ">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="table-responsive">
                                <table class="table table-borderless">
                                    <thead>
                                        <tr class="rowHead">
                                            <td>Product</td>
                                            <td>Jumlah</td>
                                            <td>Satuan Ukur</td>
                                            <td>Harga Satuan</td>
                                            <td>Total</td>
                                        </tr>
                                    </thead>
                                    <tbody id="dynamic_field"></tbody>
                                </table>
                            </div>
                            <button type="button" id="add" class="btn btn-success my-2"
                                style="width: 100%; height: 50px">
                                <i data-feather="plus"></i>
                                Tambah Row Baru
                            </button>
                            <table class="table table-borderless col-md-5 ml-auto border-top mt-2">
                                <tbody>
                                    <tr class="rowComponentTotal">
                                        <td style="width: 100px"><strong>Total</strong></td>
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
            <hr>
            <div class="col-md-12 mt-4">
                <div class="form-group">
                    <a href="{{ route('admin.sales.pesanan.index') }}" class="btn btn-danger">KEMBALI</a>
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
        padding: 0px 8px 16px 0 !important;
    }
    .rowHead td{
        padding: 0px 8px 16px 0 !important;
    }
    .rowComponent td .form-control{
        border-radius:0px !important;
    }

    .rowComponentTotal td{
        padding-right: 8px !important;
        padding-left: 0px !important;
    }
    .rowComponentTotal td .form-control{
        border-radius:0px !important;
    }

    @media only screen and (max-width: 768px) {
        .tambah-pelanggan {
            margin-top: 0;
            float: right;
        }
    }

    @media only screen and (min-width: 768px) {
        .tambah-pelanggan {
            margin-top: 23px;
        }
    }

</style>
@endpush

@push('script')
<script src="{{ asset('plugins/jquery.repeater/jquery.repeater.min.js') }}"></script>
<script src="{{ asset('app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
<script src="{{ asset('app-assets/js/scripts/forms/form-select2.min.js') }}"></script>
<script src="{{ asset('js/helpers.js') }}"></script>
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
        let cols_debit = document.querySelectorAll('.total')
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
                    <input type="hidden" width="10px" name="pesanans[${index}][id]" value="${uuid}">
                    <td class="no" hidden>
                        <input type="text" value="${index + 1}" class="form-control" disabled>
                    </td>
                    <td>
                        <select name="pesanans[${index}][product_id]" class="form-control select-${index}"></select>
                    </td>
                    <td>
                        <input type="text" name="pesanans[${index}][jumlah]" class="form-control jumlah" placeholder="0" readonly>
                    </td>
                    <td>
                        <input type="text" name="pesanans[${index}][satuan]" class="form-control satuan"  readonly>
                    </td>
                    <td>
                        <input type="text" name="pesanans[${index}][harga]" class="form-control harga" readonly>
                    </td>
                    <td>
                        <input type="text" name="pesanans[${index}][total]" class="form-control total"  placeholder="0" readonly>
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

            // const jumlah = document.getElementsByName(`penawarans[${index}][jumlah]`);
            // const total = document.getElementsByName(`penawarans[${index}][total]`);
            // jumlah.addEventListener('change', function (e){
            //     total.value = subTotal(index);
            // });

            $('[name="pesanans['+index+'][jumlah]"]').on('change', function () {

                const harga = $('[name="pesanans['+index+'][harga]"]').val();
                const total = parseFloat(harga.replace(/,/g, '')) * parseInt($(this).val());
                $('[name="pesanans['+index+'][total]"]').val(formatter(total));

                $("#total").val(formatter(jumlahin()))

            });
            // jurnalEachColumn(index)
            feather.replace()
            $('select[name="pesanans['+index+'][product_id]"]').select2({
                placeholder: '-- Pilih Product --',
                ajax: {
                    url: '{{ route('api.select2.get-product') }}',
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

            $('select[name="pesanans['+index+'][product_id]"]').on('select2:select', function (e) {
				const unit = e.params.data.unit
                const price = e.params.data.price_sell

				$('[name="pesanans['+index+'][satuan]"]').val(unit)
                $('[name="pesanans['+index+'][harga]"]').val(formatter(price))
                $('[name="pesanans['+index+'][jumlah]"]').attr('readonly', false)
                $('[name="pesanans['+index+'][harga]"]').attr('readonly', false)
			})

            document.querySelectorAll('.harga').forEach(item => {
                item.addEventListener('keyup', function(event) {
                    
                    const n = parseInt(this.value.replace(/\D/g,''),10);
                    item.value = formatter(n);
                    
                    // const total = parseFloat(item.value.replace(/,/g, '')) * parseInt($('[name="penawarans['+index+'][jumlah]"]').val());
                    // $('[name="penawarans['+index+'][total]"]').val(formatter(total));
    
                })
            })

            $('[name="pesanans['+index+'][harga]"]').on('change', function () {

                const jumlahDua = parseInt($('[name="pesanans['+index+'][jumlah]"]').val());
                const hargaDua = $(this).val();
                const totalDua = jumlahDua * parseFloat(hargaDua.replace(/,/g, ''))
                $('[name="pesanans['+index+'][total]"]').val(formatter(totalDua));

                $("#total").val(formatter(jumlahin()))
                
            });


    }

    function getNumberOfTr() {
        $('#dynamic_field tr').each(function(index, tr) {
            $(this).find("td.no input").val(index + 1)
        })
    }
</script>

<script>
    let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content')

    $(document).ready(function () {
        $("#pelanggan_id").select2({
            placeholder: "-- Pilih Pelanggan --",
            allowClear: true,
            ajax: {
                url: '{{ route('api.select2.get-pelanggan') }}',
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

        /* Penawaran SELECT2 */
        $("#penawaran_id").select2({
            placeholder: "-- Pilih Penawaran --",
            allowClear: true,
            ajax: {
                url: '{{ route('api.select2.get-sale-penawaran') }}',
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

        $('#penawaran_id').on('select2:select', function (e) {
            $("#dynamic_field").html('')

            const data = e.params.data;
            const detail = data.detail;

            for (let index = 0; index < detail.length; index++) {
                field_dinamis()

                let product_id = detail[index].product_id;
                let jumlah = detail[index].jumlah;
                let satuan = detail[index].satuan;
                let harga = detail[index].harga;
                let total = detail[index].total;

                
                
                let url_product = '{{ route('api.select2.get-product.selected', ':id') }}';
                url_product = url_product.replace(':id', product_id);

                $.ajax({
                    url: url_product,
                    type: 'get',
                    error: (err) => {
                        console.log(err);
                    }
                }).then((data) => {
                    let option = new Option(data.text, data.id, true, true)

                    $('select[name="pesanans['+index+'][product_id]"]').append(option).trigger('change')
                    $('select[name="pesanans['+index+'][product_id]"]').trigger({
                        type: 'select2:select',
                        params: {
                            data: data
                        }
                    })

                    
                    $('input[name="pesanans['+index+'][jumlah]"]').val(jumlah);
                    $('input[name="pesanans['+index+'][satuan]"]').val(satuan);
                    $('input[name="pesanans['+index+'][harga]"]').val(formatter(harga));
                    $('input[name="pesanans['+index+'][total]"]').val(formatter(total));

                    $("#total").val(formatter(jumlahin()))
                })
            }
        })
        /* End Penawaran Select2 */

    });

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
