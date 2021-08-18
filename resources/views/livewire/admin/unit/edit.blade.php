<div>
    @if ($isOpen)
        <div class="modal backdrop d-block text-left">
            <div class="modal-backdrop" style="background: rgba(0,0,0,.5); backdrop-filter: blur(1px);">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel33">Edit Unit</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                                wire:click="$set('isOpen', false)">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form wire:submit.prevent="update">
                            <div class="modal-body">
                                <label>Nama Unit: </label>
                                <div class="form-group">
                                    <input type="text" placeholder="Unit Name" wire:model="unit.name"
                                        class="form-control @error('unit.name') is-invalid @enderror" />
                                    @error('unit.name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <label>Deskripsi: </label>
                                <div class="form-group">
                                    <textarea name="description" id="description" wire:model="unit.description"
                                        class="form-control @error('unit.description') is-invalid @enderror"></textarea>
                                    @error('unit.description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <div class="demo-inline-spacing">
                                        <div class="custom-control custom-control-primary custom-radio">
                                            <input type="radio" id="status1-edit" wire:model="unit.status"
                                                name="status" class="custom-control-input" value="1"
                                                {{ $unit->status == '1' ? 'checked' : '' }} />
                                            <label class="custom-control-label" for="status1-edit">Aktif</label>
                                            </div>
                                            <div class="custom-control custom-control-primary custom-radio">
                                            <input type="radio" id="status2-edit" wire:model="unit.status"
                                                name="status" class="custom-control-input" value="0"
                                                {{ $unit->status == '0' ? 'checked' : '' }} />
                                            <label class="custom-control-label" for="status2-edit">Non Aktif</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" data-dismiss="modal" class="btn btn-primary" style="width: 100px"
                                    wire:loading.attr="disabled" wire:target="update">
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
