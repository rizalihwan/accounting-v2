<div>
    <div class="row">
        @livewire('admin.unit.create')

        <div class="col-md-7">
            <div class="card p-3">
                <div class="card-header">
                    <div class="row col-md-5">
                        <div class="inputcontainer w-48 float-right">
                            <input type="search" class="form-control" placeholder="Search" wire:model="search">
                            <div class="icon-container">
                                <div wire:loading wire:target="search">
                                    <i class="loader"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="button" wire:click="$refresh"
                        class="btn btn-light ml-2">
                        <i class="ik ik-refresh-cw m-auto"></i>
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-light table-hover">
                            <thead>
                                <tr>
                                    <th style="width: 1px;">#</th>
                                    <th>Nama</th>
                                    <th>Deskripsi</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($units as $u)
                                    <tr>
                                        <td>{{ $loop->iteration + $units->firstItem() - 1 }}</td>
                                        <td>{{ $u->name }}</td>
                                        <td>{{ $u->description }}</td>
                                        <td>
                                            @if($u->status)
                                                <span class="badge badge-success">Aktif</span>
                                            @else
                                                <span class="badge badge-danger">Non Aktif</span>
                                            @endif
                                        </td>
                                        <td>
                                            <button class="btn btn-info btn-sm" 
                                                wire:click="$emit('edit', '{{ $u->id }}')">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="remove()" 
                                                wire:click="deleteConfirm({{ $u->id }})">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" align="center">
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
                        {{ $units->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    @livewire('admin.unit.edit')
</div>
