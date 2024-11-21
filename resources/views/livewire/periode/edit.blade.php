<div class="modal fade @if($show) show @endif " @if($show)  style="display: block" @endif id="editData" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Bimbingan Tugas Akhir</h1>
                <button type="button" class="btn-close" wire:click="closeModal()" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-container">
                    <div class="mb-3">
                        <label for="tanggal" class="form-label">Semester</label>
                        <select wire:model="semester" class="form-control" required>
                            <option value="">Pilih Semester</option>
                            <option value="Gasal">Gasal</option>
                            <option value="Genap">Genap</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="tanggal" class="form-label">Periode</label>
                        <input type="text" class="form-control" wire:model="periode" placeholder="Masukkan Periode" required>
                        @error('periode') <small class="text-danger">{{ $message }}</small> @endif
                    </div>
                    <div class="mb-3">
                        <label for="dosen" class="form-label">Gelombang</label>
                        <input type="text" class="form-control" wire:model="gelombang" placeholder="Masukkan Gelombang" required>
                        @error('gelombang') <small class="text-danger">{{ $message }}</small> @endif
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