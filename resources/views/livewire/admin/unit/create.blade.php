<div class="col-md-5 col-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Unit Form</h4>
        </div>
        <div class="card-body">
            <form class="form form-horizontal" wire:submit.prevent="store">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group row">
                            <div class="col-sm-3 col-form-label">
                                <label for="name">Nama</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" id="name" name="name" wire:model="name"
                                    class="form-control @error('name') is-invalid @enderror" placeholder="Name" />
                                @error('name')
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
                                <label for="email-id">Deskripsi</label>
                            </div>
                            <div class="col-sm-9">
                                <textarea name="description" id="description" wire:model="description"
                                    class="form-control @error('description') is-invalid @enderror"
                                    placeholder="Description"></textarea>
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-9 offset-sm-3" style="margin-top: -15px">
                        <div class="form-group">
                            <div class="demo-inline-spacing">
                                <div class="custom-control custom-control-primary custom-radio">
                                    <input type="radio" id="status1" wire:model="status"
                                        name="status" class="custom-control-input" value="1" />
                                    <label class="custom-control-label" for="status1">Aktif</label>
                                    </div>
                                    <div class="custom-control custom-control-primary custom-radio">
                                    <input type="radio" id="status2" wire:model="status"
                                        name="status" class="custom-control-input" value="0" />
                                    <label class="custom-control-label" for="status2">Non Aktif</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-9 offset-sm-3 mt-1">
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
