<?php $__env->startSection('title', 'Dashboard Overview'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid px-4 py-3">

    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold text-dark mb-1">Dashboard</h4>
            <p class="text-muted small mb-0">Welcome back! Here's what's happening with your store today.</p>
        </div>
    </div>

    
    <div class="row g-4 mb-4">

        
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm rounded-4 h-100 bg-white">
                <div class="card-body d-flex align-items-center p-4">
                    <div class="rounded-4 bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center me-3"
                         style="width: 48px; height: 48px; min-width: 48px;">
                        <i class="bi bi-receipt-cutoff fs-5"></i>
                    </div>
                    <div>
                        <span class="text-muted text-uppercase fw-semibold ls-wider d-block mb-1" style="font-size: 0.7rem; letter-spacing: 0.05em;">Total Orders</span>
                        <h3 class="fw-bold text-dark mb-0"><?php echo e(number_format($totalOrders ?? 0)); ?></h3>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm rounded-4 h-100 bg-white">
                <div class="card-body d-flex align-items-center p-4">
                    <div class="rounded-4 bg-success bg-opacity-10 text-success d-flex align-items-center justify-content-center me-3"
                         style="width: 48px; height: 48px; min-width: 48px;">
                        <i class="bi bi-currency-dollar fs-5"></i>
                    </div>
                    <div>
                        <span class="text-muted text-uppercase fw-semibold ls-wider d-block mb-1" style="font-size: 0.7rem; letter-spacing: 0.05em;">Total Revenue</span>
                        <h3 class="fw-bold text-dark mb-0">$<?php echo e(number_format($totalRevenue ?? 0, 2)); ?></h3>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm rounded-4 h-100 bg-white">
                <div class="card-body d-flex align-items-center p-4">
                    <div class="rounded-4 bg-warning bg-opacity-10 text-warning d-flex align-items-center justify-content-center me-3"
                         style="width: 48px; height: 48px; min-width: 48px;">
                        <i class="bi bi-box-seam fs-5"></i>
                    </div>
                    <div>
                        <span class="text-muted text-uppercase fw-semibold ls-wider d-block mb-1" style="font-size: 0.7rem; letter-spacing: 0.05em;">Total Products</span>
                        <h3 class="fw-bold text-dark mb-0"><?php echo e(number_format($totalProducts ?? 0)); ?></h3>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm rounded-4 h-100 bg-white">
                <div class="card-body d-flex align-items-center p-4">
                    <div class="rounded-4 bg-info bg-opacity-10 text-info d-flex align-items-center justify-content-center me-3"
                         style="width: 48px; height: 48px; min-width: 48px;">
                        <i class="bi bi-people fs-5"></i>
                    </div>
                    <div>
                        <span class="text-muted text-uppercase fw-semibold ls-wider d-block mb-1" style="font-size: 0.7rem; letter-spacing: 0.05em;">Total Users</span>
                        <h3 class="fw-bold text-dark mb-0"><?php echo e(number_format($totalUsers ?? 0)); ?></h3>
                    </div>
                </div>
            </div>
        </div>

    </div>

    
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white">
        <div class="card-header bg-white border-0 pt-4 px-4 pb-3">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h5 class="fw-bold text-dark mb-0">Recent Orders</h5>
                    <small class="text-muted">Overview of the latest customer transactions.</small>
                </div>
                <span class="badge bg-light text-secondary border border-light-subtle px-3 py-2 rounded-pill fw-medium small">
                    <span class="spinner-grow spinner-grow-sm text-success me-1" role="status" style="width: 6px; height: 6px;"></span>
                    Live updates
                </span>
            </div>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light table-light">
                        <tr class="text-uppercase text-muted fw-bold" style="font-size: 0.75rem; letter-spacing: 0.05em;">
                            <th class="border-0 px-4 py-3">Order ID</th>
                            <th class="border-0 py-3">Customer</th>
                            <th class="border-0 py-3">Total Amount</th>
                            <th class="border-0 py-3">Status</th>
                            <th class="border-0 py-3">Date</th>
                            <th class="border-0 text-end px-4 py-3">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $recentOrders ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr class="border-bottom border-light-subtle">
                                <td class="px-4 py-3 text-secondary fw-medium">#<?php echo e($order->id); ?></td>
                                <td class="py-3">
                                    <span class="fw-semibold text-dark"><?php echo e($order->user->name); ?></span>
                                </td>
                                <td class="py-3 fw-bold text-dark">
                                    $<?php echo e(number_format($order->total_amount, 2)); ?>

                                </td>
                                <td class="py-3">
                                    <?php if($order->status === 'completed'): ?>
                                        <span class="badge bg-success-subtle text-success px-3 py-1.5 rounded-pill fw-semibold" style="font-size: 0.75rem;">
                                            <i class="bi bi-check-circle-fill me-1"></i> Completed
                                        </span>
                                    <?php elseif($order->status === 'processing'): ?>
                                        <span class="badge bg-primary-subtle text-primary px-3 py-1.5 rounded-pill fw-semibold" style="font-size: 0.75rem;">
                                            <i class="bi bi-arrow-repeat me-1"></i> Processing
                                        </span>
                                    <?php else: ?>
                                        <span class="badge bg-warning-subtle text-warning px-3 py-1.5 rounded-pill fw-semibold" style="font-size: 0.75rem;">
                                            <i class="bi bi-clock-history me-1"></i> Pending
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-secondary small py-3">
                                    <?php echo e($order->created_at->format('M d, Y')); ?>

                                </td>
                                <td class="text-end px-4 py-3">
                                    <a href="<?php echo e(route('admin.orders.show', $order)); ?>" class="btn btn-sm btn-light border border-light-subtle rounded-3 fw-medium px-3 text-dark btn-hover-transition">
                                        View Details
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="6" class="text-center text-muted py-5">
                                    <div class="py-5">
                                        <div class="rounded-circle bg-light d-inline-flex align-items-center justify-content-center p-3 mb-3" style="width: 64px; height: 64px;">
                                            <i class="bi bi-inbox text-secondary opacity-50 fs-3"></i>
                                        </div>
                                        <p class="mb-1 fw-bold text-dark">No recent orders found</p>
                                        <span class="text-muted small d-block">When users complete transactions, they will display here.</span>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
    /* Subtle touch enhancements for a premium dashboard look */
    .ls-wider { letter-spacing: 0.05em; }
    .btn-hover-transition {
        transition: all 0.2s ease-in-out;
    }
    .btn-hover-transition:hover {
        background-color: var(--bs-dark) !important;
        color: var(--bs-white) !important;
        border-color: var(--bs-dark) !important;
    }
    .table-hover tbody tr:hover {
        background-color: rgba(0, 0, 0, 0.015);
    }
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\REAKSMEY.SAN\Desktop\online-shop\backend\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>