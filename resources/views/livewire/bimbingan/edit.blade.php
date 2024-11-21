<div class="modal fade @if($show) show @endif" @if($show) style="display: block" @endif id="editData" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Bimbingan Tugas Akhir</h1>
                <button type="button" class="btn-close" wire:click="closeModal()" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-container">
                    <div class="mb-3">
                        <label for="tanggal" class="form-label">Tanggal</label>
                        <input type="date" class="form-control" id="tanggal" wire:model="tanggal">
                        @error('tanggal') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="ket_bimbingan" class="form-label">Keterangan</label>
                        <input type="text" class="form-control" id="ket_bimbingan" wire:model="ket_bimbingan"
                            value="" required>
                            @error('ket_bimbingan') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="hasil_bimbingan" class="form-label">Hasil Bimbingan</label>
                        <textarea class="form-control" id="hasil_bimbingan" wire:model="hasil_bimbingan" rows="3"></textarea>
                        @error('hasil_bimbingan') <small class="text-danger">{{ $message }}</small> @enderror
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