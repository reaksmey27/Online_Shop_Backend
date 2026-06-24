<div class="modal fade" id="createCategoryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg rounded-4 bg-white mx-auto" style="max-width: 100%; width: 850px;">
            <div class="modal-header border-bottom border-light-subtle px-4 py-3">
                <h5 class="modal-title fw-bold text-dark fs-5">Create Category</h5>
                <button type="button" class="btn-close small shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="<?php echo e(route('admin.categories.store')); ?>" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="modal-body p-4">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-semibold text-dark small mb-1">Category Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" value="<?php echo e(old('name')); ?>" class="form-control rounded-3 py-2.5" placeholder="e.g. Electronics, Apparel..." required>
                            </div>
                            <div class="mb-0">
                                <label class="form-label fw-semibold text-dark small mb-1">Description</label>
                                <textarea name="description" rows="6" class="form-control rounded-3 py-2.5" placeholder="Brief context description..."></textarea>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <?php echo $__env->make('admin.categories.partials.image-input', ['imageCtx' => 'create'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                            </div>
                        </div>
                    </div>

                    <div class="p-3 bg-light rounded-3 border border-light-subtle mt-4 mb-0">
                        <div class="form-check form-switch d-flex align-items-center gap-2 ps-0 mb-0">
                            <div class="position-relative ms-5">
                                <input class="form-check-input ms-0 float-none" type="checkbox" name="is_active" id="isActiveCreate" style="width: 2.2em; height: 1.15em; cursor: pointer;" checked>
                            </div>
                            <label class="form-check-label fw-semibold text-dark small ms-2" for="isActiveCreate" style="cursor: pointer;">Visibility Status (Active)</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top border-light-subtle px-4 py-3">
                    <button type="button" class="btn btn-light border border-light-subtle rounded-3 fw-medium text-dark px-3 py-2 small" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-dark rounded-3 fw-medium px-4 py-2 small d-flex align-items-center gap-1">
                        <i class="bi bi-check-lg fs-6"></i> Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php /**PATH C:\Users\REAKSMEY.SAN\Desktop\online-shop\backend\resources\views/admin/categories/partials/create-modal.blade.php ENDPATH**/ ?>