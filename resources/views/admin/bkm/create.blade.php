@extends('_layouts.main')
@section('title', 'Buku Kas Masuk')
@section('content')
<div class="container-fluid">
    <div class="page-header">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="ik ik-book bg-blue"></i>
                    <div class="d-inline">
                        <h5>Buku Kas Masuk</h5>
                        <span>List Buku Kas Masuk (BKM)</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
<<<<<<< HEAD
                <nav class  ="breadcrumb-container" aria-label="breadcrumb">
=======
                <nav class="breadcrumb-container" aria-label="breadcrumb">
>>>>>>> 75afbf73aeb7124941b068c6c8bd76134f9527e8
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}"><i class="ik ik-home"></i></a>
                        </li>
                        <li class="breadcrumb-item">
<<<<<<< HEAD
                            <a href="{{ route('admin.bukubesar.index') }}">Buku Besar</a>
=======
                            <a href="{{ route('admin.bkm.index') }}">Kas Masuk</a>
>>>>>>> 75afbf73aeb7124941b068c6c8bd76134f9527e8
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="row">
        <!-- end message area-->
        <div class="col-md-12">
<<<<<<< HEAD
            <form action="{{route('admin.bkk.store')}}" method="POST" class="invoice-repeater">
=======
            <form action="{{route('admin.bkm.store')}}" method="POST" class="invoice-repeater">
