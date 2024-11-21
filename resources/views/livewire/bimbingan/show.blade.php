<div>
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Bimbingan</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Pengajuan TA</a></li>
                        <li class="breadcrumb-item active">Bimbingan</li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-body">
                    <x-profile-header />
                </div>
                <!-- end card body -->
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <h5 class="card-title">Riwayat Bimbingan<span class="text-muted fw-normal ms-2">({{ $bimbingans->count() }})</span></h5>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="d-flex flex-wrap align-items-center justify-content-end gap-2 mb-3">
                                <div>
                                    <button wire:click="openModal()" class="btn btn-primary"><i class="bx bx-plus me-1"></i> Tambah Baru</button>
                                    <a href="{{ route('pdf:form-ta-006', ['userId' => auth()->id()]) }}" target="_blank" class="btn btn-info"><i class="fa fa-file-pdf me-1"></i> Download Form TA.006</a>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- end row -->

                    <div class="table-responsive mb-4">
                        <table class="table align-middle dt-responsive table-check nowrap" style="border-collapse: collapse; border-spacing: 0 8px; width: 100%;">
                            <thead>
                              <tr>
                                <th scope="col" style="width: 50px;">No</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Dosen Pembimbing</th>
                                <th scope="col">Keterangan</th>
                                <th scope="col">Hasil Bimbingan</th>
                                <th scope="col">Status</th>
                                <th style="width: 150px; min-width: 150px;text-align:center">Aksi</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach($bimbingans as $bimbingan)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>
                                        <a href="#" class="text-body">{{ \Carbon\Carbon::parse($bimbingan->tanggal)->isoFormat('DD/MM/YYYY') }}</a>
                                    </td>
                                    <td>
                                        {{ $bimbingan->dosens->name }}
                                    </td>
                                    <td>{{ $bimbingan->ket_bimbingan }}</td>
                                    <td style="white-space: pre-wrap">{{ $bimbingan->hasil_bimbingan }}</td>
                                    <td>
                                        @if($bimbingan->status === 'Approved')
                                        <span class="badge bg-success">{{ $bimbingan->status }}</span>
                                        @elseif($bimbingan->status === 'created')
                                        <span class="badge bg-primary">Unapproved</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($bimbingan->status !== 'Approved')
                                        <button class="btn btn-info btn-sm" wire:click="edit('{{ $bimbingan->id }}')">Update</button>
                                        <button class="btn btn-danger btn-sm" wire:click="setDeleteId('{{ $bimbingan->id }}')">Hapus</button>
                                        @else
                                        <i class="fas fa-check text-success"></i>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- end table -->
                    </div>
                    {{ $bimbingans->links('vendor.livewire.bootstrap') }}
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-3">Pembimbing</h5>

                    <div class="list-group list-group-flush">
                        @if(auth()->user()->mahasiswa->pengajuanTA)
                        <a href="#" class="list-group-item list-group-item-action">
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm flex-shrink-0 me-3">
                                    <img src="{{ asset('dist/assets/images/users/avatar.png')}}" alt="" class="img-thumbnail rounded-circle">
                                </div>
                                <div class="flex-grow-1">
                                    <div>
                                        <h5 class="font-size-14 mb-1">{{ auth()->user()->mahasiswa->pengajuanTA->riwayatPengajuans()->where('user_id', auth()->user()->mahasiswa->pengajuanTA->pembimbing_1)->where('riwayat', 'Menyetujui Judul')->first() ? auth()->user()->mahasiswa->pengajuanTA->pembimbing1->name : 'Menunggu Persetujuan' }}</h5>
                                        <p class="font-size-13 text-muted mb-0">Pembimbing 1</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm flex-shrink-0 me-3">
                                    <img src="{{ asset('dist/assets/images/users/avatar.png')}}" alt="" class="img-thumbnail rounded-circle">
                                </div>
                                <div class="flex-grow-1">
                                    <div>
                                        <h5 class="font-size-14 mb-1">{{ auth()->user()->mahasiswa->pengajuanTA->riwayatPengajuans()->where('user_id', auth()->user()->mahasiswa->pengajuanTA->pembimbing_2)->where('riwayat', 'Menyetujui Judul')->first() ? auth()->user()->mahasiswa->pengajuanTA->pembimbing2->name : 'Menunggu Persetujuan'}}</h5>
                                        <p class="font-size-13 text-muted mb-0">Pembimbing 2</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                        @else
                        <a href="#" class="list-group-item list-group-item-action">
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm flex-shrink-0 me-3">
                                    <i class="fa fa-file fa-2x"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <div>
                                        <h5 class="font-size-14 mb-1">Belum mengajukan Judul TA</h5>
                                        <p class="font-size-13 text-muted mb-0">Tidak ada pembimbing</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                        @endif
                    </div>
                </div>
                <!-- end card body -->
            </div>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-3">Penguji</h5>

                    <div class="list-group list-group-flush">
                        @if(false)
                        <a href="#" class="list-group-item list-group-item-action">
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm flex-shrink-0 me-3">
                                    <img src="{{ asset('dist/assets/images/users/avatar.png')}}" alt="" class="img-thumbnail rounded-circle">
                                </div>
                                <div class="flex-grow-1">
                                    <div>
                                        <h5 class="font-size-14 mb-1">{{ auth()->user()->mahasiswa->pengajuanTA ? auth()->user()->mahasiswa->pengajuanTA->pembimbing1->name : '' }}</h5>
                                        <p class="font-size-13 text-muted mb-0">Pembimbing 1</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm flex-shrink-0 me-3">
                                    <img src="{{ asset('dist/assets/images/users/avatar.png')}}" alt="" class="img-thumbnail rounded-circle">
                                </div>
                                <div class="flex-grow-1">
                                    <div>
                                        <h5 class="font-size-14 mb-1">{{  auth()->user()->mahasiswa->pengajuanTA ? auth()->user()->mahasiswa->pengajuanTA->pembimbing2->name : '' }}</h5>
                                        <p class="font-size-13 text-muted mb-0">Pembimbing 2</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                        @else
                        <a href="#" class="list-group-item list-group-item-action">
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm flex-shrink-0 me-3">
                                    <i class="fa fa-file fa-2x"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <div>
                                        <h5 class="font-size-14 mb-1">Penguji belum ditentukan</h5>
                                        <p class="font-size-13 text-muted mb-0">Tidak ada penguji</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                        @endif
                    </div>
                </div>
                <!-- end card body -->
            </div>
        </div>
    </div>
    <div class="modal fade @if($addModal) show @endif" @if($addModal) style="display: block" @endif id="tambahData" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Form Bimbingan Tugas Akhir</h1>
                    <button type="button" class="btn-close" wire:click="closeModal()" aria-label="Close"></button>
                </div>
                <form action="{{ route('ta:bimbingan:store') }}" method="POST">
                    <div class="modal-body">
                        <div class="form-container">
                            @csrf
                            <div class="mb-3">
                                <label for="tanggal" class="form-label">Tanggal</label>
                                <input type="date" class="form-control" id="tanggal" name="tanggal">
                            </div>
                            <div class="mb-3">
                                <label for="dosen" class="form-label">Dosen Pembimbing</label>
                                <select name="dosen" required id="dosen" class="form-control">
                                    <option value="">Pilih Dosen Pembimbing</option>
                                    @foreach($dosens as $dosen)
                                        @if(auth()->user()->mahasiswa->pengajuanTA && in_array($dosen->user_id, [auth()->user()->mahasiswa->pengajuanTA->pembimbing_1, auth()->user()->mahasiswa->pengajuanTA->pembimbing_2]))
                                            <option value="{{ $dosen->user_id }}">{{ $dosen->nama_dosen }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="ket_bimbingan" class="form-label">Keterangan</label>
                                <input type="text" class="form-control" id="ket_bimbingan" name="ket_bimbingan"
                                    value="" required>
                            </div>
                            <div class="mb-3">
                                <label for="hasil_bimbingan" class="form-label">Hasil Bimbingan</label>
                                <textarea class="form-control" id="hasil_bimbingan" name="hasil_bimbingan" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" wire:click="closeModal()" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @livewire('bimbingan.edit')
    <x-modal.delete :deleteModal="$deleteModal" />
</div>