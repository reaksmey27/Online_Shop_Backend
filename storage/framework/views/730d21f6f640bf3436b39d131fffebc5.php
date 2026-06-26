<?php $__env->startSection('title', 'Order Detail'); ?>
<?php $__env->startSection('breadcrumb', 'Order #' . $order->id); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid px-2">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-1" style="color:var(--text);">Order #<?php echo e($order->id); ?></h4>
            <p class="text-muted small mb-0">Review items, status, and customer details.</p>
        </div>
        <a href="<?php echo e(route('admin.orders.index')); ?>" class="btn btn-light btn-sm rounded-3 px-3 py-2 fw-medium">
            <i class="bi bi-arrow-left me-1"></i> Back to Orders
        </a>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <?php echo $__env->make('admin.orders.partials.items-table', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            <?php echo $__env->make('admin.orders.partials.controls-card', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>
        <div class="col-lg-4">
            <?php echo $__env->make('admin.orders.partials.customer-card', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            <?php echo $__env->make('admin.orders.partials.registry-card', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            <?php echo $__env->make('admin.orders.partials.shipping-card', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\REAKSMEY.SAN\Desktop\online-shop\backend\resources\views/admin/orders/show.blade.php ENDPATH**/ ?>