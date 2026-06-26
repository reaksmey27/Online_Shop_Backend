<div class="card border-0 shadow-sm rounded-4">
    <div class="card-header border-bottom px-4 py-3">
        <h6 class="mb-0 fw-bold" style="color:var(--text);">Update Order</h6>
    </div>
    <div class="card-body p-4">
        <form method="POST" action="<?php echo e(route('admin.orders.update', $order)); ?>">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label text-muted small fw-medium">Order Status</label>
                    <select name="status" class="form-select rounded-3 py-2 small">
                        <?php $__currentLoopData = ['pending','processing','shipped','delivered','cancelled']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($s); ?>" <?php echo e($order->status === $s ? 'selected' : ''); ?>><?php echo e(ucfirst($s)); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label text-muted small fw-medium">Payment Status</label>
                    <select name="payment_status" class="form-select rounded-3 py-2 small">
                        <?php $__currentLoopData = ['unpaid','paid','refunded']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($p); ?>" <?php echo e($order->payment_status === $p ? 'selected' : ''); ?>><?php echo e(ucfirst($p)); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="col-12 pt-2">
                    <button type="submit" class="btn btn-dark btn-sm rounded-3 fw-medium px-4 py-2">
                        <i class="bi bi-check-lg me-1"></i> Save Changes
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
<?php /**PATH C:\Users\REAKSMEY.SAN\Desktop\online-shop\backend\resources\views/admin/orders/partials/controls-card.blade.php ENDPATH**/ ?>