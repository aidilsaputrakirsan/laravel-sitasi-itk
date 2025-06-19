<div>
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Profile</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">User</a></li>
                        <li class="breadcrumb-item active">Profile</li>
                    </ol>
                </div>

            </div>
        </div>
        <div class="col-xl-9 col-lg-8">
            <div class="card">
                <div class="card-body">
                    <x-profile-header />

                    <ul class="nav nav-tabs-custom card-header-tabs border-top mt-4" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <button class="nav-link px-3 {{ $type !== 'referensi' ? 'active' : '' }}" wire:click="changeTab('')" role="tab">Overview</button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link px-3 {{ $type === 'referensi' ? 'active' : '' }}" wire:click="changeTab('referensi')">Referensi Topik TA</button>
                        </li>
                    </ul>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->

            <div class="tab-content">
                <div class="tab-pane active" id="overview" role="tabpanel">
                    <div class="card card-body blur shadow-blur">
                        <div class="row align-items-center">
                            <div class="card-header" style="display: flex; justify-content: space-between">
                                <h2 class="my-heading">Data Referensi TA</h2>
                                <button class="btn btn-info btn-sm" wire:click="openModal()">Tambah Referensi</button>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive p-0">
                                    <div class="table-responsive mb-4">
                                        <table class="table align-middle datatable dt-responsive table-check nowrap" style="border-collapse: collapse; border-spacing: 0 8px; width: 100%;">
                                            <thead>
                                              <tr>
                                                <th scope="col" style="width: 50px;">No</th>
                                                <th scope="col">Bidang Minat</th>
                                                <th scope="col">Judul/Topik</th>
                                                <th scope="col">Tersedia</th>
                                                <th scope="col" class="text-center">Aksi</th>
                                              </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($referensi as $ref)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $ref->bidang_minat }}</td>
                                                        <td>{{ $ref->judul }}</td>
                                                        <td>{{ $ref->is_tersedia ? 'Ya' : 'Tidak' }}</td>
                                                        <td class="text-center">
                                                            <button class="btn btn-info btn-sm" wire:click="edit('{{ $ref->id }}')">Update</button>
                                                            <button class="btn btn-danger btn-sm" wire:click="setDeleteId('{{ $ref->id }}')">Hapus</button>
                                                        </td>
                                                    </tr>
                                                @empty
                                                <tr>
                                                    <td colspan="5">Belum ada data</td>
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
                    <!-- end card -->

                    <!-- end card -->
                </div>
                <!-- end tab pane -->


            </div>
            <!-- end tab content -->
        </div>
        <!-- end col -->

        <div class="col-xl-3 col-lg-4">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-3">Tanda Tangan Digital</h5>
                    <div>
                        <div id="imagePreview" class="mt-2">
                            @if($imgSignature !== null && !$signature)
                                <img src="{{ storage_path('app/public/' . $imgSignature) }}" alt="Tanda tangan" style="width: 100%">
                            @elseif($signature)
                                <img src="{{ $signature->temporaryUrl() }}" alt="Tanda tangan" style="width: 100%">
                            @endif
                        </div>
                        <input type="file" accept="image/*" class="form-control" wire:model="signature">
                        @error('signature')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <button class="btn btn-primary btn-sm mt-2" wire:click="saveSignature()">Submit</button>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>
    </div>

    <div class="modal fade @if($addModal) show @endif" @if($addModal) style="display: block" @endif id="tambahData" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

    @livewire('referensi.edit')
    <x-modal.delete :deleteModal="$deleteModal" />
</div>