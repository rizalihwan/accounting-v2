@extends('_layouts.main')
@section('title', 'Buku Kas Keluar')
@push('breadcrumb')
<li class="breadcrumb-item">
    <a href="{{ route('admin.purchase') }}">Pembelian</a>
</li>
<li class="breadcrumb-item active">
    <a href="{{ route('admin.penawaran.index') }}">Penawaran Harga</a>
</li>
<li class="breadcrumb-item active" aria-current="page">Create</li>
@endpush
@section('content')
<div class="row">
    <!-- end message area-->
    <div class="col-md-12">
        <form action="{{ route('admin.penawaran.store') }}" method="POST" class="invoice-repeater">
            @csrf
            <div class="card">
                <div class="card-header">
                    <h4>Create Expanse</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="Pemasok">Pemasok</label>
                                <select name="Pemasok" id="Pemasok" class="form-control">
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="Tanggal">Tanggal</label>
                                <input type="date" class="form-control" name="tanggal" required />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="Refrensi">No. Refrensi</label>
                                <input type="text" name="Refrensi" class="form-control" disabled />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="Deskripsi">Deskripsi</label>
                                <input type="text" class="form-control" name="Deskripsi" placeholder="Deskripsi keterangan" />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="Gudang">Ke Gudang</label>
                                <select name="Gudang" id="Gudang" class="form-control">
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="Departemen">Departemen</label>
                                <select name="Departemen" id="Departemen" class="form-control">
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="Proyek">Proyek</label>
                                <select name="Proyek" id="Proyek" class="form-control">
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="kontak">Mata Uang</label>
                                <select name="rek" id="rek" class="form-control">
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-11 col-sm-12">
                                <div data-repeater-list="invoice-one">
                                    <div data-repeater-item>
                                        <div class="row d-flex align-items-end">
                                            <div class="col-md-4 ">
                                                <div class="form-group">
                                                    <label for="Barang">Pilih Barang</label>
                                                    <select name="Barang" id="Barang" class="form-control">
                                                        @foreach ($rekenings as $item)
                                                        <option value="{{ $item->id }}">
                                                            {{ $item->name }}-{{ $item->subklasifikasi->name }}
                                                        </option>

                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-2" id="app">
                                                <div class="form-group">
                                                    <label for="jumlah">Jumlah uang</label>
                                                    <input type="number" class="form-control jumlah" oninput="HowAboutIt()" placeholder="1" name="jumlah" />

                                                </div>
                                            </div>

                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="catatan">catatan</label>
                                                    <input type="text" class="form-control" id="catatan" name="catatan" />
                                                </div>
                                            </div>

                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="matauang">uang</label>
                                                    <select name="matauang" id="matauang" class="form-control">
                                                        <option value="RP">RP</option>
                                                        <option value="USD">USD</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <button class="btn btn-outline-danger " onclick="calculate(event)" data-repeater-delete type="button">
                                                        <i class="fa fa-times"></i>
                                                        <span>Delete</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <hr />
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-8">
                                <button class="btn btn-outline-primary" id="button-one" type="button" data-repeater-create="invoice-one">
                                    <i class="ik ik-plus"></i>
                                    <span>Add New</span>
                                </button>
                                <button type="submit ml-auto" class="btn btn-outline-primary">
                                    Simpan</button>
                            </div>
                            <div class="d-flex">
                                <input type="text" class="form-control" id="total">
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    document.querySelector('#stacked-pill-1').addEventListener('click', function() {})
    document.querySelector('#stacked-pill-2').addEventListener('click', function() {})

    function HowAboutIt() {
        let total = 0;
        let coll = document.querySelectorAll('.jumlah')
        for (let i = 0; i < coll.length; i++) {
            let ele = coll[i]
            total += parseInt(ele.value)
        }
        let res = document.getElementById('total')
        res.value = total
    }
    document.getElementById('hitung').addEventListener('click', function() {
        event.preventDefault()
        let total = []
        let nd = document.querySelectorAll('.jumlah')
        for (let i = 0; i < nd.length; i++) {
            total.push(parseInt(nd[i].value))
        }
        console.log(total)
        let sum = total.reduce(function(totalValue, currentValue) {
            return totalValue + currentValue
        })
        console.log(sum)
        document.getElementById('total').value = sum
    })
</script>
@endsection