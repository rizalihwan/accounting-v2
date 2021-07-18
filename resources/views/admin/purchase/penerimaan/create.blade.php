@extends('_layouts.main')
@section('title', 'Tambah Penerimaan Barang')
@push('breadcrumb')
<li class="breadcrumb-item">
    <a href="{{ route('admin.purchase.') }}">Pembelian</a>
</li>
<li class="breadcrumb-item">
    <a href="{{ route('admin.purchase.terima.index') }}">Penerimaan Barang</a>
</li>
<li class="breadcrumb-item active" aria-current="page">Tambah</li>
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
        <form class="forms-sample" class="repeater" action="{{ route('admin.purchase.terima.store') }}" method="POST">
            <div class="card ">
                <div class="card-body">
                    @csrf
                    <input type="hidden" name="kode" value="{{ $kode }}">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="pemasok_id">{{ __('Pelanggan') }}<span class="text-danger">*</span></label>
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

                        <div class="col-md-4">
                            <div class="form-group">
                                <a href="{{ route('admin.kontak.create') }}" class="btn btn-outline-danger tambah-pelanggan">
                                    <i data-feather="plus"></i>
                                    Tambah Pemasok
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="tanggal">{{ __('Tanggal') }}<span class="text-danger">*</span></label>
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
                                <label for="kode">{{ __('Kode Pesanan') }}<span class="text-danger">*</span></label>
                                <input class="form-control" id="kode" type="text" value="{{ $kode }}" name="kode"
                                    readonly>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="pesanan_id">{{ __('Pesanan') }}<span class="text-danger">*</span></label>
                                <select name="pesanan_id" id="pesanan_id"
                                    class="form-control select2 @error('pesanan_id') is-invalid @enderror">
                                </select>
                                <div class="help-block with-errors"></div>
                                @error('pesanan_id')
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
                            <table class="table table-borderless col-sm-6 ml-auto border-top">
                                <tbody>
                                    <tr class="rowComponentTotal">
                                        <th style="width: 100px">Total</th>
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
            padding: 0px 8px 16px 0 !important
    }
    .rowHead td{
        padding: 0px 8px 16px 0 !important
    }
    .rowComponent td .form-control{
        border-radius:0px !important;
    }

    .rowComponentTotal th{
        padding-right: 8px !important;
        padding-left: 0px !important;
    }
    .rowComponentTotal td{
        padding-right: 8px !important;
        padding-left: 0px !important;
    }
    .rowComponentTotal td .form-control{
        border-radius:0px !important;
    }

    @media only screen and (max-width: 1024px) {
        .rowComponent td .jumlah {
            width: 70px;
        }
        .rowComponentTotal th{
            width: 160px !important;
        }
        .rowComponentTotal td .form-control{
            width: 100%;
        }
    }

    @media only screen and (max-width: 768px) {
        .tambah-pelanggan {
            margin-top: 0;
            float: right;
        }
        .rowComponentTotal td .form-control{
            width: 200px;
        }
        .rowComponentTotal th{
            width: 100px !important;
        }
        .rowComponentTotal td .form-control{
            width: 100%;
        }
    }

    @media only screen and (min-width: 768px) {
        .tambah-pelanggan {
            margin-top: 23px;
        }
        .rowComponentTotal th{
            width: 100px !important;
        }
    }

    @media only screen and (max-width: 575px) {
        .rowComponentTotal td .form-control{
            width: 100%;
        }
        .rowComponentTotal th{
            width: 150px !important;
        }
    }

    @media only screen and (max-width: 650px) {
        .rowComponent td .jumlah {
            width: 60px;
        }
        .rowComponent td .satuan {
            width: 100px;
        }
        .rowComponent td .harga {
            width: 120px;
        }
        .rowComponent td .total {
            width: 130px;
        }
    }

</style>
@endpush

@push('script')
<script src="{{ asset('plugins/jquery.repeater/jquery.repeater.min.js') }}"></script>
<script src="{{ asset('app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
<script src="{{ asset('app-assets/js/scripts/forms/form-select2.min.js') }}"></script>
<script src="{{ asset('js/helpers.js') }}"></script>
<script src="{{ asset('js/dynamic_fields.js') }}"></script>
<script>
    $(document).ready(function () {
        $("#pemasok_id").select2({
            placeholder: "-- Pilih Pemasok --",
            allowClear: true,
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
                processResults: data => {
                    return {
                        results: data
                    }
                },
                cache: true
            },
        });

        // Start PESANAN Select2
        $("#pesanan_id").select2({
            placeholder: "-- Pilih Pesanan --",
            allowClear: true,
            ajax: {
                url: '{{ route('api.select2.get-buy-pesanan') }}',
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
        });

        $('#pesanan_id').on('select2:select', function (e) {
            const data = e.params.data;
            const detail = data.detail;
            let subtotal = 0;

            $(this).attr('disabled', true)
            $("#add").attr('disabled', true)
            $("#btn-submit").attr('disabled', true)

            for (let index = 0; index < detail.length; index++) {
                let product_id = detail[index].product_id;
                let jumlah = detail[index].jumlah;
                let satuan = detail[index].satuan;
                let harga = detail[index].harga;
                let total = detail[index].total;

                let selected_product_url = '{{ route('api.select2.get-buy-product.selected', ':id') }}';

                $("#dynamic_field").html('')

                $.ajax({
                    url: selected_product_url.replace(':id', product_id),
                    type: 'get',
                }).then((data) => {
                    field_dinamis('penerimaans', '{{ route('api.select2.get-buy-product') }}');
                    $(".btn_remove").attr('disabled', true);

                    let option = new Option(data.text, data.id, true, true)

                    $('select[name="penerimaans['+index+'][product_id]"]').append(option).trigger('change')
                    $('select[name="penerimaans['+index+'][product_id]"]').trigger({
                        type: 'select2:select',
                        params: {
                            data: data
                        }
                    })

                    $('[name="penerimaans['+index+'][harga]"]').attr('readonly', false)
                    $('[name="penerimaans['+index+'][jumlah]"]').attr('readonly', false)

                    $('[name="penerimaans['+index+'][jumlah]"]').val(jumlah)
                    $('[name="penerimaans['+index+'][satuan]"]').val(satuan)
                    $('[name="penerimaans['+index+'][harga]"]').val(formatter(harga))
                    $('[name="penerimaans['+index+'][total]"]').val(formatter(total))

                    subtotal += total;
                    $("#total").val(formatter(subtotal))

                    if ((index + 1) == detail.length) {
                        $(this).attr('disabled', false)
                        $(".btn_remove").attr('disabled', false);
                        $("#add").attr('disabled', false)
                        $("#btn-submit").attr('disabled', false)
                    }
                })
            }
        })
        // End PESANAN Select2
    });

</script>
<script>
    field_dinamis('penerimaans', '{{ route('api.select2.get-buy-product') }}');
    $(document).ready(function(){
        $('#add').click(function(){
            field_dinamis('penerimaans', '{{ route('api.select2.get-buy-product') }}');
            checkRowLength();
        })

        $(document).on('click', '.btn_remove', function() {
            let parent = $(this).parent()
            let id = parent.data('id')
            let delete_data = $("input[name='delete_data']").val()
            if(id !== 'undefined' && id !== undefined) {
                $("input[name='delete_data']").val(delete_data + ';' + id)
            }
            $('.btn_remove').eq($('.btn_remove').index(this)).parent().parent().remove()
            getNumberOfTr('penerimaans')
            checkRowLength();
            $("#total").val(formatter(jumlahin()))
        })
    })
</script>
@endpush
