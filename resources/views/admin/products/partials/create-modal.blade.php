<div class="modal fade" id="createProductModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg rounded-4 bg-white mx-auto" style="max-width: 100%; width: 850px;">
            <div class="modal-header border-bottom border-light-subtle px-4 py-3">
                <h5 class="modal-title fw-bold text-dark fs-5">Add Product</h5>
                <button type="button" class="btn-close small shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body p-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-semibold text-dark small mb-1">Product Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" value="{{ old('name') }}" class="form-control rounded-3 py-2" placeholder="e.g. Wireless Headphones" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold text-dark small mb-1">Collection Class <span class="text-danger">*</span></label>
                                <select name="category_id" class="form-select rounded-3 py-2" required>
                                    <option value="">Select Category</option>
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="row g-2 mb-3">
                                <div class="col-6">
                                    <label class="form-label fw-semibold text-dark small mb-1">Price ($) <span class="text-danger">*</span></label>
                                    <input type="number" step="0.01" name="price" value="{{ old('price') }}" class="form-control rounded-3 py-2" placeholder="0.00" required>
                                </div>
                                <div class="col-6">
                                    <label class="form-label fw-semibold text-dark small mb-1">Stock Count <span class="text-danger">*</span></label>
                                    <input type="number" name="stock" value="{{ old('stock', 0) }}" class="form-control rounded-3 py-2" placeholder="0" required>
                                </div>
                            </div>
                            <div class="mb-0">
                                <label class="form-label fw-semibold text-dark small mb-1">Description</label>
                                <textarea name="description" rows="3" class="form-control rounded-3 py-2" placeholder="Describe this product details..."></textarea>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-0">
                                @include('admin.products.partials.image-input', ['imageCtx' => 'create'])
                            </div>
                        </div>
                    </div>

                    <div class="p-3 bg-light rounded-3 border border-light-subtle mt-4 mb-0">
                        <div class="form-check form-switch d-flex align-items-center gap-2 ps-0 mb-0">
                            <div class="position-relative ms-5">
                                <input class="form-check-input ms-0 float-none" type="checkbox" name="is_active" id="isActiveProductCreate" style="width: 2.2em; height: 1.15em; cursor: pointer;" checked>
                            </div>
                            <label class="form-check-label fw-semibold text-dark small ms-2" for="isActiveProductCreate" style="cursor: pointer;">Visibility Status (Active)</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top border-light-subtle px-4 py-3">
                    <button type="button" class="btn btn-light border border-light-subtle rounded-3 fw-medium text-dark px-3 py-2 small" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-dark rounded-3 fw-medium px-4 py-2 small d-flex align-items-center gap-1">
                        <i class="bi bi-check-lg fs-6"></i> Save Product
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
