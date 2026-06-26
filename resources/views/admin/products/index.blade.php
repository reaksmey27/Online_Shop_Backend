@extends('admin.layouts.app')
@section('title', 'Products')
@section('breadcrumb', 'Products')

@section('content')
<div class="container-fluid px-2">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-1" style="color:var(--text);">Products</h4>
            <p class="text-muted small mb-0">Manage inventory, pricing, and availability.</p>
        </div>
        <button type="button" class="btn btn-dark btn-sm rounded-3 px-3 py-2 fw-medium d-flex align-items-center gap-1"
                data-bs-toggle="modal" data-bs-target="#createProductModal">
            <i class="bi bi-plus-lg fs-6"></i> Add Product
        </button>
    </div>

    @include('admin.products.partials.filters')
    @include('admin.products.partials.table')

</div>

@include('admin.products.partials.create-modal')
@include('admin.products.partials.edit-modal')
@include('admin.products.partials.show-modal')
@endsection

@push('scripts')
    @include('admin.products.partials.image-script')
@endpush
