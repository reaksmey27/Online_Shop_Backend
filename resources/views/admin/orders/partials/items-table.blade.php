<div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
    <div class="card-header border-bottom px-4 py-3">
        <h6 class="mb-0 fw-bold" style="color:var(--text);">Order Items</h6>
    </div>
    <div class="table-responsive">
        <table class="table align-middle mb-0">
            <thead class="table-light">
                <tr class="text-uppercase text-muted fw-bold" style="font-size:.75rem; letter-spacing:.05em;">
                    <th class="border-0 px-4 py-3">Product</th>
                    <th class="border-0 py-3">Unit Price</th>
                    <th class="border-0 py-3">Qty</th>
                    <th class="border-0 text-end px-4 py-3">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $item)
                    <tr>
                        <td class="px-4 py-3">
                            <div class="d-flex align-items-center gap-3">
                                @if($item->product?->image_url)
                                    <img src="{{ $item->product->image_url }}" class="rounded-3"
                                         style="width:42px; height:42px; object-fit:cover; border:1px solid var(--border);"
                                         onerror="this.src='https://placehold.co/42x42?text=N/A'">
                                @else
                                    <div class="rounded-3 d-flex align-items-center justify-content-center"
                                         style="width:42px; height:42px; flex-shrink:0; background:var(--surface-2); border:1px solid var(--border);">
                                        <i class="bi bi-image text-muted opacity-50"></i>
                                    </div>
                                @endif
                                <span class="fw-semibold small" style="color:var(--text);">{{ $item->product->name ?? 'Deleted product' }}</span>
                            </div>
                        </td>
                        <td class="py-3 text-muted small">${{ number_format($item->price, 2) }}</td>
                        <td class="py-3 text-muted small">{{ $item->quantity }}</td>
                        <td class="fw-bold text-end px-4 py-3 small" style="color:var(--text);">${{ number_format($item->price * $item->quantity, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot class="table-light">
                <tr>
                    <td colspan="3" class="text-end fw-bold text-muted text-uppercase small px-4 py-3" style="letter-spacing:.05em;">Total</td>
                    <td class="fw-bold text-success fs-5 text-end px-4 py-3">${{ number_format($order->total_amount, 2) }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
