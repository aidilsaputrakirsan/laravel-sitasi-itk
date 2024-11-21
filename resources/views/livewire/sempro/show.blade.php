<div>
    <div>
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Seminar Proposal</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Pengajuan TA</a></li>
                            <li class="breadcrumb-item active">Seminar Proposal</li>
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

                <div class="tab-content">
                    <div class="tab-pane active">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Formulir Pendaftaran Seminar Proposal Tugas Akhir
                                </h5>
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
                                                        {{ auth()->user()->mahasiswa->pengajuanTA->judul ?? '' }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="pb-3">
                                        <div class="row">
                                            <div class="col-xl-2">
                                                <div>
                                                    <h5 class="font-size-15">Status :</h5>
                                                </div>
                                            </div>
                                            <div class="col-xl">
                                                <div class="text-muted">
                                                    <p class="mb-2">
                                                        @if (auth()->user()->mahasiswa->pengajuanTA)
                                                            @if (auth()->user()->mahasiswa->pengajuanTA->approve_pembimbing1 &&
                                                                    auth()->user()->mahasiswa->pengajuanTA->approve_pembimbing2)
                                                                <span class="badge bg-success"
                                                                    style="font-size: 10pt;">Disetujui Seminar
                                                                    Proposal</span>
                                                            @else
                                                                <span class="badge bg-primary"
                                                                    style="font-size: 10pt;">Menunggu persetujuan Dosen
                                                                    Pembimbing</span>
                                                            @endif
                                                        @else
                                                            <span class="badge bg-secondary"
                                                                style="font-size: 10pt;">Belum mengajukan data TA</span>
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="py-3">
                                        <div class="row">
                                            <div class="col-xl-2">
                                                <div>
                                                    <h5 class="font-size-15">File Pendukung :</h5>
                                                </div>
                                            </div>
                                            <div class="col-xl">
                                                <div class="text-muted">
                                                    <ul class="list-unstyled mb-0">
                                                        <li class="py-1">
                                                            <div class="form-group">
                                                                @if ($isApprovePembimbing1 && $isApprovePembimbing2)
                                                                    <a href="{{ route('pdf:form-ta-001', ['userId' => auth()->id()]) }}"
                                                                        target="_blank">
                                                                        <h6 class="text-primary" style="margin-top: 0.2rem;margin-bottom: 0.2rem;"> <i
                                                                                class="fa fa-file-pdf"></i> Formulir
                                                                            Usulan Dosen Pembimbing (Form. TA-001)</h6>
                                                                    </a>
                                                                @else
                                                                    <a href="javascript:;"
                                                                        title="Dosen Pembimbing belum menyetujui judul">
                                                                        <h6 class="text-secondary" style="margin-top: 0.2rem;margin-bottom: 0.2rem;"> <i
                                                                                class="fa fa-file-pdf"></i> Formulir
                                                                            Usulan Dosen Pembimbing (Form. TA-001)</h6>
                                                                    </a>
                                                                @endif
                                                            </div>
                                                        </li>
                                                        <li class="py-1">
                                                            <div class="form-group">
                                                                @if (auth()->user()->mahasiswa->pengajuanTA &&
                                                                        auth()->user()->mahasiswa->pengajuanTA->approve_pembimbing1 &&
                                                                        auth()->user()->mahasiswa->pengajuanTA->approve_pembimbing2)
                                                                    <a href="{{ route('pdf:form-ta-002', ['userId' => auth()->id()]) }}"
                                                                        target="_blank">
                                                                        <h6 class="text-primary" style="margin-top: 0.2rem;margin-bottom: 0.2rem;"> <i
                                                                                class="fa fa-file-pdf"></i> FORMULIR
                                                                            PERMOHONAN SEMINAR PROPOSAL TUGAS AKHIR
                                                                            (Form. TA-002)</h6>
                                                                    </a>
                                                                @else
                                                                    <a href="javascript:;"
                                                                        title="Dosen Pembimbing belum menyetujui permohonan Seminar Proposal">
                                                                        <h6 class="text-secondary" style="margin-top: 0.2rem;margin-bottom: 0.2rem;"> <i
                                                                                class="fa fa-file-pdf"></i> FORMULIR
                                                                            PERMOHONAN SEMINAR PROPOSAL TUGAS AKHIR
                                                                            (Form. TA-002)</h6>
                                                                    </a>
                                                                @endif
                                                            </div>
                                                        </li>
                                                        <li class="py-1">
                                                            <div class="form-group">
                                                                <a href="{{ route('pdf:form-ta-006', ['userId' => auth()->id()]) }}"
                                                                    target="_blank">
                                                                    <h6 class="text-primary" style="margin-top: 0.2rem;margin-bottom: 0.2rem;"> <i
                                                                            class="fa fa-file-pdf" ></i> LEMBAR
                                                                        KONSULTASI BIMBINGAN (Form. TA-006)</h6>
                                                                </a>
                                                            </div>
                                                        </li>
                                                        <li class="py-1">
                                                            <div class="form-group">
                                                                @if ($sempros->first())
                                                                    <div style="display: flex; gap: 10px;">
                                                                        <a href="{{ url('storage/' . $sempros->first()->form_ta_012) }}"
                                                                            target="_blank">
                                                                            <h6 for="form_ta001" class="text-primary"
                                                                                style="margin-top: 0.2rem;margin-bottom: 0.2rem;">
                                                                                <i class="fa fa-file-pdf"></i> Lembar
                                                                                Kehadiran Seminar Proposal Tugas Akhir
                                                                                (Form. TA-012)</h6>
                                                                        </a>
                                                                        @if($sempros->first()->status !== 'Diterima')
                                                                        <span class="btn btn-outline-secondary btn-sm"
                                                                            wire:click="toggleEditLembar()"
                                                                            style="padding-top: 0.05rem;padding-bottom: 0.05rem;"><i
                                                                                class="fas fa-pencil-alt"></i></span>
                                                                        @endif
                                                                    </div>
                                                                @else
                                                                    <h6 for="form_ta012">Lembar Kehadiran Seminar
                                                                        Proposal Tugas Akhir (Form. TA-012)</h6>
                                                                @endif
                                                                @if(!$sempros->first())
                                                                <input type="file" id="form_ta012"
                                                                        wire:model="form_ta012" accept=".pdf"
                                                                        class="form-control mt-2">
                                                                @error('form_ta012') <small
                                                                        class="text-danger">{{ $message }}</small>
                                                                @enderror
                                                                @endif

                                                                @if($editableLembar)
                                                                    <input type="file" id="form_ta012"
                                                                        wire:model="form_ta012" accept=".pdf"
                                                                        class="form-control mt-2">
                                                                    @error('form_ta012') <small
                                                                            class="text-danger">{{ $message }}</small>
                                                                    @enderror
                                                                    <div class="text-end">
                                                                        <button wire:click="saveLembar()"
                                                                            class="btn btn-primary mt-2">Update</button>
                                                                    </div>
                                                                    @endif
                                                                </div>
                                                            </li>
                                                            <li class="py-1">
                                                                <div class="form-group">
                                                                    @if ($sempros->first())
                                                                        <div style="display: flex; gap: 10px;">
                                                                            <a href="{{ url('storage/' . $sempros->first()->proposal_ta) }}"
                                                                                target="_blank">
                                                                                <h6 for="form_ta001" class="text-primary"
                                                                                    style="margin-top: 0.2rem;margin-bottom: 0.2rem;">
                                                                                    <i class="fa fa-file-pdf"></i> Proposal
                                                                                    Tugas Akhir</h6>
                                                                            </a>
                                                                            @if($sempros->first()->status !== 'Diterima')
                                                                            <span class="btn btn-outline-secondary btn-sm"
                                                                                wire:click="toggleEditProposal()"
                                                                                style="padding-top: 0.05rem;padding-bottom: 0.05rem;"><i
                                                                                    class="fas fa-pencil-alt"></i></span>
                                                                            @endif
                                                                        </div>
                                                                    @else
                                                                        <h6 for="proposal_ta">Proposal Tugas Akhir</h6>
                                                                    @endif
                                                                    @if(!$sempros->first())
                                                                        <input type="file" id="proposal_ta"
                                                                            wire:model="proposal_ta" accept=".pdf"
                                                                            class="form-control mt-2">
                                                                        @error('proposal_ta') <small
                                                                                class="text-danger">{{ $message }}</small>
                                                                        @enderror
                                                                    @endif
                                                                    @if ($editableProposal)
                                                                        <input type="file" id="proposal_ta"
                                                                            wire:model="proposal_ta" accept=".pdf"
                                                                            class="form-control mt-2">
                                                                        @error('proposal_ta') <small
                                                                                class="text-danger">{{ $message }}</small>
                                                                        @enderror
                                                                        <div class="text-end">
                                                                            <button wire:click="saveProposal()"
                                                                                class="btn btn-primary mt-2">Update</button>
                                                                        </div>
                                                                        @endif

                                                                    </div>
                                                                </li>

                                                            <li class="py-1">
                                                                <div class="form-group">
                                                                    @if ($sempros->first())
                                                                        <div style="display: flex; gap: 10px;">
                                                                            <a href="{{ url('storage/' . $sempros->first()->bukti_plagiasi) }}"
                                                                                target="_blank">
                                                                                <h6 for="form_ta001" class="text-primary"
                                                                                    style="margin-top: 0.2rem;margin-bottom: 0.2rem;">
                                                                                    <i class="fa fa-image"></i> Bukti
                                                                                    Plagiasi (Turnitin)</h6>
                                                                            </a>
                                                                            @if($sempros->first()->status !== 'Diterima')
                                                                            <span class="btn btn-outline-secondary btn-sm"
                                                                                wire:click="toggleEditPlagiasi()"
                                                                                style="padding-top: 0.05rem;padding-bottom: 0.05rem;"><i
                                                                                    class="fas fa-pencil-alt"></i></span>
                                                                            @endif
                                                                        </div>
                                                                    @else
                                                                        <h6 for="turnitin">Bukti Plagiasi (Turnitin)</h6>
                                                                    @endif

                                                                    @if(!$sempros->first())
                                                                        <input type="file" id="turnitin"
                                                                            wire:model="bukti_plagiasi"
                                                                            class="mt-2 form-control"
                                                                            accept=".pdf, .jpg, .jpeg, .png"
                                                                            class="form-control">
                                                                        @error('bukti_plagiasi') <small
                                                                                class="text-danger">{{ $message }}</small>
                                                                        @enderror
                                                                    @endif

                                                                    @if ($editablePlagiasi)
                                                                        <input type="file" id="turnitin"
                                                                            wire:model="bukti_plagiasi"
                                                                            class="mt-2 form-control"
                                                                            accept=".pdf, .jpg, .jpeg, .png"
                                                                            class="form-control">
                                                                        @error('bukti_plagiasi') <small
                                                                                class="text-danger">{{ $message }}</small>
                                                                        @enderror
                                                                        <div class="text-end">
                                                                            <button wire:click="savePlagiasi()"
                                                                                class="btn btn-primary mt-2">Update</button>
                                                                        </div>
                                                                    @endif
                                                                    </div>
                                                                </li>
                                                                <li class="py-1">
                                                                    @if ($isPeriodeActive)
                                                                        <small class="text-danger">Tendik belum mengaktifkan
                                                                            gelombang pendaftaran. Tidak dapat melakukan
                                                                            pendaftaran</small>
                                                                    @endif
                                                                    <small
                                                                        class="text-danger"><b>{{ $displayError }}</b></small>
                                                                    <div class="text-end">
                                                                        @if (!$sempros->first())
                                                                            <button wire:click="submit"
                                                                                class="btn btn-primary">Submit</button>
                                                                        @endif
                                                                    </div>
                                                                </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end card body -->
                                    </div>
                                </div>
                            </div>
                            <div class="main-card mb-3 card">
                                <div class="card-body">
                                    <h5 class="card-title">Riwayat</h5>
                                    <div class="vertical-timeline vertical-timeline--animate vertical-timeline--one-column">
                                        @forelse($riwayats as $riwayat)
                                            <div class="vertical-timeline-item vertical-timeline-element">
                                                <div>
                                                    <span class="vertical-timeline-element-icon bounce-in">
                                                        <i class="badge badge-dot badge-dot-xl badge-success"></i>
                                                    </span>
                                                    <div class="vertical-timeline-element-content bounce-in">
                                                        <h4 class="timeline-title px-2 p-1
                                                        @if($riwayat->status === 'Revisi Pengajuan')
                                                        badge bg-warning 
                                                        @elseif($riwayat->status === 'Tolak Seminar Proposal')
                                                        badge bg-danger
                                                        @elseif($riwayat->status === 'Terima Seminar Proposal' || $riwayat->status === 'Lembar Revisi Seminar Proposal Disetujui' || $riwayat->status === 'Sidang TA Disetujui')
                                                        badge bg-success
                                                        @else
                                                        badge bg-primary 
                                                        @endif
                                                        ">
                                                            <span >{{ $riwayat->riwayat }}</span></h4>
                                                        <p>{{ $riwayat->user->name }}, {{ $riwayat->keterangan }} pada <a
                                                                href="javascript:void(0);"
                                                                data-abc="true">{{ \Carbon\Carbon::parse($riwayat->created_at)->format('H:i A') }}</a>
                                                        </p>
                                                        <span
                                                            class="vertical-timeline-element-date">{{ \Carbon\Carbon::parse($riwayat->created_at)->format('Y-m-d') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <div class="vertical-timeline-item vertical-timeline-element">
                                                <div>
                                                    <span class="vertical-timeline-element-icon bounce-in">
                                                        <i class="badge badge-dot badge-dot-xl badge-success"></i>
                                                    </span>
                                                    <div class="vertical-timeline-element-content bounce-in">
                                                        <h4 class="timeline-title">Belum Ada Riwayat</h4>
                                                        <p>Tidak ada riwayat pendaftaran Seminar Proposal</p>
                                                        <span
                                                            class="vertical-timeline-element-date">{{ \Carbon\Carbon::now()->format('Y-m-d') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title mb-3">Pembimbing</h5>
                                    <div class="list-group list-group-flush">
                                        @if (auth()->user()->mahasiswa->pengajuanTA)
                                            <a href="#" class="list-group-item list-group-item-action">
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-sm flex-shrink-0 me-3">
                                                        <img src="{{ asset('dist/assets/images/users/avatar.png') }}"
                                                            alt="" class="img-thumbnail rounded-circle">
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <div>
                                                            <h5 class="font-size-14 mb-1">
                                                                {{ auth()->user()->mahasiswa->pengajuanTA->pembimbing1->name }}
                                                            </h5>
                                                            <p class="font-size-13 text-muted mb-0">Dosen Pembimbing 1</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action">
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-sm flex-shrink-0 me-3">
                                                        <img src="{{ asset('dist/assets/images/users/avatar.png') }}"
                                                            alt="" class="img-thumbnail rounded-circle">
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <div>
                                                            <h5 class="font-size-14 mb-1">
                                                                {{ auth()->user()->mahasiswa->pengajuanTA->pembimbing2->name }}
                                                            </h5>
                                                            <p class="font-size-13 text-muted mb-0">Dosen Pembimbing 2</p>
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
                                        @if($jadwalSeminar && $jadwalSeminar->periode->is_tampilkan)
                                            
                                            <a href="#" class="list-group-item list-group-item-action">
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-sm flex-shrink-0 me-3">
                                                        <img src="{{ asset('dist/assets/images/users/avatar.png') }}"
                                                            alt="" class="img-thumbnail rounded-circle">
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <div>
                                                            <h5 class="font-size-14 mb-1">
                                                                {{ $jadwalSeminar->penguji1 ? $jadwalSeminar->penguji1->name : 'Penguji belum ditentukan' }}
                                                            </h5>
                                                            <p class="font-size-13 text-muted mb-0">Dosen Penguji 1</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action">
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-sm flex-shrink-0 me-3">
                                                        <img src="{{ asset('dist/assets/images/users/avatar.png') }}"
                                                            alt="" class="img-thumbnail rounded-circle">
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <div>
                                                            <h5 class="font-size-14 mb-1">
                                                                {{ $jadwalSeminar->penguji2 ? $jadwalSeminar->penguji2->name : 'Penguji belum ditentukan' }}
                                                            </h5>
                                                            <p class="font-size-13 text-muted mb-0">Dosen Penguji 2</p>
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

                            @if($jadwalSeminar && $jadwalSeminar->periode->is_tampilkan)
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title mb-3">Tempat & Tanggal</h5>

                                        <div class="list-group list-group-flush">
                                            <a href="#" class="list-group-item list-group-item-action">
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-sm flex-shrink-0 me-3">
                                                        <i class="fa fa-calendar fa-2x"></i>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <div>
                                                            <h5 class="font-size-14 mb-1">Tanggal</h5>
                                                            <p class="font-size-13 text-muted mb-0">{{ \Carbon\Carbon::parse($jadwalSeminar->tanggal_sempro)->isoFormat('dddd, D MMMM YYYY') }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action">
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-sm flex-shrink-0 me-3">
                                                        <i class="fa fa-clock fa-2x"></i>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <div>
                                                            <h5 class="font-size-14 mb-1">Waktu</h5>
                                                            <p class="font-size-13 text-muted mb-0">{{ $jadwalSeminar->waktu_mulai }} - {{ $jadwalSeminar->waktu_selesai }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action">
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-sm flex-shrink-0 me-3">
                                                        <i class="fa fa-university fa-2x"></i>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <div>
                                                            <h5 class="font-size-14 mb-1">Ruangan</h5>
                                                            <p class="font-size-13 text-muted mb-0">{{ $jadwalSeminar->ruangan }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                            
                                        </div>
                                    </div>
                                </div>

                                @if(count(auth()->user()->sempro->penilaianSempros()->get()) > 0)
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title mb-3">Nilai</h5>
                                            <div class="list-group list-group-flush">
                                                @php
                                                    $nilai = NilaiHelper::countNilaiSempro(auth()->user()->sempro->penilaianSempros()->get());
                                                @endphp
                                                <a href="#" class="list-group-item list-group-item-action">
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar-sm flex-shrink-0 me-3">
                                                            <i class="fa fa-file-signature fa-2x"></i>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <div>
                                                                <h5 class="font-size-14 mb-1">Nilai</h5>
                                                                <p class="font-size-13 text-muted mb-0">{{ number_format($nilai, 2)}}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                                <a href="#" class="list-group-item list-group-item-action">
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar-sm flex-shrink-0 me-3">
                                                            <i class="fa fa-clipboard fa-2x"></i>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <div>
                                                                <h5 class="font-size-14 mb-1">Keterangan</h5>
                                                                <p class="font-size-13 text-muted mb-0">@if($nilai > 51) <span class="badge bg-success">Lulus</span> @else <span class="badge bg-danger">Tidak lulus</span> @endif </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endif

                        </div>
                    </div>
                </div>
            </div>
