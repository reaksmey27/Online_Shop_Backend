<div class="card border-0 shadow-sm rounded-4 mb-4">
    <div class="card-body p-3">
        <form method="GET" action="{{ route('admin.products.index') }}" class="row g-2 align-items-center">
            <div class="col-md-3">
                <div class="position-relative">
                    <i class="bi bi-search text-muted position-absolute top-50 start-0 translate-middle-y ms-3" style="font-size:.9rem;"></i>
                    <input type="text" name="search" value="{{ request('search') }}"
                           class="form-control rounded-3 py-2 ps-5 small" placeholder="Search products…">
                </div>
            </div>
            <div class="col-md-2">
                <select name="category_id" class="form-select rounded-3 py-2 small">
                    <option value="">All Categories</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <select name="status" class="form-select rounded-3 py-2 small">
                    <option value="">All Status</option>
                    <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
            <div class="col-md-1">
                <input type="number" name="price_min" value="{{ request('price_min') }}" min="0" step="0.01"
                       class="form-control rounded-3 py-2 small" placeholder="Min $">
            </div>
            <div class="col-md-1">
                <input type="number" name="price_max" value="{{ request('price_max') }}" min="0" step="0.01"
                       class="form-control rounded-3 py-2 small" placeholder="Max $">
            </div>
            <div class="col-md-1 d-flex align-items-center justify-content-center">
                <div class="form-check">
                    <input type="checkbox" name="low_stock" value="1" id="lowStockFilter"
                           class="form-check-input" {{ request('low_stock') ? 'checked' : '' }}>
                    <label class="form-check-label small fw-medium text-danger" for="lowStockFilter">
                        Low stock
                    </label>
                </div>
            </div>
            <div class="col-md-2 d-flex gap-2">
                <button type="submit" class="btn btn-dark btn-sm rounded-3 w-100 fw-medium py-2">Filter</button>
                <a href="{{ route('admin.products.index') }}" class="btn btn-light btn-sm rounded-3 w-100 fw-medium py-2">Reset</a>
            </div>
        </form>
    </div>
</div>
