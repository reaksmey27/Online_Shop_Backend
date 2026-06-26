<div class="card border-0 shadow-sm rounded-4 mb-4">
    <div class="card-header border-bottom px-4 py-3">
        <h6 class="mb-0 fw-bold" style="color:var(--text);">Order Details</h6>
    </div>
    <div class="card-body p-4 small">
        <div class="d-flex justify-content-between align-items-center border-bottom py-2" style="border-color:var(--border) !important;">
            <span class="text-muted">Date</span>
            <span class="fw-semibold" style="color:var(--text);">{{ $order->created_at->format('M d, Y \a\t g:i A') }}</span>
        </div>
        <div class="d-flex justify-content-between align-items-center border-bottom py-2" style="border-color:var(--border) !important;">
            <span class="text-muted">Payment Method</span>
            <span class="fw-semibold" style="color:var(--text);">{{ ucfirst($order->payment_method ?? 'N/A') }}</span>
        </div>
        <div class="d-flex justify-content-between align-items-center border-bottom py-2" style="border-color:var(--border) !important;">
            <span class="text-muted">Order Status</span>
            @php
                $sc = match($order->status) {
                    'delivered' => 'success', 'pending' => 'warning',
                    'cancelled' => 'danger',  'processing' => 'info',
                    'shipped'   => 'primary', default => 'secondary',
                };
            @endphp
            <span class="badge bg-{{ $sc }} bg-opacity-10 text-{{ $sc }} rounded-pill fw-bold px-2" style="font-size:.7rem;">{{ ucfirst($order->status) }}</span>
        </div>
        <div class="d-flex justify-content-between align-items-center pt-2">
            <span class="text-muted">Payment Status</span>
            @php
                $pc = match($order->payment_status) {
                    'paid' => 'success', 'unpaid' => 'warning', 'refunded' => 'danger', default => 'secondary',
                };
            @endphp
            <span class="badge bg-{{ $pc }} bg-opacity-10 text-{{ $pc }} rounded-pill fw-bold px-2" style="font-size:.7rem;">{{ ucfirst($order->payment_status) }}</span>
        </div>
    </div>
</div>
