<div class="col-lg-6 col-md-6 col-12">
    <div class="card card-payment">
        <div class="card-header">
            <h4 class="card-title">Kategori Form</h4>
        </div>
        <div class="card-body">
            <form wire:submit.prevent="store" class="form">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group mb-2">
                            <label for="name">Nama Kategori</label>
                            <input type="text" id="name" wire:model="name" 
                                class="form-control @error('name') is-invalid @enderror" placeholder="Kategori Nama" />
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary" style="width: 100px">
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