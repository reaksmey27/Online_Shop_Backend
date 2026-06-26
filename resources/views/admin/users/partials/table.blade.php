<div class="card border-0 shadow-sm rounded-4 overflow-hidden">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr class="text-uppercase text-muted fw-bold" style="font-size:.75rem; letter-spacing:.05em;">
                    <th class="border-0 px-4 py-3">#</th>
                    <th class="border-0 py-3">Name</th>
                    <th class="border-0 py-3">Email</th>
                    <th class="border-0 py-3">Orders</th>
                    <th class="border-0 py-3">Joined</th>
                    <th class="border-0 text-end px-4 py-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                    <tr>
                        <td class="px-4 py-3 text-muted fw-medium">{{ $loop->iteration }}</td>
                        <td class="py-3">
                            <div class="d-flex align-items-center gap-2">
                                <div class="user-avatar rounded-circle d-flex align-items-center justify-content-center fw-bold"
                                     style="width:38px; height:38px; font-size:.85rem; flex-shrink:0;">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                                <span class="fw-semibold" style="color:var(--text);">{{ $user->name }}</span>
                            </div>
                        </td>
                        <td class="py-3 text-muted small">{{ $user->email }}</td>
                        <td class="py-3">
                            <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill fw-semibold px-3" style="font-size:.75rem;">
                                {{ number_format($user->orders_count) }}
                            </span>
                        </td>
                        <td class="py-3 text-muted small">{{ $user->created_at->format('M d, Y') }}</td>
                        <td class="text-end px-4 py-3">
                            <div class="d-flex gap-1 justify-content-end">
                                <button type="button" class="btn btn-sm btn-light rounded-3 fw-medium px-3 d-flex align-items-center gap-1"
                                        data-bs-toggle="modal" data-bs-target="#showUserModal"
                                        data-name="{{ $user->name }}"
                                        data-email="{{ $user->email }}"
                                        data-joined="{{ $user->created_at->format('M d, Y') }}"
                                        data-orders-count="{{ $user->orders->count() }}"
                                        data-total-spent="${{ number_format($user->orders->sum('total_amount'), 2) }}"
                                        data-orders-json="{{ json_encode($user->orders->map(function($order) {
                                            return [
                                                'id'           => $order->id,
                                                'items_count'  => $order->items->count(),
                                                'total_amount' => number_format($order->total_amount, 2),
                                                'status'       => ucfirst($order->status),
                                                'status_raw'   => $order->status,
                                                'date'         => $order->created_at->format('M d, Y'),
                                                'url'          => route('admin.orders.show', $order->id),
                                            ];
                                        })) }}">
                                    <i class="bi bi-eye"></i> View
                                </button>
                                @if(auth()->id() !== $user->id)
                                    <form method="POST" action="{{ route('admin.users.destroy', $user) }}"
                                          onsubmit="return confirm('Delete this user and all their data?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-light rounded-3 text-danger px-3">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-5">
                            <div class="py-4">
                                <div class="rounded-circle d-inline-flex align-items-center justify-content-center p-3 mb-3"
                                     style="width:64px; height:64px; background:var(--surface-2);">
                                    <i class="bi bi-people text-muted fs-3 opacity-50"></i>
                                </div>
                                <p class="mb-1 fw-bold" style="color:var(--text);">No users found</p>
                                <span class="text-muted small">Try adjusting your search.</span>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($users->hasPages())
        <div class="card-footer d-flex justify-content-between align-items-center px-4 py-3">
            <span class="text-muted small">Showing <strong>{{ $users->firstItem() }}</strong>–<strong>{{ $users->lastItem() }}</strong> of <strong>{{ $users->total() }}</strong></span>
            <div class="pagination-clean">{{ $users->links('pagination::bootstrap-5') }}</div>
        </div>
    @endif
</div>
