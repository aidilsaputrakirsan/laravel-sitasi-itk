<div>
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Jadwal Sidang TA</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Jadwal</a></li>
                        <li class="breadcrumb-item active">Jadwal Sidang TA</li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card card-body blur shadow-blur">
                <div class="row gx-4 align-items-center">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="my-heading">List Gelombang</h2>
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
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-0">
                                                List Jadwal</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Periode</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Gelombang</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 text-center">
                                                Tampilkan Jadwal</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($periode as $period)
                                            <tr>
                                                <td class="text-xs font-weight-bold mb-0">{{ $loop->iteration }}.</td>
                                                <td class="text-xs font-weight-bold mb-0 px-0"><a href="{{ route('jadwal:sidang-ta:detail', ['periode_id' => $period->id]) }}" class="btn btn-primary btn-sm">Lihat Jadwal</a></td>
                                                <td class="text-xs font-weight-bold mb-0">{{ $period->periode }}</td>
                                                <td class="text-xs font-weight-bold mb-0">{{ $period->gelombang }}</td>
                                                <td class="text-xs font-weight-bold mb-0">
                                                    <div class="form-check form-switch mb-3" style="justify-content:center;display:flex">
                                                        <input type="checkbox" class="form-check-input" wire:model="editData.{{ $period->id }}.is_tampilkan" wire:click="tampilkanJadwal('{{ $period->id }}')" @if($period->is_tampilkan) checked @endif>
                                                    </div>
                                                </td>
                                                <td class="text-xs font-weight-bold mb-0">
                                                    <span class="badge @if($period->status === 'Nonactive') bg-danger @else bg-success @endif">{{ $period->status }}</span>
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

</div>