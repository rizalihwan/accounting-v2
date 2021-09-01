<div>
    <div class="row">
        @livewire('admin.akun.create')

        <div class="col-lg-8 col-md-7 col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">List Akun</h4>
                        <h4 class="card-title" wire:loading.remove wire:target="search">
                            <span class="text-muted ml-1">{{ $totalAkun }}</span>
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
                        <table class="table table-hover" @if($totalAkun == 1) style="height: 100px" @endif>
                            <thead>
                                <tr>
                                    <th style="width: 1px;">#</th>
                                    <th style="width: 1px;">Kode</th>
                                    <th>Nama Akun</th>
                                    <th>Subklasifikasi</th>
                                    <th>Level</th>
                                    <th>Debit</th>
                                    <th>Kredit</th>
                                    <th style="width: 1px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($accounts as $account)
                                    <tr>
                                        <td>{{ $loop->iteration + $accounts->firstItem() - 1 }}</td>
                                        <td>
                                            <span class="badge badge-success">{{ $account->kode }}</span>
                                        </td>
                                        <td>{{ $account->name }}</td>
                                        <td>{{ $account->subklasifikasi }}</td>
                                        <td>{{ $account->level }}</td>
                                        <td>{{ $account->debit }}</td>
                                        <td>{{ $account->kredit }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn btn-sm dropdown-toggle hide-arrow" data-toggle="dropdown">
                                                    <x-feathericon-more-vertical/>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="javascript:void('edit');"
                                                        wire:click="$emit('edit', '{{ $account->id }}')">
                                                        <x-feathericon-edit-2 />
                                                        <span class="ml-1">Edit</span>
                                                    </a>
                                                    <a class="dropdown-item text-danger" href="javascript:void('delete');" onclick="remove()" 
                                                        wire:click="deleteConfirm({{ $account->id }})">
                                                        <x-feathericon-trash />
                                                        <span class="ml-1">Delete</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" align="center">
                                            @if($search != null)
                                                Maaf, <b><i>"{{ $search }}"</i></b> tidak ditemukan.
                                            @else
                                                Data kosong.
                                            @endif
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <hr style="margin-top: -1px">
                        {{ $accounts->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    @livewire('admin.akun.edit')
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