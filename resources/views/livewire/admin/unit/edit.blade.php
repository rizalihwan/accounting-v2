<div>
    @if ($isOpen)
        <div class="modal backdrop d-block">
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
                                    <input id="name" type="text" wire:model="unit.name"
                                        class="form-control @error('unit.name') is-invalid @enderror" name="name">
                                    <div class="help-block with-errors"></div>
                                    @error('unit.name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="description">Deskripsi</label>
                                    <textarea name="description" id="description" wire:model="unit.description"
                                        class="form-control @error('unit.description') is-invalid @enderror"></textarea>
                                    <div class="help-block with-errors"></div>
                                    @error('unit.description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <div class="radio radio-inline">
                                        <label>
                                            <input type="radio" name="status" value="1" wire:model="unit.status"
                                                {{ $unit->status == '1' ? 'checked' : '' }}>
                                            {{ __('Aktif')}}
                                        </label>
                                    </div>
                                    <div class="radio radio-inline">
                                        <label>
                                            <input type="radio" name="status" value="0" wire:model="unit.status"
                                                {{ $unit->status == '0' ? 'checked' : '' }}>
                                            {{ __('Non Aktif')}}
                                        </label>
                                    </div>
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
        </div>
    @endif
</div>