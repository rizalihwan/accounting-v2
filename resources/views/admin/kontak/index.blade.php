@extends('_layouts.main')
@section('title', 'Kontak')
@push('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('admin.data-store') }}">Data Master</a>
    </li>
    <li class="breadcrumb-item" aria-current="page">Kontak</li>
@endpush
@section('content')
    <div class="row">
        <!-- end message area-->
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex">
                        <h4 class="card-title">List Kontak</h4>
                        <h4><span class="text-muted ml-1">{{ $countkontak }}</span></h4>
                    </div>
                    <a href="{{ route('admin.kontak.create') }}" class="btn btn-success">
                        <i data-feather="plus"></i>
                        Buat Baru
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" style="height: {{ $countkontak == 1 ? '100px' : '' }}">
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
                                @forelse ($kontak as $key)
                                    <tr>
                                        <td>{{ $key->nama }}</td>
                                        <td>
                                            <a href="{{ route('admin.kontak.show', $key->id) }}"
                                                class="modal-show-detail"
                                                style="color: blue;">{{ $key->kode_kontak }}
                                            </a>
                                        </td>
                                        <td>
                                            @if (!$key->email)
                                                <span class="badge badge-light badge-pill" style="color: #000000">
                                                    <strong style="text-align: center"> - </strong>
                                                </span>
                                            @else
                                                {{ $key->email }}
                                            @endif
                                        </td>
                                        <td class="tipe">
                                            {{ $key->pelanggan ? 'Pelanggan' . ($key->pemasok == true || $key->karyawan == true || $key->nasabah == true || $key->petugas == true ? ', ' : '') : '' }}
                                            {{ $key->pemasok ? 'Pemasok' . ($key->pelanggan == true || $key->karyawan == true || $key->nasabah == true || $key->petugas == true ? ', ' : '') : '' }}
                                            {{ $key->karyawan ? 'Karyawan' . ($key->pelanggan == true || $key->pemasok == true || $key->nasabah == true || $key->petugas == true ? ', ' : '') : '' }}
                                            {{ $key->nasabah ? 'Nasabah' . ($key->pelanggan == true || $key->pemasok == true || $key->karyawan == true || $key->petugas == true ? ', ' : '') : '' }}
                                            {{ $key->petugas ? 'Petugas' . ($key->pelanggan == true || $key->pemasok == true || $key->karyawan == true || $key->nasabah == true ? ', ' : '') : '' }}
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
                                            <div class="dropdown">
                                                <button type="button" class="btn btn-sm dropdown-toggle hide-arrow" data-toggle="dropdown">
                                                    <i data-feather="more-vertical"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="{{ route('admin.kontak.edit', $key->id) }}">
                                                        <i data-feather="edit"></i>
                                                        <span class="ml-1">Edit</span>
                                                    </a>
                                                    <a href="javascript:void('delete')" class="dropdown-item text-danger" 
                                                        onclick="deleteConfirm('form-delete', '{{ $key->id }}')">
                                                        <i data-feather="trash"></i>
                                                        <span class="ml-1">Delete</span>
                                                    </a>
                                                    <form id="form-delete{{ $key->id }}" action="{{ route('admin.kontak.destroy', $key->id) }}" method="POST">
                                                        @csrf
                                                        @method('delete')
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" align="center">Data kosong.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- detail modal kontak --}}
    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-backdrop" style="background: rgba(0,0,0,.3); backdrop-filter: blur(1px);">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header" id="modal-header">
                        <h5 class="modal-title" id="modal-title"><i data-feather="search"></i> Detail Kontak</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body my-2" id="modal-body">

                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- end modal --}}
@endsection
@push('script')
    <script>
        function removeLastComma(str){      
            let n = str.lastIndexOf(",");
            if (n < 0) {
                return str;
            }

            let a = str.substring(0, n);
            return a;
        }

        $(document).ready(function() {
            const tipe = document.querySelectorAll('.tipe');
            tipe.forEach((el, i) => {
                el.textContent = removeLastComma(el.textContent.trim());
            });

            $(".close").on('click', function() {
                $("#modal").modal('hide')
            })
            $('body').on('click', '.modal-show-detail', function() {
                event.preventDefault();
                let me = $(this),
                    url = me.attr('href'),
                    title = me.attr('title');
                $('#modal-title').text(title);
                $('#modal').modal('show');
                $("#modal-body").html(`
                    <div class="d-flex justify-content-center">
                        <div class="spinner-border" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                `)

                $.ajax({
                    url: url,
                    dataType: 'html',
                    success: function(response) {
                        $('#modal-body').html(response);
                    },
                    cache: true
                });
            });
        })
    </script>
@endpush
