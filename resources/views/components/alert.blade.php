@if (session()->has($type))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{ session()->get($type) }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