>>>>>>> 75afbf73aeb7124941b068c6c8bd76134f9527e8
                @csrf
                <div class="card mb-2 ">
                    <div class="card-body ml-4">
                        <div class="row d-flex align-items-end">
                            <div class="col-md-4 col-12 ">
                                <div class="form-group">
                                    <label for="itemname">Tanggal</label>
                                    <input type="date" class="form-control" name="tanggal" />
                                </div>
                            </div>
                            <div class="col-md-3 col-12 ml-auto mr-4">
                                <div class="form-group">
                                    <label for="id">No Jurnal</label>
                                    <input type="text" class="form-control" placeholder="auto number" disabled />
                                </div>
                            </div>
                        </div>
                        <div class="row d-flex align-items-end">
                            <div class="col-md-4 col-12 ">
                                <div class="form-group">
                                    <label for="kontak">Sudah Bayar Ke</label>
                                    <select name="kontak" id="kontak" class="form-control">
                                        @foreach ($kontak as $item)
                                        <option value="{{$item->id}}">{{$item->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-11 col-12 ">
                                <div class="form-group">
                                    <label for="desk">Untuk Pembayaran</label>
                                    <input type="text" class="form-control" name="desk" placeholder="Deskripsi keterangan" />
                                </div>
                            </div>
                            <div class="col-md-4 col-12 ">
                                <div class="form-group">
                                    <label for="kontak">Rek.Kas/Bank[K]</label>
                                    <select name="rek" id="rek" class="form-control">
                                        @foreach ($rekening as $item)
                                        <option value="{{$item->id}}">{{$item->nomor}}-{{$item->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card p-3">
                    <div class="card-body mt-0">
                        <hr>
                        <div class="col-12 ">
                            <div data-repeater-list="invoice">
                                <div data-repeater-item>
                                    <div class="row d-flex align-items-end">
                                        <div class="col-md-4 col-12 ">
                                            <div class="form-group">
                                                <label for="itemname">no rek</label>
                                                <select name="rekening" id="rekening" class="form-control">
                                                    @foreach ($rekening as $item)
                                                    <option value="{{$item->id}}">{{$item->nomor}}-{{$item->nama}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

<<<<<<< HEAD
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="itemcost">Nama Rekening</label>
                                                <input type="text" class="form-control" placeholder="32" name="cost" />
                                            </div>
                                        </div>

                                        <div class="col-md-4 col-12" id="app">
                                            <div class="form-group">
                                                <label for="jumlah">Jumlah uang</label>
                                                <input type="number" class="form-control jumlah" oninput="HowAboutIt()" placeholder="1" name="jumlah" />

                                            </div>
                                        </div>
                                        <div class="col-md-2 col-12">
                                            <div class="form-group">
                                                <label for="catatan">catatan</label>
                                                <input type="text" class="form-control" id="catatan" name="catatan" />
                                            </div>
                                        </div>

                                        <div class="col-md-2 col-12">
                                            <div class="form-group">
                                                <label for="matauang">uang</label>
                                                <input type="text" class="form-control" id="matauang" placeholder="1" name="matauang" />
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="kurs">kurs</label>
                                                <input type="text" class="form-control" id="kurs" name="kurs" />
=======
                                        <div class="col-md-2 col-12" id="app">
                                          <div class="form-group">
                                              <label for="jumlah">Jumlah uang</label>
                                              <input type="number" class="form-control jumlah" oninput="HowAboutIt()" placeholder="1" name="jumlah" />

                                          </div>   
                                      </div>

                                        <div class="col-md-2 col-12">
                                            <div class="form-group">
                                                <label for="catatan">catatan</label>
                                                <input type="text" class="form-control" id="catatan" name="catatan" />
>>>>>>> 75afbf73aeb7124941b068c6c8bd76134f9527e8
                                            </div>
                                        </div>

                                        <div class="col-md-2 col-12">
                                            <div class="form-group">
<<<<<<< HEAD
                                                <label for="vales">vales</label>
                                                <input type="text" class="form-control" id="vales" name="vales" />
=======
                                                <label for="matauang">Mata Uang</label>
                                                <select name="matauang" id="matauang" class="form-control">
                                                  <option value="RP">RP</option>
                                                  <option value="USD">USD</option>
                                                </select>
>>>>>>> 75afbf73aeb7124941b068c6c8bd76134f9527e8
                                            </div>
                                        </div>

                                        <div class="col-md-2 col-12">
                                            <div class="form-group">
<<<<<<< HEAD
                                                <button class="btn btn-outline-danger " onclick="AndWithThis()" data-repeater-delete type="button">
=======
                                                <button class="btn btn-outline-danger " onclick="calculate(event)" data-repeater-delete type="button">
>>>>>>> 75afbf73aeb7124941b068c6c8bd76134f9527e8
                                                    <i class="fa fa-times"></i>
                                                    <span>Delete</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <hr />
                                </div>
                            </div>
                            <div class="row ">
                                <div class="col-8">
<<<<<<< HEAD
                                    <button class="btn btn-outline-primary" type="button" data-repeater-create>
=======
                                    <button class="btn btn-outline-primary" id="button" type="button" data-repeater-create>
>>>>>>> 75afbf73aeb7124941b068c6c8bd76134f9527e8
                                        <i class="ik ik-plus"></i>
                                        <span>Add New</span>
                                    </button>
                                    <button type="submit ml-auto" class="btn btn-outline-primary">
                                        Simpan</button>
                                </div>
                                <div class="d-flex">
<<<<<<< HEAD
                                    <input type="number" value="0" class="form-control" id="total">
=======
                                    <input type="text" class="form-control" id="total">
>>>>>>> 75afbf73aeb7124941b068c6c8bd76134f9527e8
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
<<<<<<< HEAD
    function HowAboutIt()
=======
  function HowAboutIt()
>>>>>>> 75afbf73aeb7124941b068c6c8bd76134f9527e8
    {
        let total = 0;
        let coll = document.querySelectorAll('.jumlah')
        for(let i = 0;i<coll.length;i++)
        {
            let ele = coll[i]
            total += parseInt(ele.value)
        }
        let res = document.getElementById('total')
        res.value = total
    }
<<<<<<< HEAD

    function AndWithThis()
    {
=======
    document.getElementById('hitung').addEventListener('click', function() {
>>>>>>> 75afbf73aeb7124941b068c6c8bd76134f9527e8
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
<<<<<<< HEAD
    }
</script>
@endsection
=======
    })
</script>
@endsection
>>>>>>> 75afbf73aeb7124941b068c6c8bd76134f9527e8
