<?php $__env->startSection('title', 'Categories'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid px-2">

    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold text-dark mb-1">Categories</h4>
            <p class="text-muted small mb-0">Manage your store product classifications and structures.</p>
        </div>
        <button type="button" class="btn btn-dark btn-sm rounded-3 px-3 py-2 fw-medium d-flex align-items-center gap-1" data-bs-toggle="modal" data-bs-target="#createCategoryModal">
            <i class="bi bi-plus-lg fs-6"></i> Add Category
        </button>
    </div>

    
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
                    <?php $__empty_1 = true; $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="border-bottom border-light-subtle">
                            <td class="px-4 py-3 text-secondary fw-medium"><?php echo e($loop->iteration); ?></td>
                            <td class="py-3">
                                <?php if($category->image_url): ?>
                                    <img src="<?php echo e($category->image_url); ?>" alt="<?php echo e($category->name); ?>" class="rounded-3 border border-light-subtle"
                                         style="width: 44px; height: 44px; object-fit: cover;"
                                         onerror="this.src='https://placehold.co/44x44?text=No+Img'">
                                <?php else: ?>
                                    <div class="rounded-3 bg-light text-secondary d-flex align-items-center justify-content-center border border-light-subtle"
                                         style="width: 44px; height: 44px;">
                                        <i class="bi bi-image opacity-50 fs-5"></i>
                                    </div>
                                <?php endif; ?>
                            </td>
                            <td class="py-3">
                                <span class="fw-semibold text-dark"><?php echo e($category->name); ?></span>
                            </td>
                            <td class="py-3">
                                <code class="text-secondary bg-light px-2 py-1 rounded small fw-normal"><?php echo e($category->slug); ?></code>
                            </td>
                            <td class="py-3">
                                <span class="badge bg-primary bg-opacity-10 text-primary px-2.5 py-1.5 rounded-pill fw-semibold" style="font-size: 0.75rem;">
                                    <?php echo e(number_format($category->products_count)); ?> products
                                </span>
                            </td>
                            <td class="py-3">
                                <?php if($category->is_active): ?>
                                    <span class="badge bg-success bg-opacity-10 text-success px-2.5 py-1.5 rounded-pill fw-semibold" style="font-size: 0.75rem;">
                                        <span class="spinner-grow spinner-grow-sm text-success me-1 d-inline-block" role="status" style="width: 6px; height: 6px; vertical-align: middle;"></span>
                                        Active
                                    </span>
                                <?php else: ?>
                                    <span class="badge bg-secondary bg-opacity-10 text-secondary px-2.5 py-1.5 rounded-pill fw-semibold" style="font-size: 0.75rem;">
                                        Disabled
                                    </span>
                                <?php endif; ?>
                            </td>
                            <td class="text-end px-4 py-3">
                                <div class="d-flex gap-1 justify-content-end">
                                    <button type="button"
                                            class="btn btn-sm btn-light border border-light-subtle rounded-3 fw-medium px-2.5 text-dark"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editCategoryModal"
                                            data-id="<?php echo e($category->id); ?>"
                                            data-name="<?php echo e($category->name); ?>"
                                            data-description="<?php echo e($category->description); ?>"
                                            data-active="<?php echo e($category->is_active); ?>"
                                            data-image="<?php echo e($category->image_url ?? ''); ?>"
                                            data-url="<?php echo e(route('admin.categories.update', $category)); ?>">
                                        <i class="bi bi-pencil me-1"></i> Edit
                                    </button>
                                    <form method="POST" action="<?php echo e(route('admin.categories.destroy', $category)); ?>"
                                          onsubmit="return confirm('Are you sure you want to delete this category?')">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="btn btn-sm btn-light border border-light-subtle rounded-3 text-danger px-2.5">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <?php echo $__env->make('admin.categories.partials.empty-state', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        
        <?php if($categories->hasPages()): ?>
            <div class="card-footer bg-white border-top d-flex justify-content-between align-items-center px-4 py-3">
                <span class="text-muted small">
                    Showing <strong><?php echo e($categories->firstItem()); ?></strong> to <strong><?php echo e($categories->lastItem()); ?></strong> of <strong><?php echo e($categories->total()); ?></strong> records
                </span>
                <div class="pagination-clean">
                    <?php echo e($categories->links('pagination::bootstrap-5')); ?>

                </div>
            </div>
        <?php endif; ?>
    </div>
</div>


<?php echo $__env->make('admin.categories.partials.create-modal', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php echo $__env->make('admin.categories.partials.edit-modal', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
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
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
    <?php echo $__env->make('admin.categories.partials.image-script', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
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
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\REAKSMEY.SAN\Desktop\online-shop\backend\resources\views/admin/categories/index.blade.php ENDPATH**/ ?>