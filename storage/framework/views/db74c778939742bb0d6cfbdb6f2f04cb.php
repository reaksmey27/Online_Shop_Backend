<div class="card border-0 shadow-sm rounded-4 mb-4">
    <div class="card-header border-bottom px-4 py-3">
        <h6 class="mb-0 fw-bold" style="color:var(--text);">Customer</h6>
    </div>
    <div class="card-body p-4">
        <div class="d-flex align-items-center gap-3 mb-4">
            <div class="user-avatar rounded-circle d-flex align-items-center justify-content-center fw-bold"
                 style="width:44px; height:44px; font-size:.95rem; flex-shrink:0;">
                <?php echo e(strtoupper(substr($order->user->name, 0, 1))); ?>

            </div>
            <div class="overflow-hidden">
                <div class="fw-bold text-truncate" style="color:var(--text);"><?php echo e($order->user->name); ?></div>
                <div class="text-muted small text-truncate"><?php echo e($order->user->email); ?></div>
            </div>
        </div>
        <a href="<?php echo e(route('admin.users.index', ['search' => $order->user->email])); ?>"
           class="btn btn-light btn-sm rounded-3 w-100 fw-medium py-2">
            <i class="bi bi-person me-1"></i> View Profile
        </a>
    </div>
</div>
<?php /**PATH C:\Users\REAKSMEY.SAN\Desktop\online-shop\backend\resources\views/admin/orders/partials/customer-card.blade.php ENDPATH**/ ?>