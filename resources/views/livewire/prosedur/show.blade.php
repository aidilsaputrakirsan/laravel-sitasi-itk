<div>
    <div class="row mb-4">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Prosedur TA</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Data Referensi</a></li>
                        <li class="breadcrumb-item active">Prosedur TA</li>
                    </ol>
                </div>

            </div>
        </div>
        <div class="col-md-12">
            @if(auth()->user()->isTendik() || auth()->user()->isKoorpro())
            <div class="card card-body blur shadow-blur">
                <div class="row align-items-center">
                    <div class="card-header" style="display: flex; justify-content: space-between">
                        <h2 class="my-heading">Prosedur TA</h2>
                    </div>
                    <div class="card-body" >
                        <div wire:ignore >
                            <div class="form-group mt-2">
                                <label for="">Judul</label>
                                <input type="text" wire:model="judul" class="form-control" placeholder="Masukkan judul">
                            </div>
                            <div class="form-group mt-2">
                                <label for="">Content</label>
                                <textarea id="ckeditor-classic" wire:model="content" class="form-control" cols="30" rows="4" placeholder="Isi Prosedur"></textarea>
                            </div>
                        </div>
                        <div class="form-group text-end mt-2">

                            @if($editable)
                                <button class="btn btn-danger" wire:click="cancel()">Cancel</button>
                                <button class="btn btn-info" wire:click="save()">Save</button>
                            @else
                                <button class="btn btn-primary" wire:click="submit()">Submit</button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <div class="accordion" id="accordionPanelsStayOpenExample">
                @foreach($prosedurs as $prosedur)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="panelsStayOpen-headingOne-{{$loop->iteration}}">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#panelsStayOpen-collapseOne-{{$loop->iteration}}" aria-expanded="true"
                            aria-controls="panelsStayOpen-collapseOne">
                            {{ $prosedur->judul }}
                        </button>
                    </h2>
                    <div id="panelsStayOpen-collapseOne-{{ $loop->iteration }}" class="accordion-collapse collapse @if($loop->iteration == 1) show @endif"
                        aria-labelledby="panelsStayOpen-headingOne">
                        <div class="accordion-body text-muted">
                            {!! $prosedur->content !!}
                            @if(auth()->user()->isTendik() || auth()->user()->isKoorpro())
                            <a href="javascript:;" wire:click="edit('{{ $prosedur->id }}')"><i class="fas fa-edit text-info"></i></a>
                            <a href="javascript:;" wire:click="setDeleteId('{{ $prosedur->id }}')"><i class="fas fa-trash text-danger"></i></a>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <x-modal.delete :deleteModal="$deleteModal" />


@section('script')
<script src="{{ asset('dist/assets/libs/%40ckeditor/ckeditor5-build-classic/build/ckeditor.js')}}"></script>
<script>
    "use client";
    ClassicEditor.create(document.querySelector("#ckeditor-classic"))
    .then(function (e) {
        e.ui.view.editable.element.style.height = "200px";
        e.model.document.on('change:data', () => {
           @this.set('content', e.getData());
          })

        window.addEventListener('content-updated', event => {
                e.setData(event.detail.content);
            });
    })
    .catch(function (e) {
        console.error(e);
    });

    document.addEventListener("livewire:update", () => {
        if (window.ckEditorInstance) {
            window.ckEditorInstance.setData(@this.content);
        }
    });
</script>

@endsection

</div>
