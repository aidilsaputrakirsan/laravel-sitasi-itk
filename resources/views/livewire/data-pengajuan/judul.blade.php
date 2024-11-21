<div>
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Data Pengajuan</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Data Pengajuan</a></li>
                        <li class="breadcrumb-item active">Judul</li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card card-body blur shadow-blur">
                <div class="row gx-4 align-items-center">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="my-heading">Daftar Judul</h2>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
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
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Judul Ta</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Pembimbing 1</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Pembimbing 2</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Status
                                            </th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Aksi
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($juduls as $judul)
                                            <tr>
                                                <td class="text-xs font-weight-bold mb-0">{{ $loop->iteration }}</td>
                                                <td class="text-xs font-weight-bold mb-0">{{ $judul->mahasiswa->nama }}
                                                </td>
                                                <td class="text-xs font-weight-bold mb-0">{{ $judul->mahasiswa->nim }}
                                                </td>
                                                <td class="text-xs font-weight-bold mb-0">{{ $judul->judul }}</td>
                                                <td class="text-xs font-weight-bold mb-0">
                                                    {{ $judul->pembimbing1->name }}</td>
                                                <td class="text-xs font-weight-bold mb-0">
                                                    {{ $judul->pembimbing2->name }}</td>
                                                <td class="text-xs font-weight-bold mb-0">
                                                    @if($judul->status === 'Judul Ditolak')
                                                    <span class="badge bg-danger">{{ $judul->status }}</span>
                                                    @elseif($judul->status === 'Judul TA Diterima')
                                                    <span class="badge bg-success">{{ $judul->status }}</span>
                                                    @else
                                                    <span class="badge bg-primary">{{ $judul->status }}</span>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    @if ($judul->status === 'Dalam Proses Pengajuan')
                                                        @if (
                                                            !$judul->notif()->where('from_id', auth()->id())->first() ||
                                                                ($judul->notif()->where('from_id', auth()->id())->first()->type !== 'judul-disetujui' && $judul->notif()->where('from_id', auth()->id())->first()->type !== 'judul-ditolak'))
                                                            <button class="btn btn-info btn-sm" wire:click="openModalSetuju('{{ $judul->id }}')">Setujui</button>
                                                            <button wire:click="openModalTolak('{{ $judul->id }}')" 
                                                                class="btn btn-danger btn-sm">Tolak</button>
                                                        @else
                                                        <i class="fas fa-check text-primary"></i>
                                                        @endif
                                                    @elseif($judul->status === 'Judul TA Ditolak')
                                                    <i class="fas fa-times text-danger"></i>
                                                    @elseif($judul->status === 'Judul TA Diterima')
                                                    <i class="fas fa-check text-success"></i>
                                                    @else
                                                      @if(!$judul->notif()->where('from_id', auth()->id())->first())
                                                        <button class="btn btn-info btn-sm" wire:click="openModalSetuju('{{ $judul->id }}')">Setujui</button>
                                                        <button wire:click="openModalTolak('{{ $judul->id }}')" 
                                                            class="btn btn-danger btn-sm">Tolak</button>
                                                      @else
                                                          <i class="fas fa-check text-primary"></i>
                                                      @endif
                                                    @endif
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade @if($setujuModal) show @endif" @if($setujuModal) style="display: block" @endif id="setujui" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Apakah yakin ingin menyetujui data?</h1>
                    <button type="button" class="btn-close" wire:click="closeModalSetuju()" aria-label="Close"></button>
                </div>
                <form wire:submit="setuju()">
                    <div class="modal-body">
                        <div class="form-container">
                            <div class="alert alert-success">
                                <b class="text-dark">Anda menyetujui judul ini, data yang disetujui tidak dapat
                                    diubah</b>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="closeModalSetuju()">Tutup</button>
                        <button type="submit" data-bs-dismiss="modal" class="btn btn-info">Setujui</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade @if($tolakModal) show @endif" @if($tolakModal) style="display: block" @endif id="tolak" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Apakah yakin ingin menolak data?</h1>
                    <button type="button" class="btn-close" wire:click="closeModalTolak()" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-container">
                        <div class="alert alert-danger">
                            <b class="text-dark">Anda menolak judul ini, data yang ditolak tidak dapat diubah</b>
                        </div>
                        <div class="form-control">
                            <label for="alasan">Alasan Menolak</label>
                            <input type="text" wire:model="alasan" class="form-control" name="alasan">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="closeModalTolak()">Tutup</button>
                    <button type="button" wire:click="tolak()" data-bs-dismiss="modal" class="btn btn-danger">Tolak</button>
                </div>
            </div>
        </div>
    </div>
</div>
