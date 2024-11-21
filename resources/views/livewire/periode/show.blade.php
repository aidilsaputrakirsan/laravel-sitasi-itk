<div>
    <div class="row">
        <div class="col-12">
            <div class="card card-body blur shadow-blur">
                <div class="row gx-4 align-items-center">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="my-heading">Periode TA</h2>
                            <button class="btn btn-primary" wire:click="openModal()">Tambah</button>
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
                                                Mahasiswa</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Semester</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Periode</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Gelombang</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Status</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Aksi
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($periode as $period)
                                            <tr>
                                                <td class="text-xs font-weight-bold mb-0">{{ $loop->iteration }}.</td>
                                                <td class="text-xs font-weight-bold mb-0"><a href="{{ route('periode-ta:list', ['id' => $period->id]) }}" class="btn btn-primary btn-sm">Lihat Mahasiswa</a></td>
                                                <td class="text-xs font-weight-bold mb-0">{{ $period->semester }}</td>
                                                <td class="text-xs font-weight-bold mb-0">{{ $period->periode }}</td>
                                                <td class="text-xs font-weight-bold mb-0">{{ $period->gelombang }}
                                                </td>
                                                <td class="text-xs font-weight-bold mb-0">
                                                    <span class="badge @if($period->status === 'Nonactive') bg-danger @else bg-success @endif">{{ $period->status }}</span>
                                                </td>
                                                <td>
                                                    <button class="btn btn-primary btn-sm" wire:click="edit('{{ $period->id }}')" >Update</button>
                                                    <button class="btn btn-danger btn-sm" wire:click="setDeleteId('{{ $period->id }}')">Delete</button>
                                                    @if($period->status === 'Nonactive')
                                                    <button class="btn btn-info btn-sm" wire:click="active('{{ $period->id }}')">Aktifkan</button>
                                                    @else
                                                    <button class="btn btn-warning btn-sm" wire:click="nonactive('{{ $period->id }}')">Nonaktifkan</button>
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

    <div class="modal fade @if($addModal) show @endif" @if($addModal) style="display: block" @endif id="tambahData" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Periode</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('periode-ta:store') }}" method="POST">
                    <div class="modal-body">
                        <div class="form-container">
                            @csrf
                            <div class="mb-3">
                                <label for="tanggal" class="form-label">Semester</label>
                                <select name="semester" class="form-control" required>
                                    <option value="">Pilih Semester</option>
                                    <option value="Gasal">Gasal</option>
                                    <option value="Genap">Genap</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="tanggal" class="form-label">Periode</label>
                                <input type="text" class="form-control" name="periode" placeholder="Masukkan Periode" required>
                            </div>
                            <div class="mb-3">
                                <label for="dosen" class="form-label">Gelombang</label>
                                <input type="text" class="form-control" name="gelombang" placeholder="Masukkan Gelombang" required>
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
    @livewire('periode.edit')
    <x-modal.delete :deleteModal="$deleteModal" />
</div>