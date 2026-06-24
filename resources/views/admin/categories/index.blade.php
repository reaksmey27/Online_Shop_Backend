@extends('admin.layouts.app')
@section('title', 'Categories')

@section('content')
<div class="container-fluid px-2">

    {{-- Layout Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold text-dark mb-1">Categories</h4>
            <p class="text-muted small mb-0">Manage your store product classifications and structures.</p>
        </div>
        <button type="button" class="btn btn-dark btn-sm rounded-3 px-3 py-2 fw-medium d-flex align-items-center gap-1" data-bs-toggle="modal" data-bs-target="#createCategoryModal">
            <i class="bi bi-plus-lg fs-6"></i> Add Category
        </button>
    </div>

    {{-- Categories Central Datatable --}}
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light table-light">
                    <tr class="text-uppercase text-muted fw-bold" style="font-size: 0.75rem; letter-spacing: 0.05em;">
                        <th class="border-0 px-4 py-3">No</th>
                        <th class="border-0 py-3">Display</th>
                        <th class="border-0 py-3">Category Name</th>
                        <th class="border-0 py-3">Slug / Handle</th>
                        <th class="border-0 py-3">Inventory Size</th>
                        <th class="border-0 py-3">Visibility Status</th>
                        <th class="border-0 text-end px-4 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $category)
                        <tr class="border-bottom border-light-subtle">
                            <td class="px-4 py-3 text-secondary fw-medium">{{ $loop->iteration }}</td>
                            <td class="py-3">
                                @if($category->image_url)
                                    <img src="{{ $category->image_url }}" alt="{{ $category->name }}" class="rounded-3 border border-light-subtle"
                                         style="width: 44px; height: 44px; object-fit: cover;"
                                         onerror="this.src='https://placehold.co/44x44?text=No+Img'">
                                @else
                                    <div class="rounded-3 bg-light text-secondary d-flex align-items-center justify-content-center border border-light-subtle"
                                         style="width: 44px; height: 44px;">
                                        <i class="bi bi-image opacity-50 fs-5"></i>
                                    </div>
                                @endif
                            </td>
                            <td class="py-3">
                                <span class="fw-semibold text-dark">{{ $category->name }}</span>
                            </td>
                            <td class="py-3">
                                <code class="text-secondary bg-light px-2 py-1 rounded small fw-normal">{{ $category->slug }}</code>
                            </td>
                            <td class="py-3">
                                <span class="badge bg-primary bg-opacity-10 text-primary px-2.5 py-1.5 rounded-pill fw-semibold" style="font-size: 0.75rem;">
                                    {{ number_format($category->products_count) }} products
                                </span>
                            </td>
                            <td class="py-3">
                                @if($category->is_active)
                                    <span class="badge bg-success bg-opacity-10 text-success px-2.5 py-1.5 rounded-pill fw-semibold" style="font-size: 0.75rem;">
                                        <span class="spinner-grow spinner-grow-sm text-success me-1 d-inline-block" role="status" style="width: 6px; height: 6px; vertical-align: middle;"></span>
                                        Active
                                    </span>
                                @else
                                    <span class="badge bg-secondary bg-opacity-10 text-secondary px-2.5 py-1.5 rounded-pill fw-semibold" style="font-size: 0.75rem;">
                                        Disabled
                                    </span>
                                @endif
                            </td>
                            <td class="text-end px-4 py-3">
                                <div class="d-flex gap-1 justify-content-end">
                                    <button type="button"
                                            class="btn btn-sm btn-light border border-light-subtle rounded-3 fw-medium px-2.5 text-dark"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editCategoryModal"
                                            data-id="{{ $category->id }}"
                                            data-name="{{ $category->name }}"
                                            data-description="{{ $category->description }}"
                                            data-active="{{ $category->is_active }}"
                                            data-image="{{ $category->image_url ?? '' }}"
                                            data-url="{{ route('admin.categories.update', $category) }}">
                                        <i class="bi bi-pencil me-1"></i> Edit
                                    </button>
                                    <form method="POST" action="{{ route('admin.categories.destroy', $category) }}"
                                          onsubmit="return confirm('Are you sure you want to delete this category?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-light border border-light-subtle rounded-3 text-danger px-2.5">
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

        {{-- Dynamic Footer Pagination Grid --}}
        @if($categories->hasPages())
            <div class="card-footer bg-white border-top d-flex justify-content-between align-items-center px-4 py-3">
                <span class="text-muted small">
                    Showing <strong>{{ $categories->firstItem() }}</strong> to <strong>{{ $categories->lastItem() }}</strong> of <strong>{{ $categories->total() }}</strong> records
                </span>
                <div class="pagination-clean">
                    {{ $categories->links('pagination::bootstrap-5') }}
                </div>
            </div>
        @endif
    </div>
</div>

{{-- Category Functional Forms --}}
@include('admin.categories.partials.create-modal')
@include('admin.categories.partials.edit-modal')
@endsection

@push('styles')
<style>
    .form-control:focus, .form-check-input:focus {
        border-color: var(--bs-dark);
        box-shadow: 0 0 0 0.25rem rgba(33, 37, 41, 0.1);
    }
    .form-check-input:checked {
        background-color: var(--bs-dark);
        border-color: var(--bs-dark);
    }
    .pagination-clean .pagination {
        margin-bottom: 0;
    }
    .pagination-clean .page-link {
        padding: 0.375rem 0.75rem;
        font-size: 0.85rem;
        border-radius: 0.375rem;
        margin: 0 2px;
        color: var(--bs-dark);
        border-color: var(--bs-border-color-translucent);
    }
    .pagination-clean .page-item.active .page-link {
        background-color: var(--bs-dark);
        border-color: var(--bs-dark);
        color: var(--bs-white);
    }
</style>
@endpush

@push('scripts')
    @include('admin.categories.partials.image-script')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const editModal = document.getElementById('editCategoryModal');
            if (editModal) {
                editModal.addEventListener('show.bs.modal', function (event) {
                    const button = event.relatedTarget;

                    const url = button.getAttribute('data-url');
                    const name = button.getAttribute('data-name');
                    const description = button.getAttribute('data-description');
                    const isActive = button.getAttribute('data-active');

                    const form = editModal.querySelector('#editCategoryForm');
                    form.setAttribute('action', url);

                    editModal.querySelector('#edit_name').value = name;
                    editModal.querySelector('#edit_description').value = description;

                    const activeSwitch = editModal.querySelector('#edit_is_active');
                    activeSwitch.checked = (isActive == "1");
                });
            }
        });
    </script>
@endpush
