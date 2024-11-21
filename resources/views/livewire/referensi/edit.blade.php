<div class="modal fade @if($show) show @endif" @if($show) style="display: block" @endif id="tambahData" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Form Referensi</h1>
                <button type="button" class="btn-close" wire:click="closeModal()" aria-label="Close"></button>
            </div>
            <form wire:submit="submit()">
                <div class="modal-body">
                    <div class="form-container">
                        <div class="form-group">
                            <label for="media">Bidang Minat</label>
                            <input type="text" wire:model="bidang_minat" class="form-control" placeholder="Masukkan Bidang Minat">
                            @error('bidang_minat') <small class="text-danger">{{ $message }}</small> @endif
                        </div>
                        <div class="form-group">
                            <label for="media">Judul</label>
                            <input type="text" wire:model="judul" class="form-control" placeholder="Masukkan Judul">
                            @error('judul') <small class="text-danger">{{ $message }}</small> @endif
                        </div>
                        <div class="form-group mt-2">
                            <label for="media">Apakah Tersedia?</label>
                            <div class="form-check form-switch mb-3" dir="ltr">
                                <input type="checkbox" class="form-check-input" id="customSwitch1" wire:model="is_tersedia">
                                <label class="form-check-label" for="customSwitch1">Ya</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="closeModal()">Tutup</button>
                    <button type="submit" data-bs-dismiss="modal" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>