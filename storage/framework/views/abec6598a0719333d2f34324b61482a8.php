<?php $__env->startSection('title', 'Products'); ?>
<?php $__env->startSection('breadcrumb', 'Products'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid px-2">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-1" style="color:var(--text);">Products</h4>
            <p class="text-muted small mb-0">Manage inventory, pricing, and availability.</p>
        </div>
        <button type="button" class="btn btn-dark btn-sm rounded-3 px-3 py-2 fw-medium d-flex align-items-center gap-1"
                data-bs-toggle="modal" data-bs-target="#createProductModal">
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

<?php $__env->startPush('scripts'); ?>
    <?php echo $__env->make('admin.products.partials.image-script', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\REAKSMEY.SAN\Desktop\online-shop\backend\resources\views/admin/products/index.blade.php ENDPATH**/ ?>