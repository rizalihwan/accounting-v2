<div>
    <div class="row">
        @livewire('admin.subklasifikasi.create')

        <div class="col-lg-6 col-md-6 col-12">
            <div class="card card-payment">
                <div class="card-header">
                    <h4 class="card-title">List Subklasifikasi</h4>
                    <input type="search" wire:model="search" class="form-control col-sm-5" placeholder="Search">
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th style="width: 1px">#</th>
                                    <th>Nama Subklasifikasi</th>
                                    <th style="width: 1px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($subklasifikasi as $sub)
                                    <tr>
                                        <td>{{ $loop->iteration + $subklasifikasi->firstItem() - 1 }}</td>
                                        <td>{{ $sub->name }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn btn-sm dropdown-toggle hide-arrow" data-toggle="dropdown">
                                                    <x-feathericon-more-vertical/>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="javascript:void('edit');"
                                                        wire:click="$emit('edit', '{{ $sub->id }}')">
                                                        <x-feathericon-edit-2 />
                                                        <span class="ml-1">Edit</span>
                                                    </a>
                                                    <a class="dropdown-item text-danger" href="javascript:void('delete');" 
                                                        wire:click="deleteConfirm({{ $sub->id }})">
                                                        <x-feathericon-trash />
                                                        <span class="ml-1">Delete</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" align="center">
                                            @if($search != null)
                                                Maaf, <b><i>"{{ $search }}"</i></b> tidak ditemukan.
                                            @else
                                                Data Kosong.
                                            @endif
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <hr style="margin-top: -1px">
                        {{ $subklasifikasi->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    @livewire('admin.subklasifikasi.edit')
</div>
