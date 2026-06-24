@if($errors->any())
    <div class="alert alert-danger border-0 bg-danger bg-opacity-10 text-danger rounded-3 small px-3 py-2.5 mb-4 d-flex align-items-center" role="alert">
        <i class="bi bi-exclamation-circle-fill me-2 fs-6"></i>
        <div>
            {{ $errors->first() }}
        </div>
    </div>
@endif
