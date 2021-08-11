@extends('_layouts.main')
@section('title', 'Penawaran Harga')
@push('breadcrumb')
<li class="breadcrumb-item">
    <a href="{{ route('admin.sales.') }}">Penjualan</a>
</li>
<li class="breadcrumb-item">
    <a href="{{ route('admin.sales.pesanan.index') }}">Pesanan</a>
</li>
<li class="breadcrumb-item" aria-current="page">Detail</li>
@endpush
@section('content')

<div class="row">
  <!-- end message area-->
  <div class="col-md-12">
      <div class="card py-2">
          <div class="card-header d-flex justify-content-center">
              @if($pesanan->status == 1)
                <h1 class="card-title">
                    <span class="badge badge-info">Status : Delivered</span>
                </h1>
              @else
                <h1 class="card-title">
                    <span class="badge badge-warning">Status : Open</span>
                </h1>
              @endif
          </div>
          <div class="card-body pt-2">
              <table class="table">
                  <tr>
                      <th class="kode_jurnal">
                          Kode
                          <span class="float-right">:</span>
                      </th>
                      <td>{{ $pesanan->kode  }}</td>
                  </tr>
                  <tr>
                      <th>
                          Tanggal
                          <span class="float-right">:</span>
                      </th>
                      <td>{{ $pesanan->tanggal }}</td>
                  </tr>
              
                  <tr>
                      <th>
                          Pelanggan
                          <span class="float-right">:</span>
                      </th>
                      <td>{{ $pesanan->pelanggan->nama }}</td>
                  </tr>
              </table>
              <div class="table-responsive">
                  <table class="table mt-2">
                      <thead>
                          <tr>
                              <th>Product / Jasa</th>
                              <th>Satuan</th>
                              <th>Harga</th>
                              <th>Jumlah</th>
                              <th>Total</th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach ($pesanan->pesanan_details as $item)
                              <tr>
                                  <td>{{ $item->product->name }}</td>
                                  <td>{{ $item->satuan }}</td>
                                  <td>{{ 'Rp. ' . number_format($item->harga, 0, ',', '.') }}</td>
                                  <td>{{ $item->jumlah }}</td>
                                  <td>{{ 'Rp. ' . number_format($item->total, 0, ',', '.') }}</td>
                              </tr>
                          @endforeach
                      </tbody>
                      <tfoot>
                          <tr>
                              <th></th>
                              <th></th>
                              <th></th>
                              <th></th>
                              <th>
                                {{ 'Rp. ' . number_format($pesanan->total, 0, ',', '.') }}
                              </th>
                          </tr>
                      </tfoot>
                  </table>
              </div>
          </div>
          <div class="card-footer">
            <a class="btn btn-primary" href="{{ route('admin.sales.pesanan.index') }}">
              Kembali</a>
          </div>
      </div>
  </div>
</div>
@endsection
