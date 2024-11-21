<div class="row">
    <div class="col-sm order-2 order-sm-1">
        <div class="d-flex align-items-start mt-3 mt-sm-0">
            <div class="flex-shrink-0">
                <div class="avatar-xl me-3">
                    @if(auth()->user()->photo !== null)
                    <img src="{{ asset('storage/'. auth()->user()->photo)}}" alt="" class="img-fluid rounded-circle d-block">
                    @else
                    <img src="{{ asset('dist/assets/images/users/avatar.png')}}" alt="" class="img-fluid rounded-circle d-block">
                    @endif
                </div>
            </div>
            <div class="flex-grow-1">
                <div>
                    <h5 class="font-size-16 mb-1">{{ auth()->user()->name }}</h5>
                    <p class="text-muted font-size-13">
                        @if(auth()->user()->isMahasiswa())
                        {{ auth()->user()->mahasiswa->nim }}
                        @else
                        {{ auth()->user()->dosen->nip ?? '' }}
                        @endif
                    </p>

                    <div class="d-flex flex-wrap align-items-start gap-2 gap-lg-3 text-muted font-size-13">
                        <div><i class="mdi mdi-circle-medium me-1 text-success align-middle"></i>{{ auth()->user()->email }}</div>
                        @if(auth()->user()->isMahasiswa())
                            <div><i class="mdi mdi-circle-medium me-1 text-success align-middle"></i>
                                {{ auth()->user()->mahasiswa->nomor_telepon }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>