<div>
    <div class="card-header justify-content-between d-flex">
        <div>
            <a href="{{ route('admin.rekening.create') }}" 
                class="btn btn-primary">
                <i class="fa fa-plus m-auto"></i>
            </a>
            <button type="button" wire:click="$refresh"
                class="btn btn-light ml-2">
                <i class="ik ik-refresh-cw m-auto"></i>
            </button>
        </div>
        <div class="float-right">
            <input type="text" wire:model="search" class="form-control" placeholder="Search">
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th style="width: 1px;">#</th>
                        <th>Nomor</th>
                        <th>Nama</th>
                        <th style="width: 150px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($rekenings as $r)
                    <tr>
                        <td>{{ $loop->iteration + $rekenings->firstItem() - 1 }}</td>
                        <td>{{ $r->nomor }}</td>
                        <td><a href="{{ route('admin.rekening.show',$r->id) }}" style="color: blue;">{{ $r->nama }}</a></td>
                        <td>
                            <a href="{{ route('admin.rekening.edit',$r->id) }}" class="btn btn-info btn-sm mr-1" style="float: left;"><i class="fa fa-edit"></i></a>
                            <button type="button" class="btn btn-danger btn-sm"
                                wire:click="deleteConfirm({{ $r->id }})">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" align="center">
                            @if($search != null)
                                Maaf, <b><i>{{ $search }}</i></b> tidak ditemukan.
                            @else
                                Data kosong
                            @endif
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $rekenings->links() }}
        </div>
    </div>
</div>
