@extends('admin.layouts.app')
@section('title', 'Users')

@section('content')
<div class="container-fluid px-2">

    {{-- Header Layout --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold text-dark mb-1">Ecosystem Users</h4>
            <p class="text-muted small mb-0">Monitor platform accounts, historical purchasing metrics, and registration profiles.</p>
        </div>
    </div>

    {{-- Search Filter Form Component --}}
    @include('admin.users.partials.filters')

    {{-- Core Datatable Dataset Component --}}
    @include('admin.users.partials.table')

</div>

{{-- Expanded Dual-Pane Modal Overlay Component --}}
@include('admin.users.partials.modal')

@endsection

@push('styles')
<style>
    .form-control:focus, .form-select:focus {
        border-color: var(--bs-dark);
        box-shadow: 0 0 0 0.25rem rgba(33, 37, 41, 0.1);
    }
    .pagination-clean .pagination { margin-bottom: 0; }
    .pagination-clean .page-link { padding: 0.375rem 0.75rem; font-size: 0.85rem; border-radius: 0.375rem; margin: 0 2px; color: var(--bs-dark); border-color: var(--bs-border-color-translucent); }
    .pagination-clean .page-item.active .page-link { background-color: var(--bs-dark); border-color: var(--bs-dark); color: var(--bs-white); }
</style>
@endpush

@push('scripts')
    @include('admin.users.partials.scripts')
@endpush
