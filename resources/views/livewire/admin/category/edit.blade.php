<div>
    @if ($isOpen)
        {{-- <div class="modal backdrop d-block">
            <div class="modal-backdrop" style="background: rgba(0,0,0,.5); backdrop-filter: blur(1px);">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <form wire:submit.prevent="update">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Data</h5>
                                <button type="button" class="close" wire:click="$set('isOpen', false)">&times;</button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="name">Nama</label>
                                    <input id="name" type="text" wire:model="divisi.name"
                                        class="form-control @error('category.name') is-invalid @enderror" name="name">
                                    <div class="help-block with-errors"></div>
                                    @error('category.name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary shadow"
                                    wire:click="$set('isOpen', false)">Batal</button>
                                <button class="btn btn-primary shadow" type="submit">
                                    Edit
                                    <span class="float-right pl-2">
                                        <div wire:loading wire:target="update" class="spinner-border spinner-border-sm" role="status">
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                    </span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div> --}}
        <div class="modal backdrop d-block text-left">
            <div class="modal-backdrop" style="background: rgba(0,0,0,.5); backdrop-filter: blur(1px);">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel33">Edit Category</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                                wire:click="$set('isOpen', false)">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form wire:submit.prevent="update">
                            <div class="modal-body">
                                <label>Category Name: </label>
                                <div class="form-group">
                                    <input type="text" placeholder="Category Name" wire:model="category.name"
                                        class="form-control @error('category.name') is-invalid @enderror" />
                                    @error('category.name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" data-dismiss="modal" class="btn btn-primary" style="width: 100px">
                                    <span wire:loading.remove wire:target="update">Save</span>
                                    <span wire:loading wire:target="update" class="mx-auto">
                                        <div class="spinner-border spinner-border-sm" role="status">
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                    </span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
