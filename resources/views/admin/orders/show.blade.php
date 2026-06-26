@extends('admin.layouts.app')
@section('title', 'Order Detail')
@section('breadcrumb', 'Order #' . $order->id)

@section('content')
<div class="container-fluid px-2">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-1" style="color:var(--text);">Order #{{ $order->id }}</h4>
            <p class="text-muted small mb-0">Review items, status, and customer details.</p>
        </div>
        <a href="{{ route('admin.orders.index') }}" class="btn btn-light btn-sm rounded-3 px-3 py-2 fw-medium">
            <i class="bi bi-arrow-left me-1"></i> Back to Orders
        </a>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            @include('admin.orders.partials.items-table')
            @include('admin.orders.partials.controls-card')
        </div>
        <div class="col-lg-4">
            @include('admin.orders.partials.customer-card')
            @include('admin.orders.partials.registry-card')
            @include('admin.orders.partials.shipping-card')
        </div>
    </div>
</div>
@endsection
