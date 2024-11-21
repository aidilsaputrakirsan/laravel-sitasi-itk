<div>
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Referensi</h4>
    
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Data Referensi</a></li>
                        <li class="breadcrumb-item active">Referensi TA</li>
                    </ol>
                </div>
    
            </div>
        </div>
        <div class="col-md-12">
            <div class="card card-body blur shadow-blur">
                <div class="row align-items-center">
                    <div class="card-header" style="display: flex; justify-content: space-between">
                        <h2 class="my-heading">Data Referensi TA</h2>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive p-0">
                            <div class="table-responsive mb-4">
                                <table class="table align-middle datatable dt-responsive table-check nowrap" style="border-collapse: collapse; border-spacing: 0 8px; width: 100%;">
                                    <thead>
                                      <tr>
                                        <th scope="col" style="width: 50px;">No</th>
                                        <th scope="col">Bidang Minat</th>
                                        <th scope="col">Judul/Topik</th>
                                        <th scope="col">Dosen Pembimbing</th>
                                        <th scope="col">Kontak</th>
                                        <th scope="col">Tersedia</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($referensi as $ref)
                                            <tr>
                                                <td>{{ $loop->iteration }}.</td>
                                                <td>{{ $ref->bidang_minat }}</td>
                                                <td>{{ $ref->judul }}</td>
                                                <td>{{ $ref->user->name }}</td>
                                                <td>{{ $ref->user->email }}</td>
                                                <td>{{ $ref->is_tersedia ? 'Ya' : 'Tidak' }}</td>
                                            </tr>
                                        @empty
                                        <tr>
                                            <td colspan="4">Belum ada data</td>
                                        </tr>
                                        @endforelse
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