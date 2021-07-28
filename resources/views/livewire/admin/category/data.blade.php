<div>
    <div class="row">
        @livewire('admin.category.create')

        <div class="col-lg-6 col-md-6 col-12">
            <div class="card card-payment">
                <div class="card-header">
                    <h4 class="card-title">List Kategori</h4>
                    <input type="search" wire:model="search" class="form-control col-sm-5" placeholder="Search">
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th style="width: 1px">#</th>
                                    <th>Nama Kategori</th>
                                    <th style="width: 1px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($categorys as $category)
                                    <tr>
                                        <td>{{ $loop->iteration + $categorys->firstItem() - 1 }}</td>
                                        <td>{{ $category->name }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn btn-sm dropdown-toggle hide-arrow" data-toggle="dropdown">
                                                    <x-feathericon-more-vertical/>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="javascript:void('edit');"
                                                        wire:click="$emit('edit', '{{ $category->id }}')">
                                                        <x-feathericon-edit-2 />
                                                        <span class="ml-1">Edit</span>
                                                    </a>
                                                    <a class="dropdown-item text-danger" href="javascript:void('delete');" 
                                                        wire:click="deleteConfirm({{ $category->id }})">
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
                        {{ $categorys->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    @livewire('admin.category.edit')
</div>
