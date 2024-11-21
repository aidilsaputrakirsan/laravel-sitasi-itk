<div>
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Data User</h4>
    
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Data User</a></li>
                        <li class="breadcrumb-item active">Data Mahasiswa</li>
                    </ol>
                </div>
    
            </div>
        </div>
        <div class="col-12">
            <div class="card card-body blur shadow-blur">
                <div class="row gx-4 align-items-center">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="my-heading">Data Mahasiswa</h2>
                            <button class="btn btn-primary" wire:click="openModal()">Tambah</button>
                            <button class="btn btn-success" wire:click="openImportModal()">Import Data</button>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <div class="row mt-2">
                                    <div class="col-md-3 col-sm-12">
                                        <input type="text" wire:model.live="search" placeholder="Search" class="form-control">
                                    </div>
                                </div>
                                <table class="table align-items-center mb-0 datatable">
                                    <thead>
                                        <tr>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                No</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Nama</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                NIM</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Email</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                No Telpon</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Aksi
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($users as $user)
                                            <tr>
                                                <td class="text-xs font-weight-bold mb-0">{{ $loop->iteration   + (($users->currentPage() - 1) * $users->perPage())  }}</td>
                                                <td class="text-xs font-weight-bold mb-0">{{ $user->nama }}</td>
                                                <td class="text-xs font-weight-bold mb-0">{{ $user->nim }}</td>
                                                <td class="text-xs font-weight-bold mb-0">{{ $user->email }}</td>
                                                <td class="text-xs font-weight-bold mb-0">{{ $user->nomor_telepon }}</td>
                                                <td class="text-xs font-weight-bold mb-0">
                                                    <button class="btn btn-primary btn-sm" wire:click="edit('{{ $user->id }}')" >Update</button>
                                                    <button class="btn btn-danger btn-sm" wire:click="setDeleteId('{{ $user->id }}')">Delete</button>
                                                </td>
                                            </tr>
                                        @empty
                                        <tr>
                                            <td colspan="6">Tidak ada data</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="mt-2">
                                {{ $users->links('vendor.livewire.bootstrap') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade @if($addModal) show @endif" @if($addModal) style="display: block;" @endif id="tambahData" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Mahasiswa</h1>
                    <button type="button" class="btn-close" wire:click="closeModal()" aria-label="Close"></button>
                </div>
                <form action="{{ route('data-mahasiswa:store') }}" method="POST">
                    <div class="modal-body">
                        <div class="form-container">
                            @csrf
                            <div class="mb-3">
                                <label for="tanggal" class="form-label">Nama</label>
                                <input type="text" class="form-control" name="name" placeholder="Masukkan Nama" required>
                            </div>
                            <div class="mb-3">
                                <label for="tanggal" class="form-label">NIM</label>
                                <input type="text" class="form-control" name="nim" placeholder="Masukkan NIM" required>
                            </div>
                            <div class="mb-3">
                                <label for="tanggal" class="form-label">EMAIL</label>
                                <input type="email" class="form-control" name="email" placeholder="Masukkan Email" required>
                            </div>
                            <div class="mb-3">
                                <label for="tanggal" class="form-label">Nomor Telepon</label>
                                <input type="text" class="form-control" name="nomor_telepon" placeholder="Masukkan Nomor Telepon">
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
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Form Import Mahasiswa</h1>
                    <button type="button" class="btn-close" wire:click="closeImportModal()" aria-label="Close"></button>
                </div>
                <form wire:submit="submitImport()">
                    <div class="modal-body">
                        <div class="form-container">
                            <div class="form-group">
                                <label for="media">Import Modal <small><a href="{{ asset('Mahasiswa Template.xlsx') }}" target="_blank">download template mahasiswa</a></small></label>
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

    @livewire('data-user.mahasiswa.edit')
    <x-modal.delete :deleteModal="$deleteModal" />
</div>