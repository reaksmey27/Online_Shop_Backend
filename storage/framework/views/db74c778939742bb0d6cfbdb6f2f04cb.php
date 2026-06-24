<div class="card border-0 shadow-sm rounded-4 bg-white mb-4">
    <div class="card-header bg-white border-bottom px-4 py-3">
        <h6 class="mb-0 fw-bold text-dark">Purchaser Account</h6>
    </div>
    <div class="card-body p-4">
        <div class="d-flex align-items-center gap-3 mb-4">
            <div class="rounded-circle bg-dark text-white d-flex align-items-center justify-content-center fw-bold text-center border border-light-subtle"
                 style="width: 44px; height: 44px; font-size: 0.95rem; flex-shrink: 0; letter-spacing: -0.02em;">
                <?php echo e(strtoupper(substr($order->user->name, 0, 1))); ?>

            </div>
            <div class="overflow-hidden">
                <div class="fw-bold text-dark text-truncate mb-0.5"><?php echo e($order->user->name); ?></div>
                <div class="text-secondary small text-truncate"><?php echo e($order->user->email); ?></div>
            </div>
        </div>
        <a href="<?php echo e(route('admin.users.index', ['search' => $order->user->email])); ?>" class="btn btn-light border border-light-subtle btn-sm rounded-3 w-100 fw-medium py-2 text-dark">
            <i class="bi bi-person me-1"></i> Audit Identity Profile
        </a>
    </div>
</div>
<?php /**PATH C:\Users\REAKSMEY.SAN\Desktop\online-shop\backend\resources\views/admin/orders/partials/customer-card.blade.php ENDPATH**/ ?>