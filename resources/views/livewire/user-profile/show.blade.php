<div>
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Profile</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">User</a></li>
                        <li class="breadcrumb-item active">Profile</li>
                    </ol>
                </div>

            </div>
        </div>
        <div class="col-xl-9 col-lg-8">
            <div class="card">
                <div class="card-body">
                    <x-profile-header />

                    <ul class="nav nav-tabs-custom card-header-tabs border-top mt-4" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <button class="nav-link px-3 {{ $type === '' ? 'active' : '' }}" wire:click="changeTab('')" role="tab">Overview</button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link px-3 {{ $type === 'edit-profile' ? 'active' : '' }}" wire:click="changeTab('edit-profile')">Edit Profile</button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link px-3 {{ $type === 'referensi' ? 'active' : '' }}" wire:click="changeTab('referensi')">Referensi Topik TA</button>
                        </li>
                    </ul>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->

            <div class="tab-content">
                {{-- Tab Overview --}}
                @if($type === '')
                <div class="tab-pane active" id="overview" role="tabpanel">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Mahasiswa Bimbingan</h5>
                        </div>
                        <div class="card-body">
                            <div>
                                <div class="pb-3">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="table-responsive mb-4">
                                                <table class="table align-middle dt-responsive table-check nowrap" style="border-collapse: collapse; border-spacing: 0 8px; width: 100%;">
                                                    <thead>
                                                      <tr>
                                                        <th scope="col" style="width: 50px;">No</th>
                                                        <th scope="col">Nama</th>
                                                        <th scope="col">NIM</th>
                                                        <th scope="col">Judul</th>
                                                      </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse($bimbings as $bimbingan)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $bimbingan->mahasiswa->nama }}</td>
                                                            <td>{{ $bimbingan->mahasiswa->nim }}</td>
                                                            <td>{{ $bimbingan->judul }}</td>
                                                        </tr>
                                                        @empty
                                                        <tr>
                                                            <td colspan="4">Tidak ada data</td>
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
                        <!-- end card body -->
                    </div>
                    <!-- end card -->

                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <h5 class="card-title mb-0">Mahasiswa Uji</h5>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="table-responsive mb-4">
                                            <table class="table align-middle dt-responsive table-check nowrap" style="border-collapse: collapse; border-spacing: 0 8px; width: 100%;">
                                                <thead>
                                                    <tr>
                                                      <th scope="col" style="width: 50px;">No</th>
                                                      <th scope="col">Nama</th>
                                                      <th scope="col">NIM</th>
                                                      <th scope="col">Judul</th>
                                                    </tr>
                                                  </thead>
                                                  <tbody>
                                                      @forelse($ujis as $uji)
                                                      <tr>
                                                          <td>{{ $loop->iteration }}</td>
                                                          <td>{{ $uji->mahasiswa->nama }}</td>
                                                          <td>{{ $uji->mahasiswa->nim }}</td>
                                                          <td>{{ $uji->judul }}</td>
                                                      </tr>
                                                      @empty
                                                      <tr>
                                                          <td colspan="4">Tidak ada data</td>
                                                      </tr>
                                                      @endforelse
                                                  </tbody>
                                            </table>
                                            <!-- end table -->
                                        </div>
                                    </div>
                                </div>
                                <!-- end row -->
                            </div>
                        </div>
                        <!-- end card body -->
                    </div>
                    <!-- end card -->
                </div>
                @endif
                <!-- end tab pane overview -->

                {{-- Tab Edit Profile (BARU) --}}
                @if($type === 'edit-profile')
                <div class="tab-pane active">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Edit Profile</h5>
                        </div>
                        <div class="card-body">
                            <form wire:submit="updateProfile()">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label>Nama Lengkap</label>
                                            <input type="text" wire:model="name" class="form-control" required>
                                            @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label>Username</label>
                                            <input type="text" wire:model="username" class="form-control" required>
                                            @error('username') <small class="text-danger">{{ $message }}</small> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label>Email</label>
                                            <input type="email" wire:model="email" class="form-control" required>
                                            @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label>Foto Profile</label>
                                            <input type="file" wire:model="photo" accept="image/*" class="form-control">
                                            @error('photo') <small class="text-danger">{{ $message }}</small> @enderror
                                            @if($photo)
                                                <img src="{{ $photo->temporaryUrl() }}" alt="Preview" class="mt-2" style="width: 100px; height: 100px; object-fit: cover;">
                                            @elseif(auth()->user()->photo)
                                                <img src="{{ asset('storage/' . auth()->user()->photo) }}" alt="Current" class="mt-2" style="width: 100px; height: 100px; object-fit: cover;">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Update Profile</button>
                            </form>
                        </div>
                    </div>

                    {{-- Change Password Card --}}
                    <div class="card mt-3">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Ganti Password</h5>
                        </div>
                        <div class="card-body">
                            <form wire:submit="changePassword()">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label>Password Lama</label>
                                            <input type="password" wire:model="current_password" class="form-control" required>
                                            @error('current_password') <small class="text-danger">{{ $message }}</small> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label>Password Baru</label>
                                            <input type="password" wire:model="new_password" class="form-control" required>
                                            @error('new_password') <small class="text-danger">{{ $message }}</small> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label>Konfirmasi Password Baru</label>
                                            <input type="password" wire:model="new_password_confirmation" class="form-control" required>
                                            @error('new_password_confirmation') <small class="text-danger">{{ $message }}</small> @enderror
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-warning">Ganti Password</button>
                            </form>
                        </div>
                    </div>
                </div>
                @endif

                {{-- Tab Referensi --}}
                @if($type === 'referensi')
                <div class="tab-pane active">
                    {{-- Konten referensi akan ditambahkan di sini --}}
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Referensi Topik TA</h5>
                        </div>
                        <div class="card-body">
                            <p>Konten referensi topik TA akan ditampilkan di sini.</p>
                        </div>
                    </div>
                </div>
                @endif
            </div>
            <!-- end tab content -->
        </div>
        <!-- end col -->

        <div class="col-xl-3 col-lg-4">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-3">Tanda Tangan Digital</h5>
                    <div>
                        <div id="imagePreview" class="mt-2">
                            @if($imgSignature !== null && !$signature)
                                <img src="{{ asset('storage/' . $imgSignature) }}" alt="Tanda tangan" style="width: 100%">
                            @elseif($signature)
                                <img src="{{ $signature->temporaryUrl() }}" alt="Tanda tangan" style="width: 100%">
                            @endif
                        </div>
                        <input type="file" accept="image/*" class="form-control" wire:model="signature">
                        @error('signature')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <button class="btn btn-primary btn-sm mt-2" wire:click="saveSignature()">Submit</button>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>
    </div>
</div>