@extends('_layouts.main')
@section('title', 'Penjualan')
@push('breadcrumb')
<li class="breadcrumb-item">
    <a href="{{ route('admin.purchase.') }}">Pembelian</a>
</li>
<li class="breadcrumb-item">
    <a href="{{ route('admin.purchase.penawaran.index') }}">Penawaran Harga</a>
</li>
<li class="breadcrumb-item active" aria-current="page">Edit</li>
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
        <form class="forms-sample" class="repeater" action="{{ route('admin.purchase.penawaran.update', $penawaran->id) }}" method="POST">
            <div class="card ">
                <div class="card-body">
                    @csrf
                    @method('patch')
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="tanggal">{{ __('Tanggal') }}</label>
                                <input id="tanggal" type="date" value="{{ $penawaran->tanggal }}"
                                    class="form-control" disabled>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="kode">{{ __('Kode Penawaran') }}</label>
                                <input id="kode" type="text" value="{{ $penawaran->kode }}"
                                    class="form-control" disabled>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="pemasok_id">{{ __('Pemasok') }}</label>
                                <input id="pemasok_id" type="text" value="{{ $penawaran->pemasok->nama }}"
                                    class="form-control" disabled>
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
                            <table class="table table-borderless col-sm-6 ml-auto border-top">
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
                    <a href="{{ route('admin.sales.penawaran.index') }}" class="btn btn-danger">KEMBALI</a>
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
    let penawarandetail_url = '{{ route('api.get-buy-penawaran.details', ':id') }}';
    let url_product = '{{ route('api.select2.get-buy-product') }}';
    let selected_product = '{{ route('api.select2.get-buy-product.selected', ':id') }}';

    $(document).ready(function(){
        $("#btn-submit").attr('disabled', true)
        $("#add").attr('disabled', true);

        $.ajax({
            type: 'get',
            url: penawarandetail_url.replace(':id', '{{ $penawaran->id }}'),
            dataType: 'json',
            error: (err) => {
                console.log(err);
            },
            success: results => {
                let subtotal = 0;
                Object.keys(results.data).forEach(key => {
                    const data = results.data[key];
                    $.ajax({
                        type: 'get',
                        url: selected_product.replace(':id', data.product_id),
                        error: (err) => {
                            console.log(err);
                        }
                    }).then((result) => {
                        field_dinamis_edit(
                            'penawarans', url_product,
                            data.id, data.jumlah, data.total
                        );
                        $(".btn_remove").attr('disabled', true);

                        subtotal += parseInt(data.total)
                        $("#total").val(formatter(subtotal))

                        if ((parseInt(key) + 1) == results.length) {
                            $("#btn-submit").attr('disabled', false)
                            $("#add").attr('disabled', false)
                            $(".btn_remove").attr('disabled', false);
                        }

                        let option = new Option(result.text, result.id, true, true)
                        $('select[name="penawarans['+ key +'][product_id]"]').append(option).trigger('change')
                        $('select[name="penawarans['+ key +'][product_id]"]').trigger({
                            type: 'select2:select',
                            params: {
                                data: result
                            }
                        })
                    })
                });
            }
        })

        $('#add').click(function(){
            field_dinamis_edit('penawarans', url_product);
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
            getNumberOfTr('penawarans');
            checkRowLength();

            $("#total").val(formatter(jumlahin()))
        })
    })
</script>
@endpush
