<div class="col-md-6">
    <div class="card p-3">
        <div class="card-body">
            <form class="forms-sample" wire:submit.prevent="store">
                <div class="form-group">
                    <label for="name">Nama<span class="text-red">*</span></label>
                    <input id="name" type="text" wire:model="name"
                        class="form-control @error('name') is-invalid @enderror" name="name">
                    <div class="help-block with-errors"></div>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        TAMBAH
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>