@extends('admin.layouts.app')
@section('title', 'Orders')
@section('breadcrumb', 'Orders')

@section('content')
<div class="container-fluid px-2">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-1" style="color:var(--text);">Orders</h4>
            <p class="text-muted small mb-0">Track and manage customer orders.</p>
        </div>
    </div>

    {{-- Filters --}}
    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body p-3">
            <form method="GET" action="{{ route('admin.orders.index') }}" class="row g-2 align-items-center">
                <div class="col-md-5">
                    <div class="position-relative">
                        <i class="bi bi-search text-muted position-absolute top-50 start-0 translate-middle-y ms-3" style="font-size:.9rem;"></i>
                        <input type="text" name="search" value="{{ request('search') }}"
                               class="form-control rounded-3 py-2 ps-5 small" placeholder="Search by order ID or customer name…">
                    </div>
                </div>
                <div class="col-md-4">
                    <select name="status" class="form-select rounded-3 py-2 small">
                        <option value="">All Statuses</option>
                        @foreach(['pending','processing','shipped','delivered','cancelled'] as $s)
                            <option value="{{ $s }}" {{ request('status') === $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 d-flex gap-2">
                    <button type="submit" class="btn btn-dark btn-sm rounded-3 w-100 fw-medium py-2">Filter</button>
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-light btn-sm rounded-3 w-100 fw-medium py-2">Reset</a>
                </div>
            </form>
        </div>
    </div>

    {{-- Table --}}
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr class="text-uppercase text-muted fw-bold" style="font-size:.75rem; letter-spacing:.05em;">
                        <th class="border-0 px-4 py-3">Order ID</th>
                        <th class="border-0 py-3">Customer</th>
                        <th class="border-0 py-3">Amount</th>
                        <th class="border-0 py-3">Status</th>
                        <th class="border-0 py-3">Payment</th>
                        <th class="border-0 py-3">Date</th>
                        <th class="border-0 text-end px-4 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                        <tr>
                            <td class="px-4 py-3 fw-semibold" style="color:var(--text);">{{ $order->id }}</td>
                            <td class="py-3">
                                <div class="fw-semibold" style="color:var(--text);">{{ $order->user->name }}</div>
                                <div class="text-muted small">{{ $order->user->email }}</div>
                            </td>
                            <td class="py-3 fw-bold text-success">${{ number_format($order->total_amount, 2) }}</td>
                            <td class="py-3">
                                @php
                                    $statusColor = match($order->status) {
                                        'delivered'  => 'success',
                                        'pending'    => 'warning',
                                        'cancelled'  => 'danger',
                                        'processing' => 'info',
                                        'shipped'    => 'primary',
                                        default      => 'secondary',
                                    };
                                @endphp
                                <span class="badge bg-{{ $statusColor }} bg-opacity-10 text-{{ $statusColor }} rounded-pill fw-semibold px-3" style="font-size:.75rem;">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                            <td class="py-3">
                                @php
                                    $payColor = match($order->payment_status) {
                                        'paid'     => 'success',
                                        'unpaid'   => 'warning',
                                        'refunded' => 'danger',
                                        default    => 'secondary',
                                    };
                                @endphp
                                <span class="badge bg-{{ $payColor }} bg-opacity-10 text-{{ $payColor }} rounded-pill fw-semibold px-3" style="font-size:.75rem;">
                                    {{ ucfirst($order->payment_status) }}
                                </span>
                            </td>
                            <td class="py-3 text-muted small">{{ $order->created_at->format('M d, Y') }}</td>
                            <td class="text-end px-4 py-3">
                                <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-sm btn-light rounded-3 fw-medium px-3 d-inline-flex align-items-center gap-1">
                                    <i class="bi bi-eye"></i> View
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <div class="py-4">
                                    <div class="rounded-circle d-inline-flex align-items-center justify-content-center p-3 mb-3"
                                         style="width:64px; height:64px; background:var(--surface-2);">
                                        <i class="bi bi-inbox text-muted fs-3 opacity-50"></i>
                                    </div>
                                    <p class="mb-1 fw-bold" style="color:var(--text);">No orders found</p>
                                    <span class="text-muted small">Try adjusting your filters.</span>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($orders->hasPages())
            <div class="card-footer d-flex justify-content-between align-items-center px-4 py-3">
                <span class="text-muted small">Showing <strong>{{ $orders->firstItem() }}</strong>–<strong>{{ $orders->lastItem() }}</strong> of <strong>{{ $orders->total() }}</strong></span>
                <div class="pagination-clean">{{ $orders->links('pagination::bootstrap-5') }}</div>
            </div>
        @endif
    </div>
</div>
@endsection
