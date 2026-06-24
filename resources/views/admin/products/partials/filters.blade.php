<div class="card border-0 shadow-sm rounded-4 mb-4 bg-white">
    <div class="card-body p-3">
        <form method="GET" action="{{ route('admin.products.index') }}" class="row g-2 align-items-center">
            <div class="col-md-5">
                <div class="position-relative">
                    <i class="bi bi-search text-muted position-absolute top-50 start-0 translate-middle-y ms-3" style="font-size: 0.9rem;"></i>
                    <input type="text" name="search" value="{{ request('search') }}"
                           class="form-control rounded-3 py-2 ps-5 text-dark small" placeholder="Search product title, SKU, handle...">
                </div>
            </div>
            <div class="col-md-4">
                <select name="category_id" class="form-select rounded-3 py-2 text-dark small">
                    <option value="">All Categories</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3 d-flex gap-2">
                <button type="submit" class="btn btn-dark btn-sm rounded-3 w-100 fw-medium py-2">Filter</button>
                <a href="{{ route('admin.products.index') }}" class="btn btn-light border border-light-subtle btn-sm rounded-3 w-100 fw-medium py-2 text-dark">Reset</a>
            </div>
        </form>
    </div>
</div>
