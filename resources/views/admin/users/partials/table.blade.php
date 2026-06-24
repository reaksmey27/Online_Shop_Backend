<div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="bg-light table-light">
                <tr class="text-uppercase text-muted fw-bold" style="font-size: 0.75rem; letter-spacing: 0.05em;">
                    <th class="border-0 px-4 py-3">No</th>
                    <th class="border-0 py-3">Display Name</th>
                    <th class="border-0 py-3">Email Address</th>
                    <th class="border-0 py-3">Order Allocation</th>
                    <th class="border-0 py-3">Registration Date</th>
                    <th class="border-0 text-end px-4 py-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                    <tr class="border-bottom border-light-subtle">
                        <td class="px-4 py-3 text-secondary fw-medium">{{ $loop->iteration }}</td>
                        <td class="py-3">
                            <div class="d-flex align-items-center gap-2.5">
                                <div class="rounded-circle bg-dark text-white d-flex align-items-center justify-content-center fw-bold text-center border border-light-subtle"
                                     style="width: 38px; height: 38px; font-size: 0.85rem; flex-shrink: 0; letter-spacing: -0.02em;">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                                <span class="fw-semibold text-dark">{{ $user->name }}</span>
                            </div>
                        </td>
                        <td class="py-3 text-secondary small">{{ $user->email }}</td>
                        <td class="py-3">
                            <span class="badge bg-primary bg-opacity-10 text-primary px-2.5 py-1.5 rounded-pill fw-semibold" style="font-size: 0.75rem;">
                                {{ number_format($user->orders_count) }} orders
                            </span>
                        </td>
                        <td class="py-3 text-muted small">{{ $user->created_at->format('M d, Y') }}</td>
                        <td class="text-end px-4 py-3">
                            <div class="d-flex gap-1 justify-content-end">
                                <button type="button" class="btn btn-sm btn-light border border-light-subtle rounded-3 text-dark px-2.5 py-1.5 fw-medium small d-flex align-items-center gap-1"
                                        data-bs-toggle="modal"
                                        data-bs-target="#showUserModal"
                                        data-name="{{ $user->name }}"
                                        data-email="{{ $user->email }}"
                                        data-joined="{{ $user->created_at->format('M d, Y') }}"
                                        data-orders-count="{{ $user->orders->count() }}"
                                        data-total-spent="${{ number_format($user->orders->sum('total_amount'), 2) }}"
                                        data-orders-json="{{ json_encode($user->orders->map(function($order) {
                                            return [
                                                'id' => $order->id,
                                                'items_count' => $order->items->count(),
                                                'total_amount' => number_format($order->total_amount, 2),
                                                'status' => ucfirst($order->status),
                                                'status_raw' => $order->status,
                                                'date' => $order->created_at->format('M d, Y'),
                                                'url' => route('admin.orders.show', $order->id)
                                            ];
                                        })) }}">
                                    <i class="bi bi-eye"></i> View
                                </button>

                                @if(auth()->id() !== $user->id)
                                    <form method="POST" action="{{ route('admin.users.destroy', $user) }}"
                                          onsubmit="return confirm('Are you sure you want to permanently strip account parameters and records for this customer profile?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-light border border-light-subtle rounded-3 text-danger px-2.5 py-1.5">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-5">
                            <div class="py-5">
                                <div class="rounded-circle bg-light d-inline-flex align-items-center justify-content-center p-3 mb-3" style="width: 64px; height: 64px;">
                                    <i class="bi bi-people text-secondary opacity-50 fs-3"></i>
                                </div>
                                <p class="mb-1 fw-bold text-dark">No consumer records located</p>
                                <span class="text-muted small">Ecosystem database is empty or matches no active filters.</span>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination Module --}}
    @if($users->hasPages())
        <div class="card-footer bg-white border-top d-flex justify-content-between align-items-center px-4 py-3">
            <span class="text-muted small">Showing <strong>{{ $users->firstItem() }}</strong> to <strong>{{ $users->lastItem() }}</strong> of <strong>{{ $users->total() }}</strong> customers</span>
            <div class="pagination-clean">{{ $users->links('pagination::bootstrap-5') }}</div>
        </div>
    @endif
</div>
