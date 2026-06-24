<div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="bg-light table-light">
                <tr class="text-uppercase text-muted fw-bold" style="font-size: 0.75rem; letter-spacing: 0.05em;">
                    <th class="border-0 px-4 py-3">No</th>
                    <th class="border-0 py-3">Display</th>
                    <th class="border-0 py-3">Product Name</th>
                    <th class="border-0 py-3">Collection Class</th>
                    <th class="border-0 py-3">Unit Price</th>
                    <th class="border-0 py-3">Stock Metrics</th>
                    <th class="border-0 py-3">Visibility Status</th>
                    <th class="border-0 text-end px-4 py-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                    <tr class="border-bottom border-light-subtle">
                        <td class="px-4 py-3 text-secondary fw-medium">{{ $loop->iteration }}</td>
                        <td class="py-3">
                            @if($product->image_url)
                                <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="rounded-3 border border-light-subtle"
                                     style="width: 44px; height: 44px; object-fit: cover;"
                                     onerror="this.src='https://placehold.co/44x44?text=No+Img'">
                            @else
                                <div class="rounded-3 bg-light text-secondary d-flex align-items-center justify-content-center border border-light-subtle" style="width: 44px; height: 44px;">
                                    <i class="bi bi-image opacity-50 fs-5"></i>
                                </div>
                            @endif
                        </td>
                        <td class="py-3"><span class="fw-semibold text-dark d-block">{{ $product->name }}</span></td>
                        <td class="py-3">
                            <span class="badge bg-primary bg-opacity-10 text-primary px-2.5 py-1.5 rounded-pill fw-semibold" style="font-size: 0.75rem;">
                                {{ $product->category->name ?? 'Unclassified' }}
                            </span>
                        </td>
                        <td class="py-3 fw-semibold text-dark">${{ number_format($product->price, 2) }}</td>
                        <td class="py-3">
                            @if($product->stock <= 0)
                                <span class="badge bg-danger bg-opacity-10 text-danger px-2.5 py-1.5 rounded-pill fw-semibold" style="font-size: 0.75rem;">Out of Stock</span>
                            @elseif($product->stock <= 10)
                                <span class="badge bg-warning bg-opacity-10 text-warning px-2.5 py-1.5 rounded-pill fw-semibold" style="font-size: 0.75rem;">Low Stock ({{ $product->stock }})</span>
                            @else
                                <span class="badge bg-success bg-opacity-10 text-success px-2.5 py-1.5 rounded-pill fw-semibold" style="font-size: 0.75rem;">{{ number_format($product->stock) }} available</span>
                            @endif
                        </td>
                        <td class="py-3">
                            @if($product->is_active)
                                <span class="badge bg-success bg-opacity-10 text-success px-2.5 py-1.5 rounded-pill fw-semibold" style="font-size: 0.75rem;">
                                    <span class="spinner-grow spinner-grow-sm text-success me-1 d-inline-block" role="status" style="width: 6px; height: 6px; vertical-align: middle;"></span>Active
                                </span>
                            @else
                                <span class="badge bg-secondary bg-opacity-10 text-secondary px-2.5 py-1.5 rounded-pill fw-semibold" style="font-size: 0.75rem;">Disabled</span>
                            @endif
                        </td>
                        <td class="text-end px-4 py-3">
                            <div class="d-flex gap-1 justify-content-end">
                                <button type="button" class="btn btn-sm btn-light border border-light-subtle rounded-3 text-dark px-2.5"
                                        data-bs-toggle="modal"
                                        data-bs-target="#showProductModal"
                                        data-name="{{ $product->name }}"
                                        data-image="{{ $product->image_url ?? '' }}"
                                        data-price="${{ number_format($product->price, 2) }}"
                                        data-category="{{ $product->category->name ?? 'Unclassified' }}"
                                        data-slug="{{ $product->slug }}"
                                        data-stock="{{ $product->stock }}"
                                        data-rating="{{ number_format($product->average_rating, 1) }}"
                                        data-reviews-count="{{ $product->reviews->count() }}"
                                        data-created="{{ $product->created_at->format('M d, Y') }}"
                                        data-description="{{ $product->description ?? '' }}"
                                        data-active="{{ $product->is_active }}">
                                    <i class="bi bi-eye"></i>
                                </button>

                                <button type="button" class="btn btn-sm btn-light border border-light-subtle rounded-3 text-dark px-2.5 fw-medium"
                                        data-bs-toggle="modal"
                                        data-bs-target="#editProductModal"
                                        data-id="{{ $product->id }}"
                                        data-name="{{ $product->name }}"
                                        data-category-id="{{ $product->category_id }}"
                                        data-price="{{ $product->price }}"
                                        data-stock="{{ $product->stock }}"
                                        data-description="{{ $product->description }}"
                                        data-active="{{ $product->is_active }}"
                                        data-image="{{ $product->image_url ?? '' }}"
                                        data-url="{{ route('admin.products.update', $product) }}">
                                    <i class="bi bi-pencil me-1"></i> Edit
                                </button>

                                <form method="POST" action="{{ route('admin.products.destroy', $product) }}" onsubmit="return confirm('Are you sure you want to delete this product?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-light border border-light-subtle rounded-3 text-danger px-2.5"><i class="bi bi-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted py-5">
                            <div class="py-5">
                                <div class="rounded-circle bg-light d-inline-flex align-items-center justify-content-center p-3 mb-3" style="width: 64px; height: 64px;">
                                    <i class="bi bi-box-seam text-secondary opacity-50 fs-3"></i>
                                </div>
                                <p class="mb-1 fw-bold text-dark">No products available</p>
                                <span class="text-muted small d-block mb-3">Get started by onboarding your very first storefront item.</span>
                                <button type="button" class="btn btn-sm btn-dark rounded-3 px-3" data-bs-toggle="modal" data-bs-target="#createProductModal">Create Product</button>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination Module Footer --}}
    @if($products->hasPages())
        <div class="card-footer bg-white border-top d-flex justify-content-between align-items-center px-4 py-3">
            <span class="text-muted small">Showing <strong>{{ $products->firstItem() }}</strong> to <strong>{{ $products->lastItem() }}</strong> of <strong>{{ $products->total() }}</strong> records</span>
            <div class="pagination-clean">{{ $products->links('pagination::bootstrap-5') }}</div>
        </div>
    @endif
</div>
