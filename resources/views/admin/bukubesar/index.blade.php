@extends('_layouts.main')
@section('title', 'Buku Besar')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- end message area-->
            <div class="col-md-12">
                <div class="card p-3">
                    <div class="card-header  d-flex">
                            <button type="submit" class="btn btn-success"><i class="fa fa-search"></i> Cari</button>
                            <div class="d-inline-block">
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#primary">
                                    <i data-feather='list'></i>
                                </button>
                                <!-- Modal -->
                                <div
                                  class="modal fade text-left modal-primary"
                                  id="primary"
                                  tabindex="-1"
                                  role="dialog"
                                  aria-labelledby="myModalLabel160"
                                  aria-hidden="true"
                                >
                                  <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="myModalLabel160">Primary Modal</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <div class="modal-body">
                                        <label for="tanggal" class="mb-1">tanggal</label>
                                        <input type="date" class="form-control col-md-10 mb-1">
                                        <input type="date" class="form-control col-md-10 mb-1">
                                        <form class="needs-validation" novalidate="">
                                            <div class="form-row">
                                              <div class="col-md-4 col-12 mb-3">
                                                <label for="validationTooltip01">First name</label>
                                                <input type="text" class="form-control" id="validationTooltip01" placeholder="First name" value="Mark" required="">
                                                <div class="valid-tooltip">Looks good!</div>
                                              </div>
                                              <div class="col-md-4 col-12 mb-3">
                                                <label for="validationTooltip02">Last name</label>
                                                <input type="text" class="form-control" id="validationTooltip02" placeholder="Last name" value="Otto" required="">
                                                <div class="valid-tooltip">Looks good!</div>
                                              </div>
                                              <div class="col-md-4 col-12 mb-3">
                                                <label for="validationTooltip03">City</label>
                                                <input type="text" class="form-control" id="validationTooltip03" placeholder="City" required="">
                                                <div class="invalid-tooltip">Please provide a valid city.</div>
                                              </div>
                                            </div>
                                            <button class="btn btn-primary waves-effect waves-float waves-light ml-auto" type="submit">Submit</button>
                                          </form>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-light table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Jumlah</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
