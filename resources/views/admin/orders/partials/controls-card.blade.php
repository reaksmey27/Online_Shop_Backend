<div class="card border-0 shadow-sm rounded-4">
    <div class="card-header border-bottom px-4 py-3">
        <h6 class="mb-0 fw-bold" style="color:var(--text);">Update Order</h6>
    </div>
    <div class="card-body p-4">
        <form method="POST" action="{{ route('admin.orders.update', $order) }}">
            @csrf
            @method('PUT')
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label text-muted small fw-medium">Order Status</label>
                    <select name="status" class="form-select rounded-3 py-2 small">
                        @foreach(['pending','processing','shipped','delivered','completed','cancelled'] as $s)
                            <option value="{{ $s }}" {{ $order->status === $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label text-muted small fw-medium">Payment Status</label>
                    <select name="payment_status" class="form-select rounded-3 py-2 small">
                        @foreach(['unpaid','paid','refunded'] as $p)
                            <option value="{{ $p }}" {{ $order->payment_status === $p ? 'selected' : '' }}>{{ ucfirst($p) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 pt-2">
                    <button type="submit" class="btn btn-dark btn-sm rounded-3 fw-medium px-4 py-2">
                        <i class="bi bi-check-lg me-1"></i> Save Changes
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
