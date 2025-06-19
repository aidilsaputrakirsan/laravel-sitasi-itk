<div class="modal fade @if($show) show @endif " @if($show)  style="display: block" @endif id="editData" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data Mahasiswa</h1>
                <button type="button" class="btn-close" wire:click="closeModal()" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-container">
                    <!-- Data Mahasiswa -->
                    <h6 class="mb-3 text-primary">Data Mahasiswa</h6>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" class="form-control" wire:model="nama" placeholder="Masukkan Nama" required>
                                @error('nama') <small class="text-danger">{{ $message }}</small> @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="nim" class="form-label">NIM</label>
                                <input type="text" class="form-control" wire:model="nim" placeholder="Masukkan NIM" required>
                                @error('nim') <small class="text-danger">{{ $message }}</small> @endif
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" wire:model="email" placeholder="Masukkan Email" required>
                                @error('email') <small class="text-danger">{{ $message }}</small> @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="nomor_telepon" class="form-label">Nomor Telepon</label>
                                <input type="text" class="form-control" wire:model="nomor_telepon" placeholder="Masukkan Nomor Telepon">
                                @error('nomor_telepon') <small class="text-danger">{{ $message }}</small> @endif
                            </div>
                        </div>
                    </div>

                    <hr>

                    <!-- Data Pembimbing TA -->
                    <h6 class="mb-3 text-primary">Data Pembimbing TA</h6>
                    
                    @if($hasPengajuanTA)
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="pembimbing_1" class="form-label">Dosen Pembimbing Utama</label>
                                    <select class="form-control" wire:model="pembimbing_1">
                                        <option value="">Pilih Dosen Pembimbing Utama</option>
                                        @foreach($dosenList as $dosen)
                                            <option value="{{ $dosen->id }}">{{ $dosen->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="pembimbing_2" class="form-label">Dosen Pembimbing Pendamping</label>
                                    <select class="form-control" wire:model="pembimbing_2">
                                        <option value="">Pilih Dosen Pembimbing Pendamping</option>
                                        @foreach($dosenList as $dosen)
                                            <option value="{{ $dosen->id }}">{{ $dosen->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        @if($judulTA)
                        <div class="alert alert-info">
                            <small><strong>Judul TA:</strong> {{ $judulTA }}</small>
                        </div>
                        @endif
                    @else
                        <div class="alert alert-warning">
                            <small>Mahasiswa ini belum memiliki pengajuan TA.</small>
                        </div>
                    @endif
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" wire:click="closeModal()">Tutup</button>
                <button type="button" wire:click="edit" class="btn btn-primary">Update Data</button>
            </div>
        </div>
    </div>
</div>