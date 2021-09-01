@extends('_layouts.main')
@section('title', 'Pinjam')
@push('breadcrumb')
<li class="breadcrumb-item">
    <a href="{{ route('admin.simpanpinjam') }}">Simpan & Pinjam</a>
</li>
<li class="breadcrumb-item">
    <a href="{{ route('admin.pinjam.index') }}">Pinjam</a>
</li>
<li class="breadcrumb-item">
    <a href="{{ route('admin.pinjam.create') }}">Tambah Pinjaman</a>
</li>
<li class="breadcrumb-item" aria-current="page">Detail</li>
@endpush
@section('content')
<div class="row">
    <!-- end message area-->
    <form action="{{ route('admin.pinjam.store') }}" method="post">
        @csrf
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex">
                        <h4 class="card-title">Tipe Pinjaman</h4>
                        <h4><span class="text-primary ml-1">{{ $tipe }}</span></h4>
                        <input type="hidden" name="tipe" value="{{ $tipe }}">
                    </div>
                    <button href="{{ route('admin.pinjam.store') }}" class="btn btn-primary">
                        <i data-feather='save'></i>
                        Simpan
                    </button>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Jumlah Pinjaman</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp</span>
                                    </div>
                                    <input type="text" class="form-control" name="besar_pinjman" value="{{ number_format($besar_pinjam) }}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Jangka</label>
                                <input type="text" name="jangka" class="form-control" name="jangka" value="{{ $jangka }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Bunga</label>
                                <input type="text" name="bungapersen" class="form-control" name="bunga" value="{{ $bunga }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="validationCustomUsername">Keterangan</label>
                            <textarea name="keterangan" class="form-control" required="" readonly>{{ $keterangan }}</textarea>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <label for="nasabah_id">Nasabah</label>
                            <select name="nasabah_id" id="nasabah_id" class="form-control" readonly></select>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <label for="petugas_id">Petugas</label>
                            <select name="petugas_id" id="petugas_id" class="form-control" readonly></select>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Total Bunga</label>
                                <input type="text" name="bunga" class="form-control" name="total_bunga" value="{{ array_sum($resource['bunga']) }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Total Pokok</label>
                                <input type="text" name="pokok" class="form-control" name="total_pokok" value="{{ array_sum($resource['pokok']) }}" readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 1px">#</th>
                                    <th>pokok</th>
                                    <th>bunga</th>
                                    <th>besar_angsuran</th>
                                    <th>pinjaman</th>
                                </tr>
                            </thead>
                            @php
                            $no = 0;
                            @endphp
                            <tbody>
                                @forelse ($resource['bunga'] as $key => $value)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>Rp. {{number_format(round($resource['pokok'][$key]))}}</td>
                                    <td>Rp. {{number_format(round($resource['bunga'][$key]))}}</td>
                                    <td>Rp. {{number_format($besar_angsuran, 0,',','.') }}</td>
                                    <td>Rp. {{number_format(round($resource['pinjaman'][$key]))}}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" align="center">Data kosong.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <hr style="margin-top: -1px">
                    </div>
                    {{-- {{ $data->links('pagination::bootstrap-4') }} --}}
                </div>
            </div>
        </div>

    </form>
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
    <script src="{{ asset('js/helpers.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
    <script>
        const CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        $(document).ready(function () {
            $.ajax({
                url: '{{ route('api.select2.kontak.selected', ':id') }}'.replace(':id', '{{ $nasabah_id }}'),
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
            })
            $.ajax({
                url: '{{ route('api.select2.kontak.selected', ':id') }}'.replace(':id', '{{ $petugas_id }}'),
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
        })
    </script>
@endpush
