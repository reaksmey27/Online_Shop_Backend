<div class="modal fade" id="editCategoryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg rounded-4 mx-auto" style="max-width:100%; width:850px;">
            <div class="modal-header border-bottom px-4 py-3">
                <h5 class="modal-title fw-bold fs-5" style="color:var(--text);">Edit Category</h5>
                <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal"></button>
            </div>
            <form id="editCategoryForm" method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')
                <div class="modal-body p-4">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-semibold small mb-1" style="color:var(--text);">Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" id="edit_name" class="form-control rounded-3 py-2" required>
                            </div>
                            <div class="mb-0">
                                <label class="form-label fw-semibold small mb-1" style="color:var(--text);">Description</label>
                                <textarea name="description" id="edit_description" rows="6" class="form-control rounded-3 py-2"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            @include('admin.categories.partials.image-input', ['imageCtx' => 'edit'])
                        </div>
                    </div>
                    <div class="switch-surface p-3 mt-4 mb-0">
                        <div class="form-check form-switch d-flex align-items-center gap-2 ps-0 mb-0">
                            <input class="form-check-input ms-0 float-none" type="checkbox" name="is_active" id="edit_is_active"
                                   style="width:2.2em; height:1.15em; cursor:pointer;">
                            <label class="form-check-label fw-semibold small ms-2" for="edit_is_active" style="cursor:pointer; color:var(--text);">Active</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top px-4 py-3">
                    <button type="button" class="btn btn-light rounded-3 fw-medium px-3 py-2 small" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-dark rounded-3 fw-medium px-4 py-2 small d-flex align-items-center gap-1">
                        <i class="bi bi-check-lg fs-6"></i> Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
