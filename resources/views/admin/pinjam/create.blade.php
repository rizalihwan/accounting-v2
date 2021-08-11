@extends('_layouts.main')
@section('title', 'Tambah Data Pinjaman')
@push('breadcrumb')
<li class="breadcrumb-item">
    <a href="{{ route('admin.simpanpinjam') }}">Simpan & Pinjam</a>
</li>
<li class="breadcrumb-item"><a href="{{ route('admin.pinjam.index') }}">Pinjam</a></li>
<li class="breadcrumb-item" aria-current="page">Tambah Pinjaman</li>
@endpush
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>Tambah Pinjaman</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.pinjam.detail') }}" class="needs-validation" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="validationCustom01">Jumlah Pinjaman</label>
                                <input name="besar_pinjam" class="form-control" id="validationCustom01" type="number" placeholder="Jumlah Pinjaman" required="">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="validationCustom02">Lama Angsuran (Bulan)</label>
                                <input name="jangka" class="form-control" id="validationCustom02" type="number" placeholder="Lama Angsuran (Bulan)" required="">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="validationCustomUsername">Bunga</label>
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text" id="inputGroupPrepend">%</span></div>
                                    <input name="bunga" class="form-control" id="validationCustomUsername" type="number" placeholder="Bunga" aria-describedby="inputGroupPrepend" required="">
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label for="tipe_pinjaman">{{ __('Tipe Pinjaman') }}<span class="text-danger">*</span></label>
                                    <select name="tipe_pinjaman" id="tipe_pinjaman" class="form-control select2">

                                        <option value="Anuitas">Anuitas</option>
                                        <option value="Flat">Flat</option>
                                    </select>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="validationCustomUsername">Keterangan</label>
                                <textarea name="keterangan" class="form-control" required=""></textarea>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label for="nasabah_id">{{ __('Nomor Anggota') }}<span class="text-danger">*</span></label>
                                    <select name="nasabah_id" id="nasabah_id" class="form-control select2"></select>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="nama">Nama</label>
                                <input disabled name="nama" class="form-control" id="nama" type="text" placeholder="Nama" required="">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="alamat">Alamat</label>
                                <input disabled name="alamat" class="form-control" id="alamat" type="text" placeholder="Alamat" required="">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="pekerjaan">Pekerjaan</label>
                                <input disabled name="pekerjaan" class="form-control" id="pekerjaan" type="text" placeholder="Pekerjaan" required="">
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label for="petugas_id">{{ __('Petugas') }}<span class="text-danger">*</span></label>
                                    <select name="petugas_id" id="petugas_id" class="form-control select2"></select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                        </div>
                        <button class="btn btn-primary" type="submit">Hitung</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
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
    </style>
@endpush
@push('script')
    <script src="{{ asset('app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
    <script>
        const CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        $(document).ready(function() {
            $("#petugas_id").select2({
                placeholder: "-- Pilih Petugas --",
                ajax: {
                    url: '{{ route('api.select2.kontak.petugas') }}',
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

            $("#nasabah_id").select2({
                placeholder: "-- Pilih Nasabah --",
                ajax: {
                    url: '{{ route('api.select2.kontak.nasabah') }}',
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

            $('#nasabah_id').on('select2:select', function (e) {
                const data = e.params.data;

                $('#nama').val(data.nama)
                $('#alamat').val(data.alamat)
                $('#pekerjaan').val(data.pekerjaan)
            })
        })
    </script>
@endpush
