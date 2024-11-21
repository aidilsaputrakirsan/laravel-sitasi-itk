<div>
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Detail Bimbingan</h4>
    
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Data Pengajuan</a></li>
                        <li class="breadcrumb-item active">Detail Bimbingan</li>
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
                            <h5 class="card-title mb-0">Riwayat Bimbingan
                            </h5>
                        </div>
                        <div class="card-body">
                            <div>
                                <div class="pb-3">
                                    <div class="row">
                                        <div class="col-xl-2">
                                            <div>
                                                <h5 class="font-size-15">Name:</h5>
                                            </div>
                                        </div>
                                        <div class="col-xl">
                                            <div class="text-muted">
                                                <p class="mb-2">{{ $user->name }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-2">
                                            <div>
                                                <h5 class="font-size-15">NIM:</h5>
                                            </div>
                                        </div>
                                        <div class="col-xl">
                                            <div class="text-muted">
                                                <p class="mb-2">{{ $user->mahasiswa->nim }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-2">
                                            <div>
                                                <h5 class="font-size-15">Email:</h5>
                                            </div>
                                        </div>
                                        <div class="col-xl">
                                            <div class="text-muted">
                                                <p class="mb-2">{{ $user->mahasiswa->email }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-2">
                                            <div>
                                                <h5 class="font-size-15">Nomor Telepon:</h5>
                                            </div>
                                        </div>
                                        <div class="col-xl">
                                            <div class="text-muted">
                                                <p class="mb-2">{{ $user->mahasiswa->nomor_telepon }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-2">
                                            <div>
                                                <h5 class="font-size-15">Judul TA :</h5>
                                            </div>
                                        </div>
                                        <div class="col-xl">
                                            <div class="text-muted">
                                                <p class="mb-2">{{ $user->mahasiswa->pengajuanTA->judul }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
    
                                <div class="py-3">
                                    <div class="row">
                                        <div class="col-xl-2">
                                            <div>
                                                <h5 class="font-size-15">List Bimbingan :</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div>
                                                <div class="table-responsive p-0">
                                                    <div class="table-responsive mb-4">
                                                        <table class="table align-middle datatable dt-responsive table-check nowrap" style="border-collapse: collapse; border-spacing: 0 8px; width: 100%;">
                                                            <thead>
                                                              <tr>
                                                                <th scope="col" style="width: 50px;">No</th>
                                                                <th scope="col">Tanggal</th>
                                                                <th scope="col">Keterangan</th>
                                                                <th scope="col">Hasil</th>
                                                                <th style="width: 80px; min-width: 80px;">Persetujuan</th>
                                                              </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach($bimbingans as $bimbingan)
                                                                <tr>
                                                                    <td>{{ $loop->iteration }}.</td>
                                                                    <td>
                                                                        {{ \Carbon\Carbon::parse($bimbingan->tanggal)->format('Y-m-d') }}
                                                                    </td>
                                                                    <td>{{ $bimbingan->ket_bimbingan }}</td>
                                                                    <td style="white-space: pre-wrap">{{ $bimbingan->hasil_bimbingan }}</td>
                                                                    <td class="text-center">
                                                                        @if($bimbingan->status === 'created')
                                                                            <button class="btn btn-info btn-sm" wire:click="openModalSetuju('{{ $bimbingan->id }}')">Setujui</button>
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
                                                </div>
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
        </div>
    </div>
    <div class="modal fade @if($setujuModal) show @endif" @if($setujuModal) style="display: block" @endif id="setujui" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Apakah yakin ingin menyetujui data?</h1>
                    <button type="button" class="btn-close" wire:click="closeModalSetuju()" aria-label="Close"></button>
                </div>
                <form wire:submit="setuju()" method="POST">
                    <div class="modal-body">
                        <div class="form-container">
                            <div class="alert alert-success">
                                <b class="text-dark">Anda menyetujui bimbingan ini, data yang disetujui tidak dapat
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
</div>