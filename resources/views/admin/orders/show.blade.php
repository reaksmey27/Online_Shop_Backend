@extends('admin.layouts.app')
@section('title', 'Order Detail')

@section('content')
<div class="container-fluid px-2">

    {{-- Layout Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold text-dark mb-1">Order: 0{{ $order->id }}</h4>
            <p class="text-muted small mb-0">Review detailed ledger parameters, product allocation metrics, and logistics criteria.</p>
        </div>
        <a href="{{ route('admin.orders.index') }}" class="btn btn-light border border-light-subtle btn-sm rounded-3 text-dark px-3 py-2 fw-medium">
            <i class="bi bi-arrow-left me-1"></i> Back to Feed
        </a>
    </div>

    <div class="row g-4">
        {{-- Left Column: Core Items & Control Vectors --}}
        <div class="col-lg-8">
            @include('admin.orders.partials.items-table')
            @include('admin.orders.partials.controls-card')
        </div>

        {{-- Right Column: Customer Profile & Logistics Metadata --}}
        <div class="col-lg-4">
            @include('admin.orders.partials.customer-card')
            @include('admin.orders.partials.registry-card')
            @include('admin.orders.partials.shipping-card')
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .form-control:focus, .form-select:focus {
        border-color: var(--bs-dark);
        box-shadow: 0 0 0 0.25rem rgba(33, 37, 41, 0.1);
    }
</style>
@endpush
