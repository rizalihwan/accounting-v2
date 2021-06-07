@extends('_layouts.main')
@section('title', 'Buku Kas Keluar')
@section('content')
<div class="container-fluid">
    <div class="page-header">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="ik ik-book bg-blue"></i>
                    <div class="d-inline">
                        <h5>Buku Kas Keluar</h5>
                        <span>Form Buku Kas Keluar (BKK)</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <nav class="breadcrumb-container" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}"><i class="ik ik-home"></i></a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.bukubesar.index') }}">Buku Kas Keluar</a>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="row">
        <!-- end message area-->
        <div class="col-md-12">
            <form action="{{route('admin.bkk.store')}}" method="POST" class="invoice-repeater">
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

                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="itemcost">Nama Rekening</label>
                                                <input type="text" class="form-control" placeholder="32" name="cost" />
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="itemquantity">Jumlah uang</label>
                                                <input type="number" value="1" name="jumlah" class="form-control jumlah" placeholder="1" />
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-12">
                                            <div class="form-group">
                                                <label for="staticprice">catatan</label>
                                                <input type="text" class="form-control" id="staticprice" name="catatan" />
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-12">
                                            <div class="form-group">
                                                <label for="itemquantity">uang</label>
                                                <select name="matauang" class="form-control" id="matauang">
                                                    <option value="RP">RP</option>
                                                    <option value="USD">USD</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="staticprice">kurs</label>
                                                <input type="text" class="form-control" id="staticprice" name="kurs" />
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-12">
                                            <div class="form-group">
                                                <label for="staticprice">vales</label>
                                                <input type="text" class="form-control" id="staticprice" name="vales" />
                                            </div>
                                        </div>

                                        <div class="col-md-2 col-12">
                                            <div class="form-group">
                                                <button class="btn btn-outline-danger " data-repeater-delete type="button">
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
                                    <button type="submit ml-auto" class="btn btn-outline-primary">Simpan</button>
                                </div>
                                <div class="col-4">
                                    <input type="number" id="total" readonly class="form-control">
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

</script>
@endsection
