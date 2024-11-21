<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Bimbingan</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Data Pengajuan</a></li>
                    <li class="breadcrumb-item active">Pengajuan Bimbingan</li>
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
        <div class="card card-body blur shadow-blur">
            <div class="row align-items-center">
                <div class="card-header">
                    <h2 class="my-heading">Daftar Bimbingan TA</h2>
                </div>
                <div class="card-body">
                    <div class="table-responsive p-0">
                        <div class="table-responsive mb-4">
                            <table class="table align-middle datatable dt-responsive table-check nowrap" style="border-collapse: collapse; border-spacing: 0 8px; width: 100%;">
                                <thead>
                                  <tr>
                                    <th scope="col" style="width: 50px;">No</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">NIM</th>
                                    <th scope="col">Judul</th>
                                    <th style="width: 80px; min-width: 80px;">Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @foreach($bimbingans as $bimbingan)
                                    <tr>
                                        <td>{{ $loop->iteration }}.</td>
                                        <td>
                                            {{ $bimbingan->user->name }}
                                        </td>
                                        <td>{{$bimbingan->user->mahasiswa->nim }}</td>
                                        <td style="white-space: pre-wrap">{{ $bimbingan->user->mahasiswa->pengajuanTA->judul }}</td>
                                        <td>
                                            <a class="btn btn-info btn-sm" href="{{ route("data-pengajuan:detail", ['id' => $bimbingan->user_id]) }}">View</a>
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