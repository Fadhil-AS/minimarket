@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong class="mt-2 swalDefaultSuccess">{{session('success')}}</strong>
        {{-- <button type="button" class="btn btn-success swalDefaultSuccess">
            {{session('success')}}
        </button> --}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong class="mt-2 swalDefaultError">{{ session('error') }}</strong>
        {{-- <button type="button" class="btn btn-danger swalDefaultError">
            {{session('error')}}
        </button> --}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif