<div class="col-md-6">
    <div class="card p-3">
        <div class="card-body">
            <form class="forms-sample" wire:submit.prevent="store">
                <div class="form-group">
                    <label for="kode">Kode<span class="text-red">*</span></label>
                    <input id="kode" type="text" wire:model="kode"
                        class="form-control @error('kode') is-invalid @enderror" name="kode">
                    <div class="help-block with-errors"></div>
                    @error('kode')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="nama">Nama<span class="text-red">*</span></label>
                    <input id="nama" type="text" wire:model="nama"
                        class="form-control @error('nama') is-invalid @enderror" name="nama">
                    <div class="help-block with-errors"></div>
                    @error('nama')
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