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
    <div class="row">
        <div class="col-sm-12">
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible" role="alert" onload="focus()">
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
            <div class="card">
                <div class="card-header">
                    <h5>Tambah Pinjaman</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.pinjam.detail') }}" class="needs-validation" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="besar_pinjam">Jumlah Pinjaman <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Rp</span>
                                        </div>
                                        <input name="besar_pinjam" class="form-control" id="besar_pinjam" type="text" value="{{ old('besar_pinjam') }}"
                                            onkeypress="onlyNumber(event)" placeholder="Jumlah Pinjaman">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group">
                                    <label for="janga">Lama Angsuran (Bulan) <span class="text-danger">*</span></label>
                                    <input name="jangka" class="form-control" id="janga" type="number" value="{{ old('jangka') }}"
                                        onkeypress="onlyNumber(event)" placeholder="Lama Angsuran (Bulan)">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group">
                                    <label for="bunga">Bunga <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text" id="inputGroupPrepend">%</span></div>
                                        <input name="bunga" class="form-control" id="bunga" type="number" value="{{ old('bunga') }}"
                                            onkeypress="onlyNumber(event)" placeholder="Bunga" aria-describedby="inputGroupPrepend">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="tipe_pinjaman">{{ __('Tipe Pinjaman') }}<span class="text-danger">*</span></label>
                                    <select name="tipe_pinjaman" id="tipe_pinjaman" class="form-control select2">
                                        <option value="" disabled selected>-- Tipe Pinjaman --</option>
                                        <option value="Anuitas" {{ old('tipe_pinjaman') == 'Anuitas' ? 'selected' : '' }}>Anuitas</option>
                                        <option value="Flat" {{ old('tipe_pinjaman') == 'Flat' ? 'selected' : '' }}>Flat</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-8">
                                <div class="form-group">
                                    <label for="keterangan">Keterangan <span class="text-danger">*</span></label>
                                    <textarea name="keterangan" id="keterangan" class="form-control">{{ old('keterangan') }}</textarea>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="nasabah_id">{{ __('Nomor Anggota') }}<span class="text-danger">*</span></label>
                                    <select name="nasabah_id" id="nasabah_id" class="form-control select2"></select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input disabled name="nama" class="form-control" id="nama" type="text" placeholder="Nama">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <input disabled name="alamat" class="form-control" id="alamat" type="text" placeholder="Alamat">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="pekerjaan">Pekerjaan</label>
                                    <input disabled name="pekerjaan" class="form-control" id="pekerjaan" type="text" placeholder="Pekerjaan">
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="petugas_id">{{ __('Petugas') }}<span class="text-danger">*</span></label>
                                    <select name="petugas_id" id="petugas_id" class="form-control select2"></select>
                                </div>
                            </div>
                        </div>

                        <hr>
                        <button class="btn btn-primary" type="submit">Hitung</button>
                    </form>
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
            $("#besar_pinjam").on('keyup', function() {
                let val = $(this).val();
                val = val == '' ? 0 : unformatter(val);
                $(this).val(formatter(parseInt(val, 10)));
            });

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

                $('#nama').val(data.nama ?? '-')
                $('#alamat').val(data.alamat ?? '-')
                $('#pekerjaan').val(data.pekerjaan ?? '-')
            })

            $('#nasabah_id').on('select2:unselect', function () {
                $('#nama').val(null)
                $('#alamat').val(null)
                $('#pekerjaan').val(null)
            })

            @if (old('nasabah_id'))
            $.ajax({
                url: '{{ route('api.select2.kontak.selected', ':id') }}'.replace(':id', '{{ old("nasabah_id") }}'),
                type: 'post',
                data: {
                    _token: CSRF_TOKEN
                },
            }).then((data) => {
                let option = new Option(data.text, data.id, true, true)
                $('#nasabah_id').append(option).trigger('change')
                $('#nasabah_id').trigger({
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

            @if (old('petugas_id'))
            $.ajax({
                url: '{{ route('api.select2.kontak.selected', ':id') }}'.replace(':id', '{{ old("petugas_id") }}'),
                type: 'post',
                data: {
                    _token: CSRF_TOKEN
                },
            }).then((data) => {
                let option = new Option(data.text, data.id, true, true)
                $('#petugas_id').append(option).trigger('change')
                $('#petugas_id').trigger({
                    type: 'select2:select',
                    params: {
                        data: data
                    }
                })
            })
            @endif
        })
    </script>
@endpush
