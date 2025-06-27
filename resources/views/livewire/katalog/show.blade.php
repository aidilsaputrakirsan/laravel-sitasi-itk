<div>
    {{-- Header --}}
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Katalog TA</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Master Data</a></li>
                        <li class="breadcrumb-item active">Katalog TA</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    {{-- TAMBAHKAN: Navigation Buttons berdasarkan Role --}}
    <div class="row mb-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="mb-0 text-muted">
                                @if(auth()->user()->isMahasiswa())
                                    <i class="fas fa-info-circle"></i> Lihat semua katalog TA yang telah disetujui
                                @elseif(auth()->user()->isDosen())
                                    <i class="fas fa-book"></i> Katalog TA yang tersedia untuk referensi
                                @else
                                    <i class="fas fa-cogs"></i> Kelola dan approve katalog TA
                                @endif
                            </p>
                        </div>
                        
                        <div class="d-flex gap-2">
                            {{-- Tombol untuk Mahasiswa --}}
                            @if(auth()->user()->isMahasiswa())
                                <a href="{{ route('ta:katalog-ta') }}" class="btn btn-primary">
                                    <i class="fas fa-edit"></i> Kelola Katalog TA Saya
                                </a>
                            @endif
                            
                            {{-- Tombol untuk Admin/Tendik --}}
                            @if(auth()->user()->isTendik() || auth()->user()->hasRole('admin'))
                                {{-- Badge untuk pending approval --}}
                                @if($katalogsPending->count() > 0)
                                    <span class="badge bg-warning fs-6 me-2">
                                        <i class="fas fa-clock"></i> {{ $katalogsPending->count() }} Pending
                                    </span>
                                @endif
                            @endif
                            
                            {{-- Tombol untuk Dosen: Tidak ada tombol khusus --}}
                            @if(auth()->user()->isDosen())
                                <span class="badge bg-info">
                                    <i class="fas fa-eye"></i> Mode Viewing
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- Action Buttons - Hanya untuk Admin/Tendik --}}
    @if($canAdd)
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <button class="btn btn-primary" wire:click="openModal">
                                    <i class="fas fa-plus"></i> Tambah Katalog
                                </button>
                                <button class="btn btn-success ms-2" wire:click="openImportModal">
                                    <i class="fas fa-file-import"></i> Import Excel
                                </button>
                            </div>
                            <div>
                                {{-- Info tambahan untuk admin --}}
                                <small class="text-muted">
                                    <i class="fas fa-users"></i> Total: {{ $katalogs->count() }} katalog
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- Info untuk Read-only Users (Dosen) --}}
    @if($isReadOnly && auth()->user()->isDosen())
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="alert alert-info mb-0">
                            <i class="fas fa-info-circle"></i>
                            <strong>Mode Viewing:</strong> Anda dapat melihat semua katalog TA sebagai referensi. 
                            Untuk mengelola data pengajuan mahasiswa, silakan gunakan menu "Data Pengajuan".
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- Tabs --}}
    {{-- Main Content --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    {{-- Tab Navigation - Hanya untuk Admin/Tendik --}}
                    @if($canManage)
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link {{ $activeTab === 'all' ? 'active' : '' }}" 
                                   wire:click="setActiveTab('all')" 
                                   href="#" role="tab">
                                    <i class="fas fa-list"></i> Semua Katalog
                                    <span class="badge bg-primary ms-1">{{ $katalogs->count() }}</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ $activeTab === 'pending' ? 'active' : '' }}" 
                                   wire:click="setActiveTab('pending')" 
                                   href="#" role="tab">
                                    <i class="fas fa-clock"></i> Pending Approval
                                    @if($katalogsPending->count() > 0)
                                        <span class="badge bg-warning ms-1">{{ $katalogsPending->count() }}</span>
                                    @endif
                                </a>
                            </li>
                        </ul>
                        <div class="mt-3"></div>
                    @endif

                    {{-- Tab Content --}}
                    @if(!$canManage || $activeTab === 'all')
                        {{-- All Katalogs Tab --}}
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Photo</th>
                                        <th>Nama</th>
                                        <th>NIM</th>
                                        <th>Judul</th>
                                        @if($canManage)
                                            <th>Source</th>
                                        @endif
                                        @if($canManage)
                                            <th>Action</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($katalogs as $katalog)
                                        <tr>
                                            <td>
                                                @if($katalog->photo)
                                                    <img src="{{ asset('storage/' . $katalog->photo) }}" 
                                                         alt="Photo" 
                                                         class="img-thumbnail" 
                                                         style="width: 50px; height: 50px; object-fit: cover;">
                                                @else
                                                    <div class="bg-light d-flex align-items-center justify-content-center" 
                                                         style="width: 50px; height: 50px;">
                                                        <i class="fas fa-image text-muted"></i>
                                                    </div>
                                                @endif
                                            </td>
                                            <td>{{ $katalog->nama }}</td>
                                            <td>{{ $katalog->nim }}</td>
                                            <td class="text-truncate" style="max-width: 300px;">
                                                <strong>{{ $katalog->judul }}</strong>
                                                @if($katalog->abstrak)
                                                    <br>
                                                    <button class="btn btn-link btn-sm p-0" 
                                                            data-bs-toggle="modal" 
                                                            data-bs-target="#abstrakViewModal{{ $katalog->id }}">
                                                        <small><i class="fas fa-eye"></i> Lihat Abstrak</small>
                                                    </button>
                                                @endif
                                            </td>
                                            @if($canManage)
                                                <td>
                                                    @if($katalog->created_by === 'admin')
                                                        <span class="badge bg-info">Admin</span>
                                                    @else
                                                        <span class="badge bg-success">Mahasiswa</span>
                                                        @if($katalog->user)
                                                            <br><small class="text-muted">{{ $katalog->user->name }}</small>
                                                        @endif
                                                    @endif
                                                </td>
                                            @endif
                                            @if($canManage)
                                                <td>
                                                    <button class="btn btn-sm btn-outline-primary" 
                                                            wire:click="edit({{ $katalog->id }})">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-outline-danger ms-1" 
                                                            wire:click="delete({{ $katalog->id }})">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </td>
                                            @endif
                                        </tr>

                                        {{-- Modal for Abstrak View --}}
                                        @if($katalog->abstrak)
                                            <div class="modal fade" id="abstrakViewModal{{ $katalog->id }}" tabindex="-1">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Abstrak - {{ $katalog->nama }}</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <h6>{{ $katalog->judul }}</h6>
                                                            <hr>
                                                            <p style="text-align: justify;">{{ $katalog->abstrak }}</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @empty
                                        <tr>
                                            <td colspan="{{ $canManage ? '6' : '4' }}" class="text-center">
                                                <div class="py-4">
                                                    <i class="fas fa-book fa-3x text-muted mb-3"></i>
                                                    <h5>Belum Ada Katalog</h5>
                                                    <p class="text-muted">Tidak ada katalog TA yang tersedia</p>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    @endif

                    {{-- Pending Approval Tab - Hanya untuk Admin/Tendik --}}
                    @if($canManage && $activeTab === 'pending')
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Photo</th>
                                        <th>Mahasiswa</th>
                                        <th>NIM</th>
                                        <th>Judul</th>
                                        <th>Tanggal Submit</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($katalogsPending as $katalog)
                                        <tr>
                                            <td>
                                                @if($katalog->photo)
                                                    <img src="{{ asset('storage/' . $katalog->photo) }}" 
                                                        alt="Photo" 
                                                        class="img-thumbnail" 
                                                        style="width: 50px; height: 50px; object-fit: cover;">
                                                @else
                                                    <div class="bg-light d-flex align-items-center justify-content-center" 
                                                        style="width: 50px; height: 50px;">
                                                        <i class="fas fa-image text-muted"></i>
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                {{ $katalog->nama }}
                                                @if($katalog->user)
                                                    <br><small class="text-muted">{{ $katalog->user->name }}</small>
                                                @endif
                                            </td>
                                            <td>{{ $katalog->nim }}</td>
                                            <td class="text-truncate" style="max-width: 200px;">
                                                {{ $katalog->judul }}
                                                <br>
                                                <button class="btn btn-link btn-sm p-0" 
                                                        data-bs-toggle="modal" 
                                                        data-bs-target="#abstrakModal{{ $katalog->id }}">
                                                    <small><i class="fas fa-eye"></i> Lihat Abstrak</small>
                                                </button>
                                            </td>
                                            <td>
                                                {{ $katalog->created_at->format('d/m/Y H:i') }}
                                                <br>
                                                <small class="text-muted">{{ $katalog->created_at->diffForHumans() }}</small>
                                            </td>
                                            <td>
                                                {{-- FIX: Tambahkan wire:click dan wire:confirm --}}
                                                <div class="btn-group" role="group">
                                                    <button class="btn btn-sm btn-success" 
                                                            wire:click="approveKatalog({{ $katalog->id }})"
                                                            wire:confirm="Setujui katalog TA dari {{ $katalog->nama }}?">
                                                        <i class="fas fa-check"></i> Setujui
                                                    </button>
                                                    <button class="btn btn-sm btn-warning" 
                                                            wire:click="rejectKatalog({{ $katalog->id }})"
                                                            wire:confirm="Kirim notifikasi revisi ke {{ $katalog->nama }}?">
                                                        <i class="fas fa-edit"></i> Minta Revisi
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>

                                        {{-- Modal for Abstrak --}}
                                        <div class="modal fade" id="abstrakModal{{ $katalog->id }}" tabindex="-1">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Abstrak - {{ $katalog->nama }}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row mb-3">
                                                            <div class="col-md-4">
                                                                @if($katalog->photo)
                                                                    <img src="{{ asset('storage/' . $katalog->photo) }}" 
                                                                        alt="Cover TA" 
                                                                        class="img-fluid rounded">
                                                                @endif
                                                            </div>
                                                            <div class="col-md-8">
                                                                <h6><strong>{{ $katalog->judul }}</strong></h6>
                                                                <p><strong>Mahasiswa:</strong> {{ $katalog->nama }} ({{ $katalog->nim }})</p>
                                                                <p><strong>Tanggal Submit:</strong> {{ $katalog->created_at->format('d F Y') }}</p>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <h6><strong>Abstrak:</strong></h6>
                                                        <p style="text-align: justify; line-height: 1.6;">{{ $katalog->abstrak }}</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                        <button type="button" 
                                                                class="btn btn-success"
                                                                wire:click="approveKatalog({{ $katalog->id }})"
                                                                wire:confirm="Setujui katalog TA dari {{ $katalog->nama }}?"
                                                                data-bs-dismiss="modal">
                                                            <i class="fas fa-check"></i> Setujui
                                                        </button>
                                                        <button type="button" 
                                                                class="btn btn-warning"
                                                                wire:click="rejectKatalog({{ $katalog->id }})"
                                                                wire:confirm="Kirim notifikasi revisi ke {{ $katalog->nama }}?"
                                                                data-bs-dismiss="modal">
                                                            <i class="fas fa-edit"></i> Minta Revisi
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">
                                                <div class="py-4">
                                                    <i class="fas fa-check-circle fa-3x text-success mb-3"></i>
                                                    <h5>Semua katalog sudah disetujui</h5>
                                                    <p class="text-muted">Tidak ada katalog yang menunggu persetujuan</p>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    @endif
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

    @if($canAdd)
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
    @endif

    @livewire('katalog.edit')
    <x-modal.delete :deleteModal="$deleteModal" />

</div>