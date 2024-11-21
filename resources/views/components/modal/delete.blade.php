<div class="modal fade @if($deleteModal) show @endif" @if($deleteModal) style="display: block" @endif id="hapusData" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Yakin ingin menghapus data?</h1>
                <button type="button" class="btn-close" wire:click="closeDeleteModal()" aria-label="Close"></button>
            </div>
            <form wire:submit="deleteAction()" method="POST">
                <div class="modal-body">
                    <div class="form-container">
                        <div class="alert alert-danger">
                            <b class="text-dark">Data yang telah dihapus tidak dapat dikembalikan</b>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="closeDeleteModal()">Tutup</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>