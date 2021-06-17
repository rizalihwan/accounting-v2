@extends('_layouts.main')
@section('title', 'Buku Kas Masuk')
@push('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('admin.cash-bank') }}">Cash & Bank</a>
    </li>
    <li class="breadcrumb-item active">
        <a href="{{ route('admin.bkk.index') }}">Income</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">Edit</li>
@endpush
@section('content')
    <div class="row">
      <!-- end message area-->
      <div class="col-md-12">
          <form action="{{ route('admin.bkm.update', $datas->id) }}" method="POST" class="invoice-repeater">
              @csrf
              @method('put')
              <div class="card mb-2 ">
                  <div class="card-header">
                      <h4>Edit Expanse</h4>
                  </div>
                  <div class="card-body ml-4">
                      <div class="row d-flex align-items-end">
                          <div class="col-md-4 col-12 ">
                              <div class="form-group">
                                  <label for="itemname">Tanggal</label>
                                  <input type="date" class="form-control" name="tanggal" value="{{$datas->tanggal}}" required/>
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
                                    <option value="{{$datas->kontak_id}}">{{$datas->kontaks->nama}}</option>
                                      @foreach ($kontak as $item)
                                      <option value="{{$item->id}}">{{$item->nama}}</option>
                                      @endforeach
                                  </select>
                              </div>
                          </div>
                          <div class="col-md-11 col-12 ">
                              <div class="form-group">
                                  <label for="desk">Untuk Pembayaran</label>
                                  <input type="text" class="form-control" name="desk" placeholder="Deskripsi keterangan" value="{{$datas->desk}}" required/>
                              </div>
                          </div>
                          <div class="col-md-4 col-12 ">
                              <div class="form-group">
                                  <label for="kontak">Rek.Kas/Bank[K]</label>
                                  <select name="rek" id="rek" class="form-control">
                                    <option value="{{$datas->rekening_id}}">{{$datas->akuns->name}}-{{$datas->akuns->subklasifikasi->name}}</option>
                                      @foreach ($rekening as $item)
                                      <option value="{{$item->id}}">{{$item->name}}-{{$item->subklasifikasi->name}}</option>
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
                              @foreach ($datas->uraians as $data)
                              <div data-repeater-item>
                                  <div class="row d-flex align-items-end">
                                      <div class="col-md-4 col-12 ">
                                          <div class="form-group">
                                              <label for="itemname">no rek</label>
                                              <select name="rekening" id="rekening" class="form-control">
                                                <option value="{{$data->rekening_id}}">{{$data->rekening->name}}-{{$data->rekening->subklasifikasi->name}}</option>
                                                  @foreach ($rekening as $item)
                                                  <option value="{{$item->id}}">{{$item->name}}-{{$item->subklasifikasi->name}}</option>
                                                  @endforeach
                                              </select>
                                          </div>
                                      </div>

                                      <div class="col-md-2 col-12" id="app">
                                        <div class="form-group">
                                            <label for="jumlah">Jumlah uang</label>
                                            <input type="number" class="form-control jumlah" oninput="HowAboutIt()" placeholder="1" name="jumlah" value="{{$data->jml_uang}}" required/>
                                        </div>
                                    </div>

                                      <div class="col-md-2 col-12">
                                          <div class="form-group">
                                              <label for="catatan">catatan</label>
                                              <input type="text" class="form-control" id="catatan" name="catatan" value="{{$data->catatan}}"/>
                                          </div>
                                      </div>

                                      <div class="col-md-2 col-12">
                                          <div class="form-group">
                                              <label for="matauang">uang</label>
                                              <select name="matauang" id="matauang" class="form-control">
                                                <option value="RP">{{$data->uang}}</option>
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
                              @endforeach
                          </div>
                          <div class="row ">
                              <div class="col-8">
                                  <button class="btn btn-outline-primary" id="button" type="button" data-repeater-create>
                                      <i class="ik ik-plus"></i>
                                      <span>Add New</span>
                                  </button>
                                  <button type="submit ml-auto" class="btn btn-outline-primary">
                                      Update</button>
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
@endsection
