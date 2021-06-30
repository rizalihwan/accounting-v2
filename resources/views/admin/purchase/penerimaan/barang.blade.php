@extends('_layouts.main')
@section('title', 'Penerimaan Barang')
@push('breadcrumb')
<li class="breadcrumb-item">
    <a href="{{ route('admin.purchase') }}">Pembelian</a>
</li>
<li class="breadcrumb-item">
    <a href="{{ route('admin.terima.index') }}">Penerimaan Barang</a>
</li>
<li class="breadcrumb-item active" aria-current="page">Barang</li>
@endpush
@section('content')
<div class="row">
    <!-- end message area-->
    <div class="col-md-12">
        <form action="{{ route('admin.terima.store') }}" method="POST" class="invoice-repeater">
            @csrf
            <div class="card">
            <div class="card-header">
                <h3>Permintaan terima Harga Barang</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="Pemasok">Pemasok</label>
                            <select name="pemasok" id="pemasok" class="form-control">
                                @foreach ($pemasok as $item)
                                    <option value="{{$item->id}}">{{$item->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="no_penawaran">Penawaran</label>
                            <select name="no_penawaran" id="no_penawaran" class="form-control">
                                @foreach ($pesanan as $item)
                                <option value="{{$item->id}}">{{$item->id}} - {{$item->pemasok->nama}}</option>
                                @endforeach
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
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div data-repeater-list="invoice">
                                <div data-repeater-item>
                                    <div class="row d-flex align-items-end">
                                        <div class="col-md-3 ">
                                            <div class="form-group">
                                                <label for="produk">Pilih Barang</label>
                                                <select name="produk" id="produk" class="form-control">
                                                    @foreach ($produk as $item)
                                                    <option value="{{$item->id}}">{{$item->name}}</option>
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
                                                <label for="satuan">Satuan Ukur</label>
                                                <input type="number" name="satuan"  class="form-control satuan" value="1">

                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="harga_satuan">Harga Satuan</label>
                                                <input type="number" name="harga_satuan" class="form-control harga_satuan" value="1">

                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="total">Total</label>
                                                <input type="number" name="total" class="form-control total" value="1">

                                            </div>
                                        </div>

                                        <div class="col-md-1">
                                            <div class="form-group">
                                                <button class="btn btn-outline-danger " onclick="calculate(event)" data-repeater-delete type="button">
                                                    <i class="fa fa-trash"></i>
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
    function HowAboutIt() {
        let total = 0;
        let stok = document.querySelectorAll('.stok')
        let coll = document.querySelectorAll('.jumlah')
        for (let i = 0; i < coll.length; i++) {
            let ele = coll[i]
            let olo = stok[i]
            total += parseInt(ele.value) * parseInt(olo.value)
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
