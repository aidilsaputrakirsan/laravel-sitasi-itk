<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Pengajuan Judul</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Pengajuan TA</a></li>
                    <li class="breadcrumb-item active">Pengajuan Judul</li>
                </ol>
            </div>

        </div>
    </div>
    <div class="col-md-12">
        <div class="card card-body blur shadow-blur">
            <div class="row align-items-center">
                <div class="card-header">
                    <h2 class="my-heading">Data Pengajuan TA</h2>
                    @if($status === 'Judul Ditolak')
                    <span class="badge bg-danger">{{ $status }}</span>
                    @elseif($status === 'Judul TA Diterima')
                    <span class="badge bg-success">{{ $status }}</span>
                    @else
                    <span class="badge bg-info">{{ $status }}</span>
                    @endif
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-12">
                            <label for="nama">Judul Skripsi</label>
                            <textarea wire:model.live="judul" id="judul" rows="6" class="form-control"></textarea>
                            @error('judul') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="form-group col-12 mt-2">
                            <label for="nama">Bidang Penelitian</label>
                            <input type="text" class="form-control" wire:model.live="bidang_penelitian">
                            @error('bidang_penelitian') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="form-group col-6 mt-2">
                            <label for="pembimbing1">Pembimbing 1</label>
                            <select wire:model.live="pembimbing1" id="pembimbing1" class="form-control"  @if(!$isRejectedPembimbing1) disabled @endif>
                                <option value="">Pilih Pembimbing</option>
                                @foreach($dosens as $dosen)
                                <option value="{{ $dosen->user->id }}">{{ $dosen->nama_dosen }}</option>
                                @endforeach
                            </select>
                            @error('pembimbing1') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="form-group col-6 mt-2">
                            <label for="nama">Pembimbing 2</label>
                            <select wire:model.live="pembimbing2" id="pembimbing2" class="form-control"  @if(!$isRejectedPembimbing2) disabled @endif>
                                <option value="">Pilih Pembimbing</option>
                                @foreach($dosens as $dosen)
                                <option value="{{ $dosen->user->id }}">{{ $dosen->nama_dosen }}</option>
                                @endforeach
                            </select>
                            @error('pembimbing2') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="col-12 mt-2 text-end">
                            <button class="btn btn-primary" wire:click="submit" @if(!$saveAble) disabled @endif >Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
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
                                @if($riwayat->status === 'Disetujui Pembimbing')
                                <h4 class="timeline-title badge bg-success px-2 p-1">{{ $riwayat->status }}</h4>
                                @elseif($riwayat->status === 'Ditolak Pembimbing')
                                <h4 class="timeline-title badge bg-danger px-2 p-1">{{ $riwayat->status }}</h4>
                                @else
                                <h4 class="timeline-title badge bg-primary px-2 p-1">{{ $riwayat->status }}</h4>
                                @endif
                                <p>{{ $riwayat->user->name }},  {{ $riwayat->riwayat }} pada <a href="javascript:void(0);" data-abc="true">{{ \Carbon\Carbon::parse($riwayat->created_at)->format('H:i A') }}</a> <small>
                                    @if($riwayat->keterangan !== null && $riwayat->keterangan !== '') <br> Dengan alasan: <i>{{ $riwayat->keterangan }}</i> @endif</small></p>
                                <span class="vertical-timeline-element-date">{{ \Carbon\Carbon::parse($riwayat->created_at)->format('Y-m-d') }}</span>
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
                                <p>Tidak ada riwayat pengajuan judul</p>
                                <span class="vertical-timeline-element-date">{{ \Carbon\Carbon::now()->format('Y-m-d') }}</span>
                            </div>
                        </div>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>  
    </div>
</div>