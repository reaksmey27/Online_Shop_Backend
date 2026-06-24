<?php $__env->startSection('title', 'Products'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid px-2">

    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold text-dark mb-1">Products</h4>
            <p class="text-muted small mb-0">Manage your physical inventory, pricing structures, and stock availability.</p>
        </div>
        <button type="button" class="btn btn-dark btn-sm rounded-3 px-3 py-2 fw-medium d-flex align-items-center gap-1" data-bs-toggle="modal" data-bs-target="#createProductModal">
            <i class="bi bi-plus-lg fs-6"></i> Add Product
        </button>
    </div>

    
    <?php echo $__env->make('admin.products.partials.filters', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    
    <?php echo $__env->make('admin.products.partials.table', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

</div>


<?php echo $__env->make('admin.products.partials.create-modal', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php echo $__env->make('admin.products.partials.edit-modal', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php echo $__env->make('admin.products.partials.show-modal', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<style>
    .form-control:focus, .form-select:focus, .form-check-input:focus {
        border-color: var(--bs-dark);
        box-shadow: 0 0 0 0.25rem rgba(33, 37, 41, 0.1);
    }
    .form-check-input:checked {
        background-color: var(--bs-dark);
        border-color: var(--bs-dark);
    }
    .pagination-clean .pagination { margin-bottom: 0; }
    .pagination-clean .page-link { padding: 0.375rem 0.75rem; font-size: 0.85rem; border-radius: 0.375rem; margin: 0 2px; color: var(--bs-dark); border-color: var(--bs-border-color-translucent); }
    .pagination-clean .page-item.active .page-link { background-color: var(--bs-dark); border-color: var(--bs-dark); color: var(--bs-white); }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
    <?php echo $__env->make('admin.products.partials.image-script', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\REAKSMEY.SAN\Desktop\online-shop\backend\resources\views/admin/products/index.blade.php ENDPATH**/ ?>