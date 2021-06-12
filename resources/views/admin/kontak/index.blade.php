@extends('_layouts.main')
@section('title', 'Contact Data')
    @push('breadcrumb')
        <li class="breadcrumb-item active">Contact Data</li>
    @endpush
@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- end message area-->
            <div class="col-md-12">
                <div class="card p-3">
                    <div class="card-header justify-content-between d-flex mb-2">
                        <div>
                            <h4><strong>Contact Data</strong></h4>
                            <h4 class="text-secondary">&middot; {{ $countkontak }}</h4>
                        </div>
                        <div>
                            <a href="{{ route('admin.kontak.create') }}" class="btn btn-success">Create New</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-light table-hover">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Kode</th>
                                        <th>Email</th>
                                        <th>Tipe</th>
                                        <th>Website</th>
                                        <th>Telepon</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kontak as $key)
                                        <tr>
                                            <td>{{ $key->nama }}</td>
                                            <td><a href="{{ route('admin.kontak.show', $key->id) }}"
                                                    class="modal-show-detail"
                                                    style="color: blue;">{{ $key->kode_kontak }}</a></td>
                                            <td>
                                                @if (!$key->email)
                                                    <span class="badge badge-light badge-pill" style="color: #000000">
                                                        <strong style="text-align: center"> - </strong>
                                                    </span>
                                                @else
                                                    {{ $key->email }}
                                            </td>
                                    @endif
                                    <td>
                                        {{ $key->pelanggan ? 'Pelanggan' . ($key->pemasok == true || $key->karyawan == true ? ', ' : '') : '' }}
                                        {{ $key->pemasok ? 'Pemasok' . ($key->pelanggan == true || $key->karyawan == true ? ', ' : '') : '' }}
                                        {{ $key->karyawan ? 'Karyawan' . ($key->pelanggan == true || $key->pemasok == true ? ', ' : '') : '' }}
                                    </td>
                                    <td>
                                        @if (!$key->website)
                                            <span class="badge badge-light badge-pill" style="color: #000000">
                                                <strong style="text-align: center"> - </strong>
                                            </span>
                                        @else
                                            {{ $key->website }}
                                        @endif
                                    </td>
                                    <td>
                                        @if (!$key->telepon)
                                            <span class="badge badge-light badge-pill" style="color: #000000">
                                                <strong style="text-align: center"> - </strong>
                                            </span>
                                        @else
                                            {{ $key->telepon }}
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.kontak.edit', $key->id) }}" class="btn btn-flat-info"
                                            style="margin-bottom: 4px;"><i class="fa fa-edit"></i> Edit</a>
                                        <form action="{{ route('admin.kontak.destroy', $key->id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="button delete-confirm btn btn-flat-danger"><i
                                                    class="fa fa-trash"></i> Delete</button>
                                        </form>
                                    </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- detail modal kontak --}}
    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" id="modal-header">
                    <h5 class="modal-title" id="modal-title"><i class="fa fa-search"></i> Detail Kontak</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body my-2" id="modal-body">

                </div>
            </div>
        </div>
    </div>
    {{-- end modal --}}
@endsection
@push('script')
    <script>
        $('body').on('click', '.modal-show-detail', function() {
            event.preventDefault();
            let me = $(this),
                url = me.attr('href'),
                title = me.attr('title');
            $('#modal-title').text(title);
            $.ajax({
                url: url,
                dataType: 'html',
                success: function(response) {
                    $('#modal-body').html(response);
                }
            });
            $('#modal').modal('show');
        });

    </script>
@endpush
