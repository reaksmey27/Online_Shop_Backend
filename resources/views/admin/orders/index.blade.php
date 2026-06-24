@extends('admin.layouts.app')
@section('title', 'Orders')

@section('content')
<div class="container-fluid px-2">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold text-dark mb-1">Ecosystem Orders</h4>
            <p class="text-muted small mb-0">Track commercial checkout pipelines, transaction settlements, and customer order fulfillment.</p>
        </div>
    </div>

    {{-- Search Filter Card --}}
    <div class="card border-0 shadow-sm rounded-4 mb-4 bg-white">
        <div class="card-body p-3">
            <form method="GET" action="{{ route('admin.orders.index') }}" class="row g-2 align-items-center">
                <div class="col-md-5">
                    <div class="position-relative">
                        <i class="bi bi-search text-muted position-absolute top-50 start-0 translate-middle-y ms-3" style="font-size: 0.9rem;"></i>
                        <input type="text" name="search" value="{{ request('search') }}"
                               class="form-control rounded-3 py-2 ps-5 text-dark small" placeholder="Filter by order ID, customer profile name...">
                    </div>
                </div>
                <div class="col-md-4">
                    <select name="status" class="form-select rounded-3 py-2 text-dark small">
                        <option value="">All Statuses</option>
                        @foreach(['pending', 'processing', 'shipped', 'delivered', 'cancelled'] as $s)
                            <option value="{{ $s }}" {{ request('status') === $s ? 'selected' : '' }}>
                                {{ ucfirst($s) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 d-flex gap-2">
                    <button type="submit" class="btn btn-dark btn-sm rounded-3 w-100 fw-medium py-2">Filter</button>
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-light border border-light-subtle btn-sm rounded-3 w-100 fw-medium py-2 text-dark">Reset</a>
                </div>
            </form>
        </div>
    </div>

    {{-- Orders Table Card --}}
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light table-light">
                    <tr class="text-uppercase text-muted fw-bold" style="font-size: 0.75rem; letter-spacing: 0.05em;">
                        <th class="border-0 px-4 py-3">Order ID</th>
                        <th class="border-0 py-3">Customer Identity</th>
                        <th class="border-0 py-3">Total Amount</th>
                        <th class="border-0 py-3">Fulfillment Status</th>
                        <th class="border-0 py-3">Payment Settlement</th>
                        <th class="border-0 py-3">Checkout Date</th>
                        <th class="border-0 text-end px-4 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                        <tr class="border-bottom border-light-subtle">
                            <td class="px-4 py-3 fw-semibold text-dark">{{ $order->id }}</td>
                            <td class="py-3">
                                <div class="fw-semibold text-dark mb-0.5">{{ $order->user->name }}</div>
                                <div class="text-secondary small">{{ $order->user->email }}</div>
                            </td>
                            <td class="py-3 fw-bold text-success">
                                ${{ number_format($order->total_amount, 2) }}
                            </td>
                            <td class="py-3">
                                @php
                                    $statusBadge = match($order->status) {
                                        'delivered'  => 'success',
                                        'pending'    => 'warning',
                                        'cancelled'  => 'danger',
                                        'processing' => 'info',
                                        'shipped'    => 'primary',
                                        default      => 'secondary',
                                    };
                                @endphp
                                <span class="badge bg-{{ $statusBadge }} bg-opacity-10 text-{{ $statusBadge }} px-2.5 py-1.5 rounded-pill fw-semibold" style="font-size: 0.75rem;">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                            <td class="py-3">
                                @php
                                    $payBadge = match($order->payment_status) {
                                        'paid'      => 'success',
                                        'unpaid'    => 'warning',
                                        'refunded'  => 'danger',
                                        default     => 'secondary',
                                    };
                                @endphp
                                <span class="badge bg-{{ $payBadge }} bg-opacity-10 text-{{ $payBadge }} px-2.5 py-1.5 rounded-pill fw-semibold" style="font-size: 0.75rem;">
                                    {{ ucfirst($order->payment_status) }}
                                </span>
                            </td>
                            <td class="py-3 text-muted small">
                                {{ $order->created_at->format('M d, Y') }}
                            </td>
                            <td class="text-end px-4 py-3">
                                <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-sm btn-light border border-light-subtle rounded-3 text-dark px-2.5 py-1.5 fw-medium small d-inline-flex align-items-center gap-1">
                                    <i class="bi bi-eye"></i> View
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-5">
                                <div class="py-5">
                                    <div class="rounded-circle bg-light d-inline-flex align-items-center justify-content-center p-3 mb-3" style="width: 64px; height: 64px;">
                                        <i class="bi bi-inbox text-secondary opacity-50 fs-3"></i>
                                    </div>
                                    <p class="mb-1 fw-bold text-dark">No transaction items found</p>
                                    <span class="text-muted small">Ecosystem database contains no matching active order records.</span>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination Footer --}}
        @if($orders->hasPages())
            <div class="card-footer bg-white border-top d-flex justify-content-between align-items-center px-4 py-3">
                <span class="text-muted small">Showing <strong>{{ $orders->firstItem() }}</strong> to <strong>{{ $orders->lastItem() }}</strong> of <strong>{{ $orders->total() }}</strong> orders</span>
                <div class="pagination-clean">{{ $orders->links('pagination::bootstrap-5') }}</div>
            </div>
        @endif
    </div>
</div>

<style>
    .form-control:focus, .form-select:focus {
        border-color: var(--bs-dark);
        box-shadow: 0 0 0 0.25rem rgba(33, 37, 41, 0.1);
    }
    .pagination-clean .pagination { margin-bottom: 0; }
    .pagination-clean .page-link { padding: 0.375rem 0.75rem; font-size: 0.85rem; border-radius: 0.375rem; margin: 0 2px; color: var(--bs-dark); border-color: var(--bs-border-color-translucent); }
    .pagination-clean .page-item.active .page-link { background-color: var(--bs-dark); border-color: var(--bs-dark); color: var(--bs-white); }
</style>
@endsection
