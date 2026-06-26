<?php $__env->startSection('title', 'Orders'); ?>
<?php $__env->startSection('breadcrumb', 'Orders'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid px-2">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-1" style="color:var(--text);">Orders</h4>
            <p class="text-muted small mb-0">Track and manage customer orders.</p>
        </div>
    </div>

    
    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body p-3">
            <form method="GET" action="<?php echo e(route('admin.orders.index')); ?>" class="row g-2 align-items-center">
                <div class="col-md-5">
                    <div class="position-relative">
                        <i class="bi bi-search text-muted position-absolute top-50 start-0 translate-middle-y ms-3" style="font-size:.9rem;"></i>
                        <input type="text" name="search" value="<?php echo e(request('search')); ?>"
                               class="form-control rounded-3 py-2 ps-5 small" placeholder="Search by order ID or customer name…">
                    </div>
                </div>
                <div class="col-md-4">
                    <select name="status" class="form-select rounded-3 py-2 small">
                        <option value="">All Statuses</option>
                        <?php $__currentLoopData = ['pending','processing','shipped','delivered','cancelled']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($s); ?>" <?php echo e(request('status') === $s ? 'selected' : ''); ?>><?php echo e(ucfirst($s)); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="col-md-3 d-flex gap-2">
                    <button type="submit" class="btn btn-dark btn-sm rounded-3 w-100 fw-medium py-2">Filter</button>
                    <a href="<?php echo e(route('admin.orders.index')); ?>" class="btn btn-light btn-sm rounded-3 w-100 fw-medium py-2">Reset</a>
                </div>
            </form>
        </div>
    </div>

    
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr class="text-uppercase text-muted fw-bold" style="font-size:.75rem; letter-spacing:.05em;">
                        <th class="border-0 px-4 py-3">Order ID</th>
                        <th class="border-0 py-3">Customer</th>
                        <th class="border-0 py-3">Amount</th>
                        <th class="border-0 py-3">Status</th>
                        <th class="border-0 py-3">Payment</th>
                        <th class="border-0 py-3">Date</th>
                        <th class="border-0 text-end px-4 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td class="px-4 py-3 fw-semibold" style="color:var(--text);"><?php echo e($order->id); ?></td>
                            <td class="py-3">
                                <div class="fw-semibold" style="color:var(--text);"><?php echo e($order->user->name); ?></div>
                                <div class="text-muted small"><?php echo e($order->user->email); ?></div>
                            </td>
                            <td class="py-3 fw-bold text-success">$<?php echo e(number_format($order->total_amount, 2)); ?></td>
                            <td class="py-3">
                                <?php
                                    $statusColor = match($order->status) {
                                        'delivered'  => 'success',
                                        'pending'    => 'warning',
                                        'cancelled'  => 'danger',
                                        'processing' => 'info',
                                        'shipped'    => 'primary',
                                        default      => 'secondary',
                                    };
                                ?>
                                <span class="badge bg-<?php echo e($statusColor); ?> bg-opacity-10 text-<?php echo e($statusColor); ?> rounded-pill fw-semibold px-3" style="font-size:.75rem;">
                                    <?php echo e(ucfirst($order->status)); ?>

                                </span>
                            </td>
                            <td class="py-3">
                                <?php
                                    $payColor = match($order->payment_status) {
                                        'paid'     => 'success',
                                        'unpaid'   => 'warning',
                                        'refunded' => 'danger',
                                        default    => 'secondary',
                                    };
                                ?>
                                <span class="badge bg-<?php echo e($payColor); ?> bg-opacity-10 text-<?php echo e($payColor); ?> rounded-pill fw-semibold px-3" style="font-size:.75rem;">
                                    <?php echo e(ucfirst($order->payment_status)); ?>

                                </span>
                            </td>
                            <td class="py-3 text-muted small"><?php echo e($order->created_at->format('M d, Y')); ?></td>
                            <td class="text-end px-4 py-3">
                                <a href="<?php echo e(route('admin.orders.show', $order)); ?>" class="btn btn-sm btn-light rounded-3 fw-medium px-3 d-inline-flex align-items-center gap-1">
                                    <i class="bi bi-eye"></i> View
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <div class="py-4">
                                    <div class="rounded-circle d-inline-flex align-items-center justify-content-center p-3 mb-3"
                                         style="width:64px; height:64px; background:var(--surface-2);">
                                        <i class="bi bi-inbox text-muted fs-3 opacity-50"></i>
                                    </div>
                                    <p class="mb-1 fw-bold" style="color:var(--text);">No orders found</p>
                                    <span class="text-muted small">Try adjusting your filters.</span>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <?php if($orders->hasPages()): ?>
            <div class="card-footer d-flex justify-content-between align-items-center px-4 py-3">
                <span class="text-muted small">Showing <strong><?php echo e($orders->firstItem()); ?></strong>–<strong><?php echo e($orders->lastItem()); ?></strong> of <strong><?php echo e($orders->total()); ?></strong></span>
                <div class="pagination-clean"><?php echo e($orders->links('pagination::bootstrap-5')); ?></div>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\REAKSMEY.SAN\Desktop\online-shop\backend\resources\views/admin/orders/index.blade.php ENDPATH**/ ?>