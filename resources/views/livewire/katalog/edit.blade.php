<div class="modal fade @if($show) show @endif" @if($show) style="display: block" @endif id="tambahData" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Form Katalog</h1>
                <button type="button" class="btn-close" wire:click="closeModal()" aria-label="Close"></button>
            </div>
            <form wire:submit="submit()">
                <div class="modal-body">
                    <div class="form-container">
                        <div class="form-group">
                            <img src="{{ asset('storage/'. $imgPhoto) }}" alt="Data Katalog" style="width: 80px;">
                        </div>
                        <div class="form-group mt-2">
                            <label for="media">Foto</label>
                            <input type="file" wire:model="photo" accept="image/*" class="form-control mt-2">
                            @error('photo') <small class="text-danger">{{ $message }}</small> @endif
                        </div>
                        <div class="form-group mt-2">
                            <label for="media">Nama</label>
                            <input type="text" wire:model="nama" class="form-control" placeholder="Masukkan Nama">
                            @error('nama') <small class="text-danger">{{ $message }}</small> @endif
                        </div>
                        <div class="form-group mt-2">
                            <label for="media">NIM</label>
                            <input type="text" wire:model="nim" class="form-control" placeholder="Masukkan NIM">
                            @error('nim') <small class="text-danger">{{ $message }}</small> @endif
                        </div>
                        <div class="form-group mt-2">
                            <label for="media">Judul</label>
                            <input type="text" wire:model="judul" class="form-control" placeholder="Masukkan Judul">
                            @error('judul') <small class="text-danger">{{ $message }}</small> @endif
                        </div>
                        <div class="form-group mt-2">
                            <label for="media">Abstrak</label>
                            <textarea wire:model="abstrak" class="form-control" placeholder="Masukkan Abstrak"></textarea>
                            @error('abstrak') <small class="text-danger">{{ $message }}</small> @endif
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="closeModal()">Tutup</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>