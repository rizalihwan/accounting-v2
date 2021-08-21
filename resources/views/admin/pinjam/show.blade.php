@extends('_layouts.main')
@section('title', 'Pinjam')
@push('breadcrumb')
<li class="breadcrumb-item">
    <a href="{{ route('admin.simpanpinjam') }}">Simpan & Pinjam</a>
</li>
<li class="breadcrumb-item">
    <a href="{{ route('admin.pinjam.index') }}">Pinjam</a>
</li>
<li class="breadcrumb-item" aria-current="page">Detail</li>
@endpush
@section('content')
<div class="row">
    <!-- end message area-->
    <form action="{{ route('admin.pinjam.store') }}" method="post">
        @csrf
        <div class="col-lg-12 col-md-6 col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex">
                        <h4 class="card-title">Tipe Pinjaman</h4>
                        <h4><span class="text-primary ml-1">{{ $tipe }}</span></h4>
                        <input type="hidden" name="tipe" value="{{ $tipe }}">
                    </div>
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
