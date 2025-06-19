<div>
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Penentuan Jadwal dan Penguji </h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Jadwal</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('jadwal:sempro:index') }}">Jadwal Sempro</a></li>
                        <li class="breadcrumb-item active">Penentuan Jadwal dan Penguji</li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card card-body blur shadow-blur">
                <div class="row gx-4 align-items-center">
                    <div class="card">
                        <div class="card-header" style="display: flex;justify-content:space-between">
                            <h2 class="my-heading">List Mahasiswa Pendaftar</h2>
                            <div>
                                <a href="{{ route('pdf:jadwal-seminar-proposal', ['periodeId' => $periode_id]) }}" target="_blank" class="btn btn-info text-end"> <i class="fa fa-file-pdf"></i> Download Jadwal</a>
                                <a href="{{ route('pdf:berita-acara-sempro', ['periodeId' => $periode_id]) }}" target="_blank" class="btn btn-success text-end"> <i class="fa fa-clipboard"></i> Berita Acara</a>
                            </div>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0 table-edits">
                                    <thead>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            No</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-0">
                                            Mahasiwa</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            NIM</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Judul Tugas Akhir</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Dosen Pembimbing Utama</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Dosen Pembimbing Pendamping</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Penguji 1 (Ketua)</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Penguji 2</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Hari/TGL</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Waktu Mulai</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Waktu Selesai</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Ruangan</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Status</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Nilai</th>
                                    </thead>
                                    <tbody>
                                        @forelse($mahasiswas as $mahasiswa)
                                        <tr>
                                            <td wire:dblClick="editTable('{{ $mahasiswa->user->id }}')">{{ $loop->iteration }}</td>
                                            <td wire:dblClick="editTable('{{ $mahasiswa->user->id }}')">{{ $mahasiswa->user->mahasiswa->nama }}</td>
                                            <td wire:dblClick="editTable('{{ $mahasiswa->user->id }}')">{{ $mahasiswa->user->mahasiswa->nim }}</td>
                                            <td wire:dblClick="editTable('{{ $mahasiswa->user->id }}')">{{ $mahasiswa->user->mahasiswa->pengajuanTA->judul }}</td>
                                            <td wire:dblClick="editTable('{{ $mahasiswa->user->id }}')">{{ $mahasiswa->user->mahasiswa->pengajuanTA->pembimbing1->name }}</td>
                                            <td wire:dblClick="editTable('{{ $mahasiswa->user->id }}')">{{ $mahasiswa->user->mahasiswa->pengajuanTA->pembimbing2->name }}</td>
                                            <td wire:dblClick="editTable('{{ $mahasiswa->user->id }}')">
                                                @if(isset($editState[$mahasiswa->user->id]) && $editState[$mahasiswa->user->id])
                                                <select wire:model="editData.{{ $mahasiswa->user->id }}.penguji_1">
                                                    <option value="">Pilih Penguji 1</option>
                                                    @foreach($dosens as $dosen)
                                                        @if(!in_array($dosen->user_id, [$mahasiswa->user->mahasiswa->pengajuanTA->pembimbing_1, $mahasiswa->user->mahasiswa->pengajuanTA->pembimbing_2]))
                                                        <option value="{{ $dosen->user_id }}">{{ $dosen->nama_dosen }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                                @else
                                                {{ $mahasiswa->periode->jadwalSempros()->where('user_id', $mahasiswa->user->id)->first() && $mahasiswa->periode->jadwalSempros()->where('user_id', $mahasiswa->user->id)->first()->penguji_1 ? $mahasiswa->periode->jadwalSempros()->where('user_id', $mahasiswa->user->id)->first()->penguji1->name : '' }}
                                                @endif
                                            </td>
                                            <td wire:dblClick="editTable('{{ $mahasiswa->user->id }}')">
                                                @if(isset($editState[$mahasiswa->user->id]) && $editState[$mahasiswa->user->id])
                                                <select wire:model="editData.{{ $mahasiswa->user->id }}.penguji_2">
                                                    <option value="">Pilih Penguji 2</option>
                                                    @foreach($dosens as $dosen)
                                                        @if(!in_array($dosen->user_id, [$mahasiswa->user->mahasiswa->pengajuanTA->pembimbing_1, $mahasiswa->user->mahasiswa->pengajuanTA->pembimbing_2]))
                                                        <option value="{{ $dosen->user_id }}">{{ $dosen->nama_dosen }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                                @else
                                                {{ $mahasiswa->periode->jadwalSempros()->where('user_id', $mahasiswa->user->id)->first() && $mahasiswa->periode->jadwalSempros()->where('user_id', $mahasiswa->user->id)->first()->penguji_2 ? $mahasiswa->periode->jadwalSempros()->where('user_id', $mahasiswa->user->id)->first()->penguji2->name : '' }}
                                                @endif
                                            </td>
                                            <td wire:dblClick="editTable('{{ $mahasiswa->user->id }}')">
                                                @if(isset($editState[$mahasiswa->user->id]) && $editState[$mahasiswa->user->id])
                                                <input type="date" wire:model="editData.{{ $mahasiswa->user->id }}.tanggal_sempro">
                                                @else
                                               {{ \App\Models\JadwalSempro::where('periode_id', $periode_id)->where('user_id', $mahasiswa->user->id)->value('tanggal_sempro') }}
                                                @endif
                                            </td>
                                            <td wire:dblClick="editTable('{{ $mahasiswa->user->id }}')">
                                                @if(isset($editState[$mahasiswa->user->id]) && $editState[$mahasiswa->user->id])
                                                <input type="time" wire:model="editData.{{ $mahasiswa->user->id }}.waktu_mulai">
                                                @else
                                                {{ $mahasiswa->periode->jadwalSempros()->where('user_id', $mahasiswa->user->id)->first() ? \Carbon\Carbon::parse($mahasiswa->periode->jadwalSempros()->where('user_id', $mahasiswa->user->id)->first()->waktu_mulai)->format('H:i') : '' }}
                                                @endif
                                            </td>
                                            <td wire:dblClick="editTable('{{ $mahasiswa->user->id }}')">
                                                @if(isset($editState[$mahasiswa->user->id]) && $editState[$mahasiswa->user->id])
                                                <input type="time" wire:model="editData.{{ $mahasiswa->user->id }}.waktu_selesai">
                                                @else
                                                {{ $mahasiswa->periode->jadwalSempros()->where('user_id', $mahasiswa->user->id)->first() ? \Carbon\Carbon::parse($mahasiswa->periode->jadwalSempros()->where('user_id', $mahasiswa->user->id)->first()->waktu_selesai)->format('H:i') : '' }}
                                                @endif
                                            </td>
                                            <td wire:dblClick="editTable('{{ $mahasiswa->user->id }}')">
                                                @if(isset($editState[$mahasiswa->user->id]) && $editState[$mahasiswa->user->id])
                                                <input type="text" wire:model="editData.{{ $mahasiswa->user->id }}.ruangan">
                                                @else
                                                {{ $mahasiswa->periode->jadwalSempros()->where('user_id', $mahasiswa->user->id)->first() ? $mahasiswa->periode->jadwalSempros()->where('user_id', $mahasiswa->user->id)->first()->ruangan : '' }}
                                                @endif
                                            </td>
                                            <td class="text-center" wire:dblClick="editTable('{{ $mahasiswa->user->id }}')">
                                                @if(isset($editState[$mahasiswa->user->id]) && $editState[$mahasiswa->user->id])
                                                <a class="btn btn-outline-secondary btn-sm edit" wire:click="save('{{ $mahasiswa->user->id }}', '{{ $mahasiswa->user->mahasiswa->pengajuanTA->id }}')" title="Save">
                                                    <i class="fas fa-save"></i>
                                                </a>
                                                @else
                                                <a class="btn btn-outline-secondary btn-sm edit" wire:click="editTable('{{ $mahasiswa->user->id }}')" title="Edit">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if(count($mahasiswa->user->sempro->penilaianSempros()->get()) > 0)
                                                {{ number_format(NilaiHelper::countNilaiSempro($mahasiswa->user->sempro->penilaianSempros()->get()), 2) }}
                                                @else
                                                <span class="text-primary"><i class="fa fa-minus"></i></span>
                                                @endif
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="12">Belum ada data</td>
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


</div>