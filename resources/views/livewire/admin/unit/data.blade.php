<div>
    <div class="row">
        @livewire('admin.unit.create')

        <div class="col-lg-7 col-md-6 col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">List Unit</h4>
                        <h4 class="card-title" wire:loading.remove wire:target="search">
                            <span class="text-muted ml-1">{{ $totalUnit }}</span>
                        </h4>
                        <span wire:loading wire:target="search" class="text-muted ml-1">
                            <div class="spinner-border spinner-border-sm" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </span>
                    </div>
                    <input type="search" id="search" wire:model="search" class="form-control col-sm-5" placeholder="Search">
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th style="width: 1px;">#</th>
                                    <th>Nama</th>
                                    <th>Deskripsi</th>
                                    <th>Status</th>
                                    <th style="width: 1px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($units as $u)
                                    <tr>
                                        <td>{{ $loop->iteration + $units->firstItem() - 1 }}</td>
                                        <td>{{ $u->name }}</td>
                                        <td>{{ $u->description }}</td>
                                        <td>
                                            @if($u->status == '1')
                                                <span class="badge badge-success">Aktif</span>
                                            @else
                                                <span class="badge badge-danger">Non Aktif</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn btn-sm dropdown-toggle hide-arrow" data-toggle="dropdown">
                                                    <x-feathericon-more-vertical/>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="javascript:void('edit');"
                                                        wire:click="$emit('edit', '{{ $u->id }}')">
                                                        <x-feathericon-edit-2 />
                                                        <span class="ml-1">Edit</span>
                                                    </a>
                                                    <a class="dropdown-item text-danger" href="javascript:void('delete');" 
                                                        wire:click="deleteConfirm({{ $u->id }})">
                                                        <x-feathericon-trash />
                                                        <span class="ml-1">Delete</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" align="center">
                                            @if($search != null)
                                                Sorry, <b><i>{{ $search }}</i></b> not found.
                                            @else
                                                Empty.
                                            @endif
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <hr style="margin-top: -1px">
                        {{ $units->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    @livewire('admin.unit.edit')
</div>

@push('head')
    <style>
        @media only screen and (max-width: 575px) {
            #search {
                width: 200px;
            }
        }
    </style>
@endpush
