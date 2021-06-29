@extends('_layouts.main')
<<<<<<< HEAD
@section('title', 'Pemesanan')
@push('breadcrumb')
<li class="breadcrumb-item">
    <a href="{{ route('admin.purchase') }}">Pembelian</a>
</li>
<li class="breadcrumb-item active">
    <a href="{{ route('admin.pesanan.index') }}">Pesanan</a>
</li>
<li class="breadcrumb-item active" aria-current="page">Create</li>
@endpush
@section('content')
<div class="row">
    <!-- end message area-->
    <div class="col-md-12">
        <form action="{{ route('admin.pesanan.store') }}" method="POST" class="invoice-repeater">
            @csrf
            <div class="card">
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
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-11 col-sm-12">
                                <div data-repeater-list="invoice">
                                    <div data-repeater-item>
                                        <div class="row d-flex align-items-end">
                                            <div class="col-md-4 ">
                                                <div class="form-group">
                                                    <label for="Barang">Pilih Barang</label>
                                                    <select name="Barang" id="Barang" class="form-control">

                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-2" id="app">
                                                <div class="form-group">
                                                    <label for="jumlah">Jumlah</label>
                                                    <input type="number" class="form-control jumlah" oninput="HowAboutIt()" placeholder="1" name="jumlah" />

                                                </div>
                                            </div>

                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="Ukur">Satuan Ukur</label>
                                                    <input type="text" class="form-control" id="Ukur" name="Ukur" />
                                                </div>
                                            </div>

                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="Satuan">Harga Satuan</label>
                                                    <select name="Satuan" id="Satuan" class="form-control">
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
=======
@section('title', 'Buku Kas Keluar')
@push('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('admin.cash-bank') }}">Cash & Bank</a>
    </li>
    <li class="breadcrumb-item active">
        <a href="{{ route('admin.bkk.index') }}">Expanse</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">Create</li>
@endpush
@section('content')
        <div class="row">
          <!-- end message area-->
          <div class="col-md-12">
              <form action="{{route('admin.bkk.store')}}" method="POST" class="invoice-repeater">
                  @csrf
                  <div class="card mb-2 ">
                      <div class="card-header">
                          <h4>Create Expanse</h4>
                      </div>
                      <div class="card-body ml-4">
                          <div class="row d-flex align-items-end">
                              <div class="col-md-4 col-12 ">
                                  <div class="form-group">
                                      <label for="itemname">Tanggal</label>
                                      <input type="date" class="form-control" name="tanggal" required/>
                                  </div>
                              </div>
                              <div class="col-md-3 col-12 ml-auto mr-4">
                                  <div class="form-group">
                                      <label for="id">No Jurnal</label>
                                      <input type="text" class="form-control" value="{{$kode}}"  disabled />
                                  </div>
                              </div>
                          </div>
                          <div class="row d-flex align-items-end">
                              <div class="col-md-4 col-12 ">
                                  <div class="form-group">
                                      <label for="kontak">Sudah Bayar Ke</label>
                                      <select name="kontak" id="kontak" class="form-control">
                                        <option value="">Pilih Kontak</option>
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
                                        @if (!empty($item->subklasifikasi->name))
                                        <option value="{{$item->id}}">{{ $item->name }}-{{$item->subklasifikasi->name}}</option>
                                        @endif
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
                                                    @foreach ($rekenings as $item)
                                                    <option value="{{$item->id}}">{{ $item->name }}-{{$item->subklasifikasi->name}}</option>
                                                    
                                                    @endforeach
                                                  </select>
                                              </div>
                                          </div>

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
                                              </div>
                                          </div>

                                          <div class="col-md-2 col-12">
                                              <div class="form-group">
                                                  <label for="matauang">uang</label>
                                                  <select name="matauang" id="matauang" class="form-control">
                                                    <option value="RP">RP</option>
                                                    <option value="USD">USD</option>
                                                  </select>
                                              </div>
                                          </div>

                                          <div class="col-md-2 col-12">
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
                              <div class="row ">
                                  <div class="col-8">
                                      <button class="btn btn-outline-primary" id="button" type="button" data-repeater-create>
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
      function HowAboutIt()
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
>>>>>>> 6eeebd1cec9f9891291efacea7801061a6a2d6ed
@endsection
