<div>
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Katalog TA</h4>
    
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Data Referensi</a></li>
                        <li class="breadcrumb-item active">Katalog TA</li>
                    </ol>
                </div>
    
            </div>
        </div>
        <div class="col-md-12">
            <div class="card card-body blur shadow-blur">
                <div class="row align-items-center">
                    <div class="card-header" style="display: flex; justify-content: space-between">
                        <h2 class="my-heading">Data Katalog TA</h2>
                        @if(auth()->user()->isTendik() || auth()->user()->isKoorpro())
                        <div>
                            <button class="btn btn-info" wire:click="openModal()">Tambah Katalog</button>
                            <button class="btn btn-success" wire:click="openImportModal()">Import Katalog</button>
                        </div>
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="table-responsive p-0">
                            <div class="table-responsive mb-4">
                                <table class="table align-middle datatable dt-responsive table-check nowrap" style="border-collapse: collapse; border-spacing: 0 8px; width: 100%;">
                                    <thead>
                                      <tr>
                                        <th scope="col" style="width: 50px;">No</th>
                                        <th scope="col">Foto</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Judul</th>
                                        <th scope="col">Abstrak</th>
                                        @if(auth()->user()->isTendik() || auth()->user()->isKoorpro())
                                        <th scope="col">Aksi</th>
                                        @endif
                                      </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($katalogs as $kat)
                                            <tr>
                                                <td>{{ $loop->iteration }}.</td>
                                                <td>
                                                    @if($kat->photo)
                                                    <img src="{{ asset('storage/'. $kat->photo) }}" alt="Foto Katalog" style="width: 100px;">
                                                    @else 
                                                    <img src="{{ asset('dist/assets/images/users/avatar.png') }}" alt="Foto Katalog" style="width: 100px;">
                                                    @endif
                                                </td>
                                                <td>{{ $kat->nama }} <br>{{ $kat->nim }}</td>
                                                <td>{{ $kat->judul }}</td>
                                                <td>{{ $kat->abstrak }}</td>
                                                @if(auth()->user()->isTendik() || auth()->user()->isKoorpro())
                                                <td>
                                                    <button class="btn btn-sm btn-info" wire:click="edit('{{ $kat->id }}')">Update</button>
                                                    <button class="btn btn-sm btn-danger" wire:click="setDeleteId('{{ $kat->id }}')">Hapus</button>
                                                </td>
                                                @endif
                                            </tr>
                                        @empty
                                        <tr>
                                            @if(auth()->user()->isTendik() || auth()->user()->isKoorpro())
                                            <td colspan="6">Belum ada data</td>
                                            @else
                                            <td colspan="5">Belum ada data</td>
                                            @endif
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                <!-- end table -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade @if($addModal) show @endif" @if($addModal) style="display: block" @endif id="tambahData" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                <label for="media">Foto</label>
                                <input type="file" wire:model="photo" accept="image/*" class="form-control">
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

    <div class="modal fade @if($importModal) show @endif" @if($importModal) style="display: block" @endif id="tambahData" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Form Import Katalog</h1>
                    <button type="button" class="btn-close" wire:click="closeImportModal()" aria-label="Close"></button>
                </div>
                <form wire:submit="submitImport()">
                    <div class="modal-body">
                        <div class="form-container">
                            <div class="form-group">
                                <label for="media">Import Modal <small><a href="{{ asset('Katalog Template.xlsx') }}" target="_blank">download template katalog</a></small></label>
                                <input type="file" wire:model="import" class="form-control">
                                @error('import') <small class="text-danger">{{ $message }}</small> @endif
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="closeImportModal()">Tutup</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @livewire('katalog.edit')
    <x-modal.delete :deleteModal="$deleteModal" />

</div>