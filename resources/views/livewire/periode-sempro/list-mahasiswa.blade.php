<div>
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">List Pendaftar Seminar Proposal</h4>
    
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Periode</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('periode-sempro') }}">Periode Sempro</a></li>
                        <li class="breadcrumb-item active">List Pendaftar</li>
                    </ol>
                </div>
    
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="my-heading">{{ $period->periode }} - Gelombang {{ $period->gelombang }}</h2>
                </div>
                <div class="card-body">
                    <div class="">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        No</th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Mahasiswa</th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Tanggal Daftar</th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Gelombang</th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Form Ta.001</th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Form Ta.002</th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Form Ta.006</th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Form Ta.012</th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Bukti Plagiasi</th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Proposal TA</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Status</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                        Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($list as $period)
                                    <tr>
                                        <td class="text-xs font-weight-bold mb-0">{{ $loop->iteration }}.</td>
                                        <td class="text-xs font-weight-bold mb-0">{{ $period->user->name }}</td>
                                        <td class="text-xs font-weight-bold mb-0">{{ \Carbon\Carbon::parse($period->created_at)->format('d/m/Y') }}</td>
                                        <td class="text-xs font-weight-bold mb-0">{{ $period->periode->gelombang }}</td>
                                        <td class="text-xs font-weight-bold mb-0">
                                            <a href="{{ route('pdf:form-ta-001', ['userId' => $period->user_id]) }}" target="_blank" class="text-info">Cek File</a>
                                        </td>
                                        <td class="text-xs font-weight-bold mb-0">
                                            <a href="{{ route('pdf:form-ta-002', ['userId' => $period->user_id]) }}" class="text-info" target="_blank">Cek File</a>
                                        </td>
                                        <td class="text-xs font-weight-bold mb-0">
                                            <a href="{{ route('pdf:form-ta-006', ['userId' => $period->user->id ]) }}" class="text-info" target="_blank">Cek File</a>
                                        </td>
                                        <td class="text-xs font-weight-bold mb-0">
                                            <a href="{{ asset('storage/'.$period->form_ta_012) }}" class="text-info" target="_blank">Cek File</a>
                                        </td>
                                        <td class="text-xs font-weight-bold mb-0">
                                            <a href="{{ asset('storage/'.$period->bukti_plagiasi) }}" class="text-info" target="_blank">Cek File</a>
                                        </td>
                                        <td class="text-xs font-weight-bold mb-0">
                                            <a href="{{ asset('storage/'.$period->proposal_ta) }}" class="text-info" target="_blank">Cek File</a>
                                        </td>
                                        </td>
                                        <td class="text-xs font-weight-bold mb-0">
                                            @if($period->status === 'Diterima')
                                            <span class="badge bg-success">{{ $period->status }}</span>
                                            @elseif($period->status === 'Ditolak')
                                            <span class="badge bg-danger">{{ $period->status }}</span>
                                            @elseif($period->status === 'Revisi')
                                            <span class="badge bg-warning">{{ $period->status }}</span>
                                            @elseif($period->status === 'on_process')
                                            <span class="badge bg-primary">{{ ('Dalam Proses') }}</span>
                                            @else
                                            <span class="badge bg-primary">{{ $period->status }}</span>
                                            @endif
                                        </td>
                                        <td class="text-xs font-weight-bold mb-0 text-center">
                                            @if($period->status === 'Ditolak')
                                            <i class="fas fa-times text-danger"></i>
                                            @elseif($period->status === 'Diterima')
                                            <i class="fas fa-check text-success"></i>
                                            @else
                                            <div class="dropdown">
                                                <a class="btn btn-link text-muted py-1 font-size-16 shadow-none dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="bx bx-dots-horizontal-rounded"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li><button wire:click="updateStatus('{{ $period->user_id }}', '{{ $period->id }}','Diterima')" class="dropdown-item" href="#">Terima</button></li>
                                                    <li><button wire:click="updateStatus('{{ $period->user_id }}', '{{ $period->id }}','Revisi')" class="dropdown-item" href="#">Revisi</button></li>
                                                    <li><button wire:click="updateStatus('{{ $period->user_id }}', '{{ $period->id }}','Ditolak')" class="dropdown-item" href="#">Tolak</button></li>
                                                </ul>
                                            </div>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                <tr>
                                    <td colspan="5">Tidak ada data</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Revisi Modal --}}
    <div class="modal fade @if($revisiModal) show @endif" @if($revisiModal) style="display: block" @endif id="tambahData" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Update Sempro</h1>
                    <button type="button" class="btn-close" wire:click="closeRevisiModal()"  aria-label="Close"></button>
                </div>
                <form wire:submit="submitRevisi()" method="POST">
                    <div class="modal-body">
                        <div class="form-container">
                            @csrf
                            <div class="mb-3">
                                <label for="tanggal" class="form-label">Alasan Revisi</label>
                                <input type="text" class="form-control" wire:model="alasan" placeholder="Masukkan Alasan Revisi" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="closeRevisiModal()" >Tutup</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- Tolak Modal --}}
    <div class="modal fade @if($tolakModal) show @endif" @if($tolakModal) style="display: block" @endif id="tambahData" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tolak Seminar Proposal</h1>
                    <button type="button" class="btn-close" wire:click="closeTolakModal()"  aria-label="Close"></button>
                </div>
                <form wire:submit="tolakSempro()" method="POST">
                    <div class="modal-body">
                        <div class="form-container">
                            <div class="alert alert-danger">Apakah anda yakin ingin menolak data ini?</div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="closeTolakModal()" >Tutup</button>
                        <button type="submit" class="btn btn-danger">Tolak</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


</div>