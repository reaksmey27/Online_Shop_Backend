@extends('admin.layouts.app')
@section('title', 'Products')

@section('content')
<div class="container-fluid px-2">

    {{-- Header Layout --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold text-dark mb-1">Products</h4>
            <p class="text-muted small mb-0">Manage your physical inventory, pricing structures, and stock availability.</p>
        </div>
        <button type="button" class="btn btn-dark btn-sm rounded-3 px-3 py-2 fw-medium d-flex align-items-center gap-1" data-bs-toggle="modal" data-bs-target="#createProductModal">
            <i class="bi bi-plus-lg fs-6"></i> Add Product
        </button>
    </div>

    {{-- Search Filters Component --}}
    @include('admin.products.partials.filters')

    {{-- Core Inventory Dataset Component --}}
    @include('admin.products.partials.table')

</div>

{{-- Sub-Component Modal Sheet Injection Matrix --}}
@include('admin.products.partials.create-modal')
@include('admin.products.partials.edit-modal')
@include('admin.products.partials.show-modal')

@endsection

@push('styles')
<style>
    .form-control:focus, .form-select:focus, .form-check-input:focus {
        border-color: var(--bs-dark);
        box-shadow: 0 0 0 0.25rem rgba(33, 37, 41, 0.1);
    }
    .form-check-input:checked {
        background-color: var(--bs-dark);
        border-color: var(--bs-dark);
    }
    .pagination-clean .pagination { margin-bottom: 0; }
    .pagination-clean .page-link { padding: 0.375rem 0.75rem; font-size: 0.85rem; border-radius: 0.375rem; margin: 0 2px; color: var(--bs-dark); border-color: var(--bs-border-color-translucent); }
    .pagination-clean .page-item.active .page-link { background-color: var(--bs-dark); border-color: var(--bs-dark); color: var(--bs-white); }
</style>
@endpush

@push('scripts')
    @include('admin.products.partials.image-script')
@endpush
