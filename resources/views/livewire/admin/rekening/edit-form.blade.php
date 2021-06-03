<div>
    @if(session()->has('error'))
        <div class="alert alert-danger alert-dismissible">
            <span>{{ session('error') }}</span>
            <button class="close" data-dismiss="alert">&times;</button>
        </div>
    @endif
    <form class="forms-sample" wire:submit.prevent="update">
        <div class="row">
            <div class="col-sm-3">
                <div class="form-group">
                    <label for="nomor">Nomor<span class="text-red">*</span></label>
                    <input id="nomor" type="text" wire:model="rekening.nomor"
                        class="form-control @error('rekening.nomor') is-invalid @enderror" name="nomor"
                        onkeypress="return hanyaAngka(event)" minlength="4" maxlength="4" 
                        autocomplete="off" autofocus>
                    <div class="help-block with-errors"></div>
                    @error('rekening.nomor')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-3">
                <div class="form-group">
                    <label for="nama">Nama<span class="text-red">*</span></label>
                    <input id="nama" type="text" wire:model="rekening.nama"
                        class="form-control @error('rekening.nama') is-invalid @enderror" name="nama">
                    <div class="help-block with-errors"></div>
                    @error('rekening.nama')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <label for="level">Level<span class="text-red">*</span></label>
                    <select name="level" id="level" wire:model="rekening.level"
                        class="form-control @error('rekening.level') is-invalid @enderror">
                        <option value="" selected>-- Level --</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                    </select>
                    <div class="help-block with-errors"></div>
                    @error('rekening.level')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <label for="kategori">Kategori<span class="text-red">*</span></label>
                    <select name="kategori" id="kategori" wire:model="rekening.kategori" wire:change="cekDC()"
                        class="form-control @error('rekening.kategori') is-invalid @enderror">
                        <option value="" selected>-- Kategori --</option>
                        <option value="Aktiva">Aktiva</option>
                        <option value="Hutang">Hutang</option>
                        <option value="Modal">Modal</option>
                        <option value="Pendapatan">Pendapatan</option>
                        <option value="Biaya">Biaya</option>
                    </select>
                    <div class="help-block with-errors"></div>
                    @error('rekening.kategori')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <label for="d_c">D/C<span class="text-red">*</span></label>
                    <input id="d_c" type="text" name="d_c" wire:model="rekening.d_c" 
                        class="form-control @error('rekening.d_c') is-invalid @enderror" readonly>
                    <div class="help-block with-errors"></div>
                    @error('rekening.d_c')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <label for="g_d">G/D<span class="text-red">*</span></label>
                    <select name="g_d" id="g_d" wire:model="rekening.g_d"
                        class="form-control @error('rekening.g_d') is-invalid @enderror">
                        <option value="" selected>-- G/D --</option>
                        <option value="G">G</option>
                        <option value="D">D</option>
                    </select>
                    <div class="help-block with-errors"></div>
                    @error('rekening.g_d')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-2">
                <div class="form-group">
                    <label for="mata_uang">Mata Uang<span class="text-red">*</span></label>
                    <select name="mata_uang" id="mata_uang" wire:model="rekening.mata_uang"
                        class="form-control @error('rekening.mata_uang') is-invalid @enderror">
                        <option value="" selected>-- Mata Uang --</option>
                        <option value="Rp">Rp</option>
                        <option value="USD">USD</option>
                    </select>
                    <div class="help-block with-errors"></div>
                    @error('rekening.mata_uang')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <label for="bank_id">Bank<span class="text-red">*</span></label>
                    <select name="bank_id" id="bank_id" wire:model="rekening.bank_id"
                        class="form-control @error('rekening.bank_id') is-invalid @enderror">
                        <option value="" selected>-- Bank --</option>
                        @foreach($banks as $bank)
                            <option value="{{ $bank->id }}">{{ $bank->nama_bank }}</option>
                        @endforeach
                    </select>
                    <div class="help-block with-errors"></div>
                    @error('rekening.bank_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="ac_bank">A/C Bank<span class="text-red">*</span></label>
                    <input id="ac_bank" type="text" name="ac_bank" wire:model="rekening.ac_bank" 
                        class="form-control @error('rekening.ac_bank') is-invalid @enderror">
                    <div class="help-block with-errors"></div>
                    @error('rekening.ac_bank')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <label for="divisi_id">Divisi<span class="text-red">*</span></label>
                    <select name="divisi_id" id="divisi_id" wire:model="rekening.divisi_id"
                        class="form-control @error('rekening.divisi_id') is-invalid @enderror">
                        <option value="" selected>-- Divisi --</option>
                        @foreach($divitions as $divisi)
                            <option value="{{ $divisi->id }}">{{ $divisi->nama }}</option>
                        @endforeach
                    </select>
                    <div class="help-block with-errors"></div>
                    @error('rekening.divisi_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row my-3">
            <div class="col-sm-2">
                <div class="checkbox-fade fade-in-success">
                    <label>
                        <input type="checkbox" value="" wire:model="rekening.aktif"
                            {{ $rekening['aktif'] == true ? 'checked' : '' }}>
                        <span class="cr">
                            <i class="cr-icon ik ik-check txt-success"></i>
                        </span>
                        <span>Aktif</span>
                    </label>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="checkbox-fade fade-in-success">
                    <label>
                        <input type="checkbox" value="" wire:model="rekening.piutang"
                            {{ $rekening['piutang'] == true ? 'checked' : '' }}>
                        <span class="cr">
                            <i class="cr-icon ik ik-check txt-success"></i>
                        </span>
                        <span>Piutang</span>
                    </label>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="checkbox-fade fade-in-success">
                    <label>
                        <input type="checkbox" value="" wire:model="rekening.kas_bank"
                            {{ $rekening['kas_bank'] == true ? 'checked' : '' }}>
                        <span class="cr">
                            <i class="cr-icon ik ik-check txt-success"></i>
                        </span>
                        <span>Kas Bank</span>
                    </label>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-3">
                <div class="form-group">
                    <label for="level_1">Level 1<span class="text-red">*</span></label>
                    <select name="level_1" id="level_1" wire:model="rekening.level_1"
                        class="form-control @error('rekening.level_1') is-invalid @enderror">
                        <option value="">-- Level 1 --</option>
                        <option value="1000" 
                            {{ $rekening->level_1 == '1000' ? "selected" :'' }}>1000 : AKTIVA</option>
                        <option value="2000" 
                            {{ $rekening->level_1 == '2000' ? "selected" :'' }}>2000 : HUTANG</option>
                        <option value="3000" 
                            {{ $rekening->level_1 == '3000' ? "selected" :'' }}>3000 : MODAL</option>
                        <option value="4000"
                            {{ $rekening->level_1 == '4000' ? "selected" :'' }}>4000 : PENDAPATAN</option>
                        <option value="5000"
                            {{ $rekening->level_1 == '5000' ? "selected" :'' }}>5000 : BIAYA</option>
                    </select>
                    <div class="help-block with-errors"></div>
                    @error('rekening.level_1')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <label for="level_2">Level 2<span class="text-red">*</span></label>
                    <select name="level_2" id="level_2" wire:model="rekening.level_2"
                        class="form-control @error('rekening.level_2') is-invalid @enderror">
                        <option value="">-- Level 2 --</option>
                        <option value="1100"
                            {{ $rekening['level_2'] == '1100' ? "selected" : "" }}>1100 : Aktiva Lancar</option>
                        <option value="1200"
                            {{ $rekening['level_2'] == '1200' ? "selected" : "" }}>1200 : Aktiva Tetap</option>
                        <option value="2100"
                            {{ $rekening['level_2'] == '2100' ? "selected" : "" }}>2100 : Hutang Jk. Pendek</option>
                        <option value="2200"
                            {{ $rekening['level_2'] == '2200' ? "selected" : "" }}>2200 : Hutan Jk. Panjang</option>
                        <option value="4100"
                            {{ $rekening['level_2'] == '4100' ? "selected" : "" }}>4100 : Pendapatan Usaha</option>
                        <option value="4200"
                            {{ $rekening['level_2'] == '4200' ? "selected" : "" }}>4200 : Pendapatan Non Usaha</option>
                        <option value="5100"
                            {{ $rekening['level_2'] == '5100' ? "selected" : "" }}>5100 : Biaya Operasional</option>
                        <option value="5200"
                            {{ $rekening['level_2'] == '5200' ? "selected" : "" }}>5200 : Biaya Lain-lain</option>
                    </select>
                    <div class="help-block with-errors"></div>
                    @error('rekening.level_2')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <label for="level_3">Level 3<span class="text-red">*</span></label>
                    <select name="level_3" id="level_3" wire:model="rekening.level_3" disabled
                        class="form-control @error('rekening.level_3') is-invalid @enderror">
                        <option value="" selected>-- Level 3 --</option>
                        <option value="3">3</option>
                    </select>
                    <div class="help-block with-errors"></div>
                    @error('rekening.level_3')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 mt-4">
                <div class="form-group">
                    <a href="{{ route('admin.rekening.index') }}" class="btn btn-danger">KEMBALI</a>
                    <button type="submit" class="btn btn-primary">
                        Update
                        <span class="float-right pl-2">
                            <i wire:loading wire:target="update" class="fas fa-spinner fa-pulse"></i>
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
