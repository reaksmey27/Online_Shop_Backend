<div class="card border-0 shadow-sm rounded-4 mb-4">
    <div class="card-body p-3">
        <form method="GET" action="{{ route('admin.categories.index') }}" class="row g-2 align-items-center">
            <div class="col-md-4">
                <div class="position-relative">
                    <i class="bi bi-search text-muted position-absolute top-50 start-0 translate-middle-y ms-3" style="font-size:.9rem;"></i>
                    <input type="text" name="search" value="{{ request('search') }}"
                           class="form-control rounded-3 py-2 ps-5 small" placeholder="Search categories…">
                </div>
            </div>
            <div class="col-md-2">
                <select name="status" class="form-select rounded-3 py-2 small">
                    <option value="">All Status</option>
                    <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
            <div class="col-md-3">
                <select name="products_sort" class="form-select rounded-3 py-2 small">
                    <option value="">Sort by Products</option>
                    <option value="asc" {{ request('products_sort') === 'asc' ? 'selected' : '' }}>Fewer Products First</option>
                    <option value="desc" {{ request('products_sort') === 'desc' ? 'selected' : '' }}>More Products First</option>
                </select>
            </div>
            <div class="col-md-3 d-flex gap-2">
                <button type="submit" class="btn btn-dark btn-sm rounded-3 w-100 fw-medium py-2">Filter</button>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-light btn-sm rounded-3 w-100 fw-medium py-2">Reset</a>
            </div>
        </form>
    </div>
</div>
