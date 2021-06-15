<div class="col-md-5 col-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Form Divisi</h4>
        </div>
        <div class="card-body">
            <form class="form form-horizontal" wire:submit.prevent="store">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group row">
                            <div class="col-sm-3 col-form-label">
                                <label for="kode">Kode</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" id="kode" name="kode" wire:model="kode" 
                                    class="form-control @error('kode') is-invalid @enderror" placeholder="Kode" />
                                @error('kode')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group row">
                            <div class="col-sm-3 col-form-label">
                                <label for="nama">Nama</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" id="nama" name="nama" wire:model="nama" 
                                    class="form-control @error('nama') is-invalid @enderror" placeholder="Nama" />
                                @error('nama')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-9 offset-sm-3">
                        <button type="submit" class="btn btn-primary" style="width: 100px"
                            wire:loading.attr="disabled" wire:target="store">
                            <span wire:loading.remove wire:target="store">Submit</span>
                            <span wire:loading wire:target="store" class="mx-auto">
                                <div class="spinner-border spinner-border-sm" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>