@extends('admin.layouts.app')
@section('title', 'Users')
@section('breadcrumb', 'Users')

@section('content')
<div class="container-fluid px-2">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-1" style="color:var(--text);">Users</h4>
            <p class="text-muted small mb-0">Manage customer accounts and view order history.</p>
        </div>
    </div>

    @include('admin.users.partials.filters')
    @include('admin.users.partials.table')

</div>

@include('admin.users.partials.modal')
@endsection

@push('scripts')
    @include('admin.users.partials.scripts')
@endpush
