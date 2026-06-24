<div class="card border-0 shadow-sm rounded-4 bg-white mb-4">
    <div class="card-header bg-white border-bottom px-4 py-3">
        <h6 class="mb-0 fw-bold text-dark">Metadata Registry</h6>
    </div>
    <div class="card-body p-4 text-dark small">
        <div class="d-flex justify-content-between align-items-center border-bottom border-light-subtle py-2.5">
            <span class="text-muted">Checkout Timestamp</span>
            <span class="fw-semibold text-dark"><?php echo e($order->created_at->format('M d, Y \a\t g:i A')); ?></span>
        </div>
        <div class="d-flex justify-content-between align-items-center border-bottom border-light-subtle py-2.5">
            <span class="text-muted">Transaction Engine</span>
            <span class="fw-semibold text-dark"><?php echo e(ucfirst($order->payment_method ?? 'System Credit / Cash')); ?></span>
        </div>
        <div class="d-flex justify-content-between align-items-center border-bottom border-light-subtle py-2.5">
            <span class="text-muted">Logistics Vector</span>
            <?php
                $statusContext = match($order->status) {
                    'delivered'  => 'success',
                    'pending'    => 'warning',
                    'cancelled'  => 'danger',
                    'processing' => 'info',
                    'shipped'    => 'primary',
                    default      => 'secondary',
                };
            ?>
            <span class="badge bg-<?php echo e($statusContext); ?> bg-opacity-10 text-<?php echo e($statusContext); ?> px-2.5 py-1 rounded-pill fw-bold" style="font-size: 0.7rem;">
                <?php echo e(ucfirst($order->status)); ?>

            </span>
        </div>
        <div class="d-flex justify-content-between align-items-center pt-2.5">
            <span class="text-muted">Settlement Status</span>
            <?php
                $payContext = match($order->payment_status) {
                    'paid'      => 'success',
                    'unpaid'    => 'warning',
                    'refunded'  => 'danger',
                    default     => 'secondary',
                };
            ?>
            <span class="badge bg-<?php echo e($payContext); ?> bg-opacity-10 text-<?php echo e($payContext); ?> px-2.5 py-1 rounded-pill fw-bold" style="font-size: 0.7rem;">
                <?php echo e(ucfirst($order->payment_status)); ?>

            </span>
        </div>
    </div>
</div>
<?php /**PATH C:\Users\REAKSMEY.SAN\Desktop\online-shop\backend\resources\views/admin/orders/partials/registry-card.blade.php ENDPATH**/ ?>