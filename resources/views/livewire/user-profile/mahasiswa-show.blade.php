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
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->

            <div class="tab-content">
                <div class="tab-pane active" id="overview" role="tabpanel">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Change Profile</h5>
                        </div>
                        <div class="card-body">
                            <div>
                                <div class="pb-3">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="Photo Profile">Ganti Foto Profile</label>
                                                <input type="file" class="form-control" wire:model="photo">
                                                @error('photo') <small class="text-danger">{{ $message }}</small> @enderror
                                            </div>
                                            <div class="form-group mt-4 text-end">
                                                <button class="btn btn-info" wire:click="savePhoto()">Update</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- end card body -->
                    </div>
                    <!-- end card -->

                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Data Tugas Akhir</h5>
                        </div>
                        <div class="card-body">
                            <div>
                                <div class="pb-3">
                                    <div class="row">
                                        <div class="col-xl-2">
                                            <div>
                                                <h5 class="font-size-15">Judul TA :</h5>
                                            </div>
                                        </div>
                                        <div class="col-xl">
                                            <div class="text-muted">
                                                <p class="mb-2">
                                                    {{ auth()->user()->mahasiswa->pengajuanTA->judul ?? 'Belum ada judul' }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="pb-3">
                                    <div class="row">
                                        <div class="col-xl-2">
                                            <div>
                                                <h5 class="font-size-15">Pembimbing 1 :</h5>
                                            </div>
                                        </div>
                                        <div class="col-xl">
                                            <div class="text-muted">
                                                <p class="mb-2">
                                                    {{ auth()->user()->mahasiswa->pengajuanTA->pembimbing1->name ?? 'Pembimbing 1 belum ditentukan' }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="pb-3">
                                    <div class="row">
                                        <div class="col-xl-2">
                                            <div>
                                                <h5 class="font-size-15">Pembimbing 2 :</h5>
                                            </div>
                                        </div>
                                        <div class="col-xl">
                                            <div class="text-muted">
                                                <p class="mb-2">
                                                    {{ auth()->user()->mahasiswa->pengajuanTA->pembimbing2->name ?? 'Pembimbing 2 belum ditentukan' }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="pb-3">
                                    <div class="row">
                                        <div class="col-xl-2">
                                            <div>
                                                <h5 class="font-size-15">Penguji 1 :</h5>
                                            </div>
                                        </div>
                                        <div class="col-xl">
                                            <div class="text-muted">
                                                <p class="mb-2">
                                                    {{ auth()->user()->mahasiswa->pengajuanTA->jadwal->penguji1->name ?? 'Penguji 1 belum ditentukan' }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="pb-3">
                                    <div class="row">
                                        <div class="col-xl-2">
                                            <div>
                                                <h5 class="font-size-15">Penguji 2 :</h5>
                                            </div>
                                        </div>
                                        <div class="col-xl">
                                            <div class="text-muted">
                                                <p class="mb-2">
                                                    {{ auth()->user()->mahasiswa->pengajuanTA->jadwal->penguji2->name ?? 'Penguji 2 belum ditentukan' }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="pb-3">
                                    <div class="row">
                                        <div class="col-xl-2">
                                            <div>
                                                <h5 class="font-size-15">Tanggal Seminar Proposal :</h5>
                                            </div>
                                        </div>
                                        <div class="col-xl">
                                            <div class="text-muted">
                                                <p class="mb-2">
                                                    @if(auth()->user()->mahasiswa->pengajuanTA->jadwal)
                                                        {{ \Carbon\Carbon::parse(auth()->user()->mahasiswa->pengajuanTA->jadwal->tanggal_sempro)->isoFormat('dddd, D MMMM YYYY') }}, 
                                                        Waktu ({{ auth()->user()->mahasiswa->pengajuanTA->jadwal->waktu_mulai . ' - '. auth()->user()->mahasiswa->pengajuanTA->jadwal->waktu_selesai }}),
                                                        Ruangan ({{ auth()->user()->mahasiswa->pengajuanTA->jadwal->ruangan }})
                                                    @else
                                                        <span>Tanggal Seminar belum ditentukan</span>
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="pb-3">
                                    <div class="row">
                                        <div class="col-xl-2">
                                            <div>
                                                <h5 class="font-size-15">Tanggal Sidang TA :</h5>
                                            </div>
                                        </div>
                                        <div class="col-xl">
                                            <div class="text-muted">
                                                <p class="mb-2">
                                                    @if(auth()->user()->mahasiswa->pengajuanTA->jadwalTa)
                                                        {{ \Carbon\Carbon::parse(auth()->user()->mahasiswa->pengajuanTA->jadwalTa->tanggal_sidang)->isoFormat('dddd, D MMMM YYYY') }}, 
                                                        Waktu ({{ auth()->user()->mahasiswa->pengajuanTA->jadwalTa->waktu_mulai . ' - '. auth()->user()->mahasiswa->pengajuanTA->jadwalTa->waktu_selesai }}),
                                                        Ruangan ({{ auth()->user()->mahasiswa->pengajuanTA->jadwalTa->ruangan }})
                                                    @else
                                                        <span>Tanggal Sidang TA belum ditentukan</span>
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- end card body -->
                    </div>

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
</div>