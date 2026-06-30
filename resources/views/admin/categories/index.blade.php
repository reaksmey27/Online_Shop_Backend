@extends('admin.layouts.app')
@section('title', 'Categories')
@section('breadcrumb', 'Categories')

@section('content')
<div class="container-fluid px-2">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-1" style="color:var(--text);">Categories</h4>
            <p class="text-muted small mb-0">Manage product categories.</p>
        </div>
        <button type="button" class="btn btn-dark btn-sm rounded-3 px-3 py-2 fw-medium d-flex align-items-center gap-1"
                data-bs-toggle="modal" data-bs-target="#createCategoryModal">
            <i class="bi bi-plus-lg fs-6"></i> Add Category
        </button>
    </div>

    @include('admin.categories.partials.filter')

    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr class="text-uppercase text-muted fw-bold" style="font-size:.75rem; letter-spacing:.05em;">
                        <th class="border-0 px-4 py-3">#</th>
                        <th class="border-0 py-3">Image</th>
                        <th class="border-0 py-3">Name</th>
                        <th class="border-0 py-3">Slug</th>
                        <th class="border-0 py-3">Products</th>
                        <th class="border-0 py-3">Status</th>
                        <th class="border-0 text-end px-4 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $category)
                        <tr>
                            <td class="px-4 py-3 text-muted fw-medium">{{ $loop->iteration }}</td>
                            <td class="py-3">
                                @if($category->image_url)
                                    <img src="{{ $category->image_url }}" alt="{{ $category->name }}"
                                         class="rounded-3" style="width:44px; height:44px; object-fit:cover; border:1px solid var(--border);"
                                         onerror="this.src='https://placehold.co/44x44?text=?'">
                                @else
                                    <div class="rounded-3 d-flex align-items-center justify-content-center"
                                         style="width:44px; height:44px; background:var(--surface-2); border:1px solid var(--border);">
                                        <i class="bi bi-image text-muted opacity-50 fs-5"></i>
                                    </div>
                                @endif
                            </td>
                            <td class="py-3 fw-semibold" style="color:var(--text);">{{ $category->name }}</td>
                            <td class="py-3">
                                <code class="text-muted px-2 py-1 rounded small">{{ $category->slug }}</code>
                            </td>
                            <td class="py-3">
                                <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill fw-semibold px-3" style="font-size:.75rem;">
                                    {{ number_format($category->products_count) }}
                                </span>
                            </td>
                            <td class="py-3">
                                @if($category->is_active)
                                    <span class="badge bg-success bg-opacity-10 text-success rounded-pill fw-semibold px-3" style="font-size:.75rem;">
                                        <span class="spinner-grow spinner-grow-sm text-success me-1" role="status" style="width:6px; height:6px; vertical-align:middle;"></span>
                                        Active
                                    </span>
                                @else
                                    <span class="badge bg-secondary bg-opacity-10 text-secondary rounded-pill fw-semibold px-3" style="font-size:.75rem;">Inactive</span>
                                @endif
                            </td>
                            <td class="text-end px-4 py-3">
                                <div class="d-flex gap-1 justify-content-end">
                                    <button type="button" class="btn btn-sm btn-light rounded-3 fw-medium px-3"
                                            data-bs-toggle="modal" data-bs-target="#editCategoryModal"
                                            data-id="{{ $category->id }}"
                                            data-name="{{ $category->name }}"
                                            data-description="{{ $category->description }}"
                                            data-active="{{ $category->is_active }}"
                                            data-image="{{ $category->image_url ?? '' }}"
                                            data-url="{{ route('admin.categories.update', $category) }}">
                                        <i class="bi bi-pencil me-1"></i> Edit
                                    </button>
                                    <form method="POST" action="{{ route('admin.categories.destroy', $category) }}"
                                          onsubmit="return confirm('Delete this category?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-light rounded-3 text-danger px-3">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        @include('admin.categories.partials.empty-state')
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($categories->hasPages())
            <div class="card-footer d-flex justify-content-between align-items-center px-4 py-3">
                <span class="text-muted small">Showing <strong>{{ $categories->firstItem() }}</strong>–<strong>{{ $categories->lastItem() }}</strong> of <strong>{{ $categories->total() }}</strong></span>
                <div class="pagination-clean">{{ $categories->links('pagination::bootstrap-5') }}</div>
            </div>
        @endif
    </div>
</div>

@include('admin.categories.partials.create-modal')
@include('admin.categories.partials.edit-modal')
@endsection

@push('scripts')
    @include('admin.categories.partials.image-script')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const editModal = document.getElementById('editCategoryModal');
            if (!editModal) return;
            editModal.addEventListener('show.bs.modal', function (event) {
                const btn = event.relatedTarget;
                const form = editModal.querySelector('#editCategoryForm');
                form.setAttribute('action', btn.getAttribute('data-url'));
                editModal.querySelector('#edit_name').value        = btn.getAttribute('data-name');
                editModal.querySelector('#edit_description').value = btn.getAttribute('data-description') || '';
                const activeSwitch = editModal.querySelector('#edit_is_active');
                if (activeSwitch) activeSwitch.checked = (btn.getAttribute('data-active') == '1');
            });
        });
    </script>
@endpush
