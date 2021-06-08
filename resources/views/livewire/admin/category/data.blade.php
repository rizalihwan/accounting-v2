<div>
    <div class="row">
        @livewire('admin.category.create')

        <div class="col-md-6">
            <div class="card p-3">
                <div class="card-header">
                    <div class="row col-md-6">
                        <div class="inputcontainer w-48 float-right">
                            <input type="search" class="form-control" placeholder="Search" wire:model="search">
                            <div class="icon-container">
                                <div wire:loading wire:target="search">
                                    <i class="loader"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible">
                            <span>{{ session('success') }}</span>
                            <button class="close" data-dismiss="alert">&times;</button>
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table class="table table-light table-hover">
                            <thead>
                                <tr>
                                    <th style="width: 1px;">#</th>
                                    <th>Kategori</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($categorys as $category)
                                    <tr>
                                        <td>{{ $loop->iteration + $categorys->firstItem() - 1 }}</td>
                                        <td>{{ $category->name }}</td>
                                        <td>
                                            <button class="btn btn-info btn-sm" 
                                                wire:click="$emit('edit', '{{ $category->id }}')">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="remove()" 
                                                wire:click="$emit('delete', '{{ $category->id }}')">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" align="center">Data kosong.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $categorys->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    @livewire('admin.category.edit')
</div>

@push('script')
	<script>
		const remove = function () {
			return confirm('Yakin untuk hapus data ini?') || event.stopImmediatePropagation()
		}
	</script>
@endpush