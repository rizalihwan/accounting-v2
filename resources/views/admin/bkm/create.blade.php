@extends('_layouts.main')
@section('title', 'Buku Kas Masuk')
@section('content')
@push('breadcrumb')
    <li class="breadcrumb-item active">Cash & Bank</li>
    <li class="breadcrumb-item active">Income</li>
    <li class="breadcrumb-item active">Create</li>
@endpush
<div class="container-fluid">
    <div class="row">
        <!-- end message area-->
        <div class="col-md-12">
            <form action="{{route('admin.bkm.store')}}" method="POST" class="invoice-repeater">
                @csrf
                <div class="card mb-2 ">
                    <div class="card-header">
                        <h4>Create Income</h4>
                    </div>
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
                                                <label for="matauang">Mata Uang</label>
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
@endsection
