@extends('_layouts.main')
@section('title', 'Edit Pesanan')
@push('breadcrumb')
<li class="breadcrumb-item">
    <a href="{{ route('admin.purchase.') }}">Pembelian</a>
</li>
<li class="breadcrumb-item">
    <a href="{{ route('admin.purchase.pesanan.index') }}">Pesanan</a>
</li>
<li class="breadcrumb-item" aria-current="page">Edit</li>
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
        <form class="forms-sample" class="repeater" action="{{ route('admin.purchase.pesanan.update', $pesanan->id) }}" method="POST">
            <div class="card ">
                <div class="card-body">
                    @csrf
                    @method('patch')
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="pemasok_id">{{ __('Pemasok') }}</label>
                                <input type="text" id="pemasok_id" value="{{ $pesanan->pemasok->nama }}"
                                    class="form-control" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="tanggal">{{ __('Tanggal') }}</label>
                                <input type="date" id="tanggal" value="{{ $pesanan->tanggal }}"
                                    class="form-control" disabled>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="kode">{{ __('Kode Pesanan') }}</label>
                                <input type="text" id="kode" value="{{ $pesanan->kode }}" 
                                    class="form-control" disabled>
                            </div>
                        </div>

                        @if(!empty($pesanan->penawaran_id))
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="penawaran_id">{{ __('Penawaran') }}</label>
                                    <input type="text" id="penawaran_id" value="{{ $pesanan->penawaran->kode }}"
                                        class="form-control" disabled>
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
                                            <td>Product / Jasa</td>
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
            <hr>
            <div class="col-md-12 mt-4">
                <div class="form-group">
                    <a href="{{ route('admin.purchase.pesanan.index') }}" class="btn btn-danger">KEMBALI</a>
                    <button type="submit" class="btn btn-primary" id="btn-submit">
                        UPDATE
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
    const pesanandetail_url = '{{ route('api.get-buy-pesanan.details', ':id') }}';

    $(document).ready(function () {
        $("#btn-submit").attr('disabled', true)
        $("#add").attr('disabled', true);

        $.ajax({
            type: 'get',
            url: pesanandetail_url.replace(':id', '{{ $pesanan->id }}'),
            dataType: 'json',
            success: results => {
                Object.keys(results.data).forEach(key => {
                    const data = results.data[key];
                    const product = results.data[key].product;
                    const option = new Option(product.name, product.id, true, true);

                    field_dinamis_edit(
                        'pesanans', '{{ route('api.select2.get-buy-product') }}',
                        data.id, data.jumlah, data.total
                    );
                    $(".btn_remove").attr('disabled', true);

                    if ((parseInt(key) + 1) == results.length) {
                        $("#btn-submit").attr('disabled', false)
                        $("#add").attr('disabled', false)
                        $(".btn_remove").attr('disabled', false);
                    }

                    $('select[name="pesanans['+ key +'][product_id]"]').attr('disabled', true);
                    $('select[name="pesanans['+ key +'][product_id]"]').append(option).trigger('change')
                    $('select[name="pesanans['+ key +'][product_id]"]').trigger({
                        type: 'select2:select',
                        params: {
                            data: product
                        }
                    })

                    $('select[name="pesanans['+ key +'][product_id]"]').attr('disabled', false);
                    $('[name="pesanans[' + key + '][jumlah]"]').attr("readonly", false).val(data.jumlah);
                    $('[name="pesanans[' + key + '][satuan]"]').val(data.satuan);
                    $('[name="pesanans[' + key + '][harga]"]').attr("readonly", false).val(formatter(data.harga));
                    $('[name="pesanans[' + key + '][total]"]').val(formatter(data.total));
                    $("#total").val(formatter(jumlahin()));
                });
            }
        })

        $('#add').click(function(){
            field_dinamis_edit('pesanans', '{{ route('api.select2.get-buy-product') }}');
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
            getNumberOfTr('pesanans')
            checkRowLength()

            $("#total").val(formatter(jumlahin()))
        })
    })
</script>
@endpush
