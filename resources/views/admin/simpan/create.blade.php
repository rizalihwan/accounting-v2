@extends('_layouts.main')
@section('title', 'Tambah Data Simpan')
@push('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('admin.simpanpinjam') }}">Simpan & Pinjam</a>
    </li>
    <li class="breadcrumb-item"><a href="{{ route('admin.simpan.index') }}">Simpan</a></li>
    <li class="breadcrumb-item" aria-current="page">Tambah Simpanan</li>
@endpush
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>Tambah Simpanan</h5>
                    @if ($errors->any())
                        <div class="alert alert-danger alert-validation-msg" role="alert">
                            <div class="alert-body">
                                @foreach ($errors->all() as $error)
                                <ul style="margin: 5px 12px 0 -11px">
                                    <li>{{ $error }}</li>
                                </ul>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.simpan.store') }}" class="needs-validation" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="jenis_simpanan">Jenis Simpanan</label>
                                    <input name="jenis_simpanan" class="form-control" id="jenis_simpanan" type="text"
                                        placeholder="Jenis Simpanan">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="no_rekening">No Rekening</label>
                                    <input name="no_rekening" class="form-control" id="no_rekening" type="number"
                                        onkeypress="onlyNumber(event)" placeholder="No Rekening" required="">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="administrasi">Administrasi</label>
                                    <input name="administrasi" class="form-control" id="administrasi" type="number"
                                        onkeypress="onlyNumber(event)" placeholder="Administrasi" required="">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="setoran">Setoran</label>
                                    <input name="setoran" class="form-control" id="setoran" type="number"
                                        onkeypress="onlyNumber(event)" placeholder="Setoran" required="">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="kontak_id">{{ __('Nomor Anggota') }}<span class="text-danger">*</span></label>
                                    <select name="kontak_id" id="kontak_id" class="form-control select2"></select>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input disabled name="nama" class="form-control" id="nama" type="text"
                                        placeholder="Nama">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <input disabled name="alamat" class="form-control" id="alamat" type="text"
                                        placeholder="Alamat">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="pekerjaan">Pekerjaan</label>
                                    <input disabled name="pekerjaan" class="form-control" id="pekerjaan" type="text"
                                        placeholder="Pekerjaan">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="petugas">{{ __('Petugas') }}<span class="text-danger">*</span></label>
                                    <select name="petugas" id="petugas" class="form-control select2"></select>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="keterangan">Keterangan</label>
                                    <textarea name="keterangan" id="keterangan" rows="2" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>

                        <hr>
                        <button class="btn btn-primary mt-3" type="submit">Submit</button>
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
        .select2-selection__clear {
            margin-right: 13px;
        }
    </style>
@endpush
@push('script')
    <script src="{{ asset('js/helpers.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
    <script>
        const CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        $(document).ready(function() {
            $("#petugas").select2({
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
                        let res = [];
                        data.forEach((item) => {
                            res.push({id: item.nama, text: item.text, nama: item.nama});
                        });

                        return {
                            results: res
                        }
                    },
                    cache: true
                },
                allowClear: true
            })

            $("#kontak_id").select2({
                placeholder: "-- Pilih Anggota --",
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

            $('#kontak_id').on('select2:select', function (e) {
                const data = e.params.data;

                $('#nama').val(data.nama ?? '-')
                $('#alamat').val(data.alamat ?? '-')
                $('#pekerjaan').val(data.pekerjaan ?? '-')
            })

            $('#kontak_id').on('select2:unselect', function () {
                $('#nama').val(null)
                $('#alamat').val(null)
                $('#pekerjaan').val(null)
            })

            @if (old('kontak_id'))
            $.ajax({
                url: '{{ route('api.select2.kontak.selected', ':id') }}'.replace(':id', '{{ old("kontak_id") }}'),
                type: 'post',
                data: {
                    _token: CSRF_TOKEN
                },
            }).then((data) => {
                let option = new Option(data.text, data.id, true, true)
                $('#kontak_id').append(option).trigger('change')
                $('#kontak_id').trigger({
                    type: 'select2:select',
                    params: {
                        data: data
                    }
                })

                $('#nama').val(data.nama ?? '-')
                $('#alamat').val(data.alamat ?? '-')
                $('#pekerjaan').val(data.pekerjaan ?? '-')
            })
            @endif
        })
    </script>
@endpush
