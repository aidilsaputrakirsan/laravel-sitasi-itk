<div>
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Katalog TA</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">TA</a></li>
                        <li class="breadcrumb-item active">Katalog TA</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-9">
            <!-- Status Card -->
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-3">Status Kelayakan Katalog TA</h5>
                    
                    @if($sidang)
                        <div class="row mb-3">
                            <div class="col-md-3"><strong>Status Sidang TA:</strong></div>
                            <div class="col-md-9">
                                <span class="badge bg-success">{{ $sidang->status }}</span>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-3"><strong>Status Revisi:</strong></div>
                            <div class="col-md-9">
                                <div class="d-flex gap-2 flex-wrap">
                                    <span class="badge {{ $sidang->revisi_pembimbing_1 ? 'bg-success' : 'bg-warning' }}">
                                        Pembimbing 1: {{ $sidang->revisi_pembimbing_1 ? 'Selesai' : 'Belum Selesai' }}
                                    </span>
                                    <span class="badge {{ $sidang->revisi_pembimbing_2 ? 'bg-success' : 'bg-warning' }}">
                                        Pembimbing 2: {{ $sidang->revisi_pembimbing_2 ? 'Selesai' : 'Belum Selesai' }}
                                    </span>
                                    <span class="badge {{ $sidang->revisi_penguji_1 ? 'bg-success' : 'bg-warning' }}">
                                        Penguji 1: {{ $sidang->revisi_penguji_1 ? 'Selesai' : 'Belum Selesai' }}
                                    </span>
                                    <span class="badge {{ $sidang->revisi_penguji_2 ? 'bg-success' : 'bg-warning' }}">
                                        Penguji 2: {{ $sidang->revisi_penguji_2 ? 'Selesai' : 'Belum Selesai' }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        @if($isEligible)
                            <div class="alert alert-success">
                                <i class="fas fa-check-circle"></i> Anda memenuhi syarat untuk mengisi Katalog TA
                            </div>
                        @else
                            <div class="alert alert-warning">
                                <i class="fas fa-exclamation-triangle"></i> {{ $displayError }}
                            </div>
                        @endif
                    @else
                        <div class="alert alert-danger">
                            <i class="fas fa-times-circle"></i> {{ $displayError }}
                        </div>
                    @endif
                </div>
            </div>

            <!-- Form Katalog TA -->
            @if($isEligible)
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            {{ $katalog ? 'Edit Katalog TA' : 'Formulir Katalog TA' }}
                        </h5>
                        @if($katalog)
                            <div class="mt-2">
                                <span class="badge {{ $katalog->is_approved ? 'bg-success' : 'bg-warning' }}">
                                    {{ $katalog->is_approved ? 'Disetujui Admin' : 'Menunggu Persetujuan Admin' }}
                                </span>
                            </div>
                        @endif
                    </div>
                    <div class="card-body">
                        <form wire:submit="submit">
                            <!-- Photo Section -->
                            <div class="row mb-4">
                                <div class="col-md-3">
                                    <label class="form-label">Photo Cover TA</label>
                                    @if($katalog && $katalog->photo && !$editablePhoto)
                                        <div class="text-center">
                                            <img src="{{ asset('storage/' . $katalog->photo) }}" 
                                                 alt="Cover TA" 
                                                 class="img-thumbnail mb-2" 
                                                 style="max-height: 200px;">
                                            <br>
                                            <button type="button" 
                                                    class="btn btn-outline-secondary btn-sm"
                                                    wire:click="toggleEditPhoto">
                                                <i class="fas fa-edit"></i> Ganti Photo
                                            </button>
                                        </div>
                                    @else
                                        <input type="file" 
                                               class="form-control" 
                                               wire:model="photo" 
                                               accept="image/*">
                                        @error('photo') 
                                            <small class="text-danger">{{ $message }}</small> 
                                        @enderror
                                        
                                        @if($editablePhoto)
                                            <button type="button" 
                                                    class="btn btn-outline-secondary btn-sm mt-2"
                                                    wire:click="toggleEditPhoto">
                                                <i class="fas fa-times"></i> Batal
                                            </button>
                                        @endif
                                    @endif
                                </div>
                                
                                <div class="col-md-9">
                                    <!-- Data Form -->
                                    @if($katalog && !$editableData)
                                        <!-- Preview Mode -->
                                        <div class="row mb-3">
                                            <div class="col-md-3"><label class="form-label">Nama:</label></div>
                                            <div class="col-md-9">
                                                <p class="form-control-plaintext">{{ $katalog->nama }}</p>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-3"><label class="form-label">NIM:</label></div>
                                            <div class="col-md-9">
                                                <p class="form-control-plaintext">{{ $katalog->nim }}</p>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-3"><label class="form-label">Judul TA:</label></div>
                                            <div class="col-md-9">
                                                <p class="form-control-plaintext">{{ $katalog->judul }}</p>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-3"><label class="form-label">Abstrak:</label></div>
                                            <div class="col-md-9">
                                                <p class="form-control-plaintext">{{ $katalog->abstrak }}</p>
                                            </div>
                                        </div>
                                        
                                        <button type="button" 
                                                class="btn btn-outline-primary"
                                                wire:click="toggleEditData">
                                            <i class="fas fa-edit"></i> Edit Data
                                        </button>
                                    @else
                                        <!-- Edit Mode -->
                                        <div class="row mb-3">
                                            <div class="col-md-3">
                                                <label class="form-label">Nama <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-md-9">
                                                <input type="text" 
                                                       class="form-control" 
                                                       wire:model="nama" 
                                                       placeholder="Nama Lengkap">
                                                @error('nama') 
                                                    <small class="text-danger">{{ $message }}</small> 
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-3">
                                                <label class="form-label">NIM <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-md-9">
                                                <input type="text" 
                                                       class="form-control" 
                                                       wire:model="nim" 
                                                       placeholder="Nomor Induk Mahasiswa">
                                                @error('nim') 
                                                    <small class="text-danger">{{ $message }}</small> 
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-3">
                                                <label class="form-label">Judul TA <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-md-9">
                                                <textarea class="form-control" 
                                                          wire:model="judul" 
                                                          rows="3" 
                                                          placeholder="Judul Tugas Akhir"></textarea>
                                                @error('judul') 
                                                    <small class="text-danger">{{ $message }}</small> 
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-3">
                                                <label class="form-label">Abstrak <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-md-9">
                                                <textarea class="form-control" 
                                                          wire:model="abstrak" 
                                                          rows="6" 
                                                          placeholder="Abstrak Tugas Akhir"></textarea>
                                                @error('abstrak') 
                                                    <small class="text-danger">{{ $message }}</small> 
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="d-flex gap-2">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fas fa-save"></i> {{ $katalog ? 'Update' : 'Submit' }}
                                            </button>
                                            
                                            @if($editableData)
                                                <button type="button" 
                                                        class="btn btn-outline-secondary"
                                                        wire:click="toggleEditData">
                                                    <i class="fas fa-times"></i> Batal
                                                </button>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            @endif
        </div>

        <!-- Sidebar Info -->
        <div class="col-md-3">
            @if($sidang)
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-3">Info Sidang TA</h5>
                        <div class="list-group list-group-flush">
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <span>Tanggal Sidang:</span>
                                <span class="badge bg-primary">{{ \Carbon\Carbon::parse($sidang->tanggal)->format('d/m/Y') }}</span>
                            </div>
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <span>Status:</span>
                                <span class="badge bg-success">{{ $sidang->status }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @if($katalog)
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-3">Status Katalog</h5>
                        <div class="list-group list-group-flush">
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <span>Dibuat:</span>
                                <span class="badge bg-info">{{ \Carbon\Carbon::parse($katalog->created_at)->format('d/m/Y') }}</span>
                            </div>
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <span>Status:</span>
                                <span class="badge {{ $katalog->is_approved ? 'bg-success' : 'bg-warning' }}">
                                    {{ $katalog->is_approved ? 'Disetujui' : 'Menunggu' }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>