<div>
    @if(session('success'))
    <div class="alert alert-success alert-dismissible alert-label-icon label-arrow fade show" role="alert">
      <i class="mdi mdi-check-all label-icon"></i><strong>Success</strong> - {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible alert-label-icon label-arrow fade show" role="alert">
      <i class="mdi mdi-block-helper label-icon"></i><strong>Failed</strong> - {{ session('error') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if($success)
    <div class="alert alert-success alert-dismissible alert-label-icon label-arrow fade show" role="alert">
      <i class="mdi mdi-check-all label-icon"></i><strong>Success</strong> - {{ $message }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if($error)
    <div class="alert alert-danger alert-dismissible alert-label-icon label-arrow fade show" role="alert">
      <i class="mdi mdi-block-helper label-icon"></i><strong>Failed</strong> - {{ $message }}
      <button type="button" class="btn-close" wire:click="closeAlert('error')" aria-label="Close"></button>
    </div>
    @endif

</div>