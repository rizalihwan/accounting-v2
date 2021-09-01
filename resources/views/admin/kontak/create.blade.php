@extends('_layouts.main')
@section('title', 'Tambah Kontak')
@push('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('admin.data-store') }}">Data Master</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('admin.kontak.index') }}">Kontak</a>
    </li>
    <li class="breadcrumb-item" aria-current="page">Buat Kontak</li>
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
            <div class="card ">
                <div class="card-header">
                    <h4>Tambah Kontak</h4>
                    <h3><i data-feather="user"></i></h3>
                </div>
                <div class="card-body">
                    <form class="forms-sample" method="POST" action="{{ route('admin.kontak.store') }}">
                        @csrf
                        <p><strong>Umum</strong></p>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="nama">{{ __('Nama') }}<span class="text-red">*</span></label>
                                    <input id="nama" type="text" value="{{ old('nama') }}"
                                        class="form-control @error('nama') is-invalid @enderror" name="nama">
                                    <div class="help-block with-errors"></div>
                                    @error('nama')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="email">{{ __('Email') }}<span class="text-red">*</span></label>
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email">
                                    <div class="help-block with-errors"></div>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="telepon">Telepon<span class="text-red">*</span></label>
                                    <input id="telepon" type="text"
                                        class="form-control @error('telepon') is-invalid @enderror" name="telepon"
                                        minlength="11" maxlength="13" onkeypress="onlyNumber(event)">
                                    <div class="help-block with-errors"></div>
                                    @error('telepon')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="demo-inline-spacing">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="pelanggan" name="pelanggan" {{ old('pelanggan') ? 'checked' :'' }} />
                                            <label class="custom-control-label" for="pelanggan">Pelanggan</label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="pemasok" name="pemasok" {{ old('pemasok') ? 'checked' :'' }} />
                                            <label class="custom-control-label" for="pemasok">Pemasok</label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="karyawan" name="karyawan" {{ old('karyawan') ? 'checked' :'' }} />
                                            <label class="custom-control-label" for="karyawan">Karyawan</label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="nasabah" name="nasabah" {{ old('nasabah') ? 'checked' :'' }} />
                                            <label class="custom-control-label" for="nasabah">Nasabah</label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="petugas" name="petugas" {{ old('petugas') ? 'checked' :'' }} />
                                            <label class="custom-control-label" for="petugas">Petugas</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <p><strong>Alamat</strong></p>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="alamat">alamat</label>
                                    <textarea name="alamat" id="alamat"
                                        class="form-control @error('alamat') is-invalid @enderror"></textarea>
                                    <div class="help-block with-errors"></div>
                                    @error('alamat')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="kota">kota</label>
                                    <input id="kota" type="text"
                                        class="form-control @error('kota') is-invalid @enderror" name="kota">
                                    <div class="help-block with-errors"></div>
                                    @error('kota')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="kode_pos">kode pos</label>
                                    <input id="kode_pos" type="text"
                                        class="form-control @error('kode_pos') is-invalid @enderror" name="kode_pos">
                                    <div class="help-block with-errors"></div>
                                    @error('kode_pos')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <hr>
                        <p><strong>Data Lainnya</strong></p>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="kode_kontak">Kode Kontak</label>
                                    <input id="kode_kontak" type="text" value="{{ old('kode_kontak') }}"
                                        class="form-control @error('kode_kontak') is-invalid @enderror" name="kode_kontak">
                                    <div class="help-block with-errors"></div>
                                    @error('kode_kontak')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="mata_uang">{{ __('Mata Uang') }}</label>
                                    <select name="mata_uang" id="mata_uang"
                                        class="form-control @error('mata_uang') is-invalid @enderror">
                                        <option value="IDR">IDR</option>
                                    </select>
                                    <div class="help-block with-errors"></div>
                                    @error('mata_uang')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="nik">NIK</label>
                                    <input id="nik" type="text"
                                        class="form-control @error('nik') is-invalid @enderror" name="nik"
                                        onkeypress="onlyNumber(event)" minlength="16" maxlength="16">
                                    <div class="help-block with-errors"></div>
                                    @error('nik')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="kontak_person">Kontak Person</label>
                                    <input id="kontak_person" type="text"
                                        class="form-control @error('kontak_person') is-invalid @enderror" name="kontak_person">
                                    <div class="help-block with-errors"></div>
                                    @error('kontak_person')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="website">Website</label>
                                    <input id="website" type="text"
                                        class="form-control @error('website') is-invalid @enderror" name="website">
                                    <div class="help-block with-errors"></div>
                                    @error('website')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-12 mt-1">
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="aktif" name="aktif" checked />
                                        <label class="custom-control-label" for="aktif">Aktif</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr>
                        <a href="{{ route('admin.kontak.index') }}" class="btn btn-danger">KEMBALI</a>
                        <button type="submit" class="btn btn-primary">TAMBAH</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="{{ asset('js/helpers.js') }}"></script>
    <script>
        $(document).ready(function(){
            let csrf = '{{ csrf_token() }}'

            let inputNama = document.getElementById('nama')
            inputNama.addEventListener('input', function(e){
                let nama = this.value
                $.ajax({
                    url: '{{ route('admin.kontak.kode') }}',
                    type: 'post',
                    data: {
                        _token: csrf,
                        nama: nama
                    },
                    success: data => {
                        $("#kode_kontak").val(data.success)
                    },
                })
            })
        })
    </script>
@endpush
