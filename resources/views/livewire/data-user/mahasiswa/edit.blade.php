<div class="modal fade @if($show) show @endif " @if($show)  style="display: block" @endif id="editData" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data Mahasiswa</h1>
                <button type="button" class="btn-close" wire:click="closeModal()" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-container">
                    <div class="mb-3">
                        <label for="tanggal" class="form-label">Nama</label>
                        <input type="text" class="form-control" wire:model="nama" placeholder="Masukkan Nama" required>
                        @error('nama') <small class="text-danger">{{ $message }}</small> @endif
                    </div>
                    <div class="mb-3">
                        <label for="dosen" class="form-label">NIM</label>
                        <input type="text" class="form-control" wire:model="nim" placeholder="Masukkan NIM" required>
                        @error('nip') <small class="text-danger">{{ $message }}</small> @endif
                    </div>
                    <div class="mb-3">
                        <label for="dosen" class="form-label">Email</label>
                        <input type="text" class="form-control" wire:model="email" placeholder="Masukkan Email" required>
                        @error('email') <small class="text-danger">{{ $message }}</small> @endif
                    </div>
                    <div class="mb-3">
                        <label for="dosen" class="form-label">Nomor Telepon</label>
                        <input type="text" class="form-control" wire:model="nomor_telepon" placeholder="Masukkan Nomor Telepon">
                        @error('email') <small class="text-danger">{{ $message }}</small> @endif
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" wire:click="closeModal()">Tutup</button>
                <button type="button" wire:click="edit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </div>
</div>