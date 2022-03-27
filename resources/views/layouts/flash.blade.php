
@if (session('status'))
@push('javascript')

@include('vendor.lara-izitoast.toast')
@endpush

    {{-- <div class="alert alert-{{ session('status.element') }} alert-has-icon alert-dismissible show fade">
        <button class="close" data-dismiss="alert">
          <span>&times;</span>
        </button>
        <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
        {{ session('status.message') }}
    </div> --}}
@endif
