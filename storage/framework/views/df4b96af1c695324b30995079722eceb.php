<?php $__env->startSection('title', 'Dashboard'); ?>
<?php $__env->startSection('breadcrumb', 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid px-4 py-3">

    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-1" style="color:var(--text);">Dashboard</h4>
            <p class="text-muted small mb-0">Welcome back! Here's what's happening with your store today.</p>
        </div>
    </div>

    
    <div class="row g-4 mb-4">

        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body d-flex align-items-center p-4">
                    <div class="rounded-4 bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center me-3"
                         style="width:48px; height:48px; min-width:48px;">
                        <i class="bi bi-receipt-cutoff fs-5"></i>
                    </div>
                    <div>
                        <span class="text-muted text-uppercase fw-semibold d-block mb-1" style="font-size:.7rem; letter-spacing:.05em;">Total Orders</span>
                        <h3 class="fw-bold mb-0" style="color:var(--text);"><?php echo e(number_format($totalOrders ?? 0)); ?></h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body d-flex align-items-center p-4">
                    <div class="rounded-4 bg-success bg-opacity-10 text-success d-flex align-items-center justify-content-center me-3"
                         style="width:48px; height:48px; min-width:48px;">
                        <i class="bi bi-currency-dollar fs-5"></i>
                    </div>
                    <div>
                        <span class="text-muted text-uppercase fw-semibold d-block mb-1" style="font-size:.7rem; letter-spacing:.05em;">Total Revenue</span>
                        <h3 class="fw-bold mb-0" style="color:var(--text);">$<?php echo e(number_format($totalRevenue ?? 0, 2)); ?></h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body d-flex align-items-center p-4">
                    <div class="rounded-4 bg-warning bg-opacity-10 text-warning d-flex align-items-center justify-content-center me-3"
                         style="width:48px; height:48px; min-width:48px;">
                        <i class="bi bi-box-seam fs-5"></i>
                    </div>
                    <div>
                        <span class="text-muted text-uppercase fw-semibold d-block mb-1" style="font-size:.7rem; letter-spacing:.05em;">Total Products</span>
                        <h3 class="fw-bold mb-0" style="color:var(--text);"><?php echo e(number_format($totalProducts ?? 0)); ?></h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body d-flex align-items-center p-4">
                    <div class="rounded-4 bg-info bg-opacity-10 text-info d-flex align-items-center justify-content-center me-3"
                         style="width:48px; height:48px; min-width:48px;">
                        <i class="bi bi-people fs-5"></i>
                    </div>
                    <div>
                        <span class="text-muted text-uppercase fw-semibold d-block mb-1" style="font-size:.7rem; letter-spacing:.05em;">Total Users</span>
                        <h3 class="fw-bold mb-0" style="color:var(--text);"><?php echo e(number_format($totalUsers ?? 0)); ?></h3>
                    </div>
                </div>
            </div>
        </div>

    </div>

    
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="card-header border-0 pt-4 px-4 pb-3">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h5 class="fw-bold mb-0" style="color:var(--text);">Recent Orders</h5>
                    <small class="text-muted">Latest customer transactions.</small>
                </div>
                <span class="badge px-3 py-2 rounded-pill fw-medium small" style="background:var(--surface-3); color:var(--text); border:1px solid var(--border);">
                    <span class="spinner-grow spinner-grow-sm text-success me-1" role="status" style="width:6px; height:6px;"></span>
                    Live
                </span>
            </div>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr class="text-uppercase text-muted fw-bold" style="font-size:.75rem; letter-spacing:.05em;">
                            <th class="border-0 px-4 py-3">Order ID</th>
                            <th class="border-0 py-3">Customer</th>
                            <th class="border-0 py-3">Amount</th>
                            <th class="border-0 py-3">Status</th>
                            <th class="border-0 py-3">Date</th>
                            <th class="border-0 text-end px-4 py-3">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $recentOrders ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td class="px-4 py-3 text-muted fw-medium">#<?php echo e($order->id); ?></td>
                                <td class="py-3 fw-semibold" style="color:var(--text);"><?php echo e($order->user->name); ?></td>
                                <td class="py-3 fw-bold" style="color:var(--text);">$<?php echo e(number_format($order->total_amount, 2)); ?></td>
                                <td class="py-3">
                                    <?php if($order->status === 'completed'): ?>
                                        <span class="badge bg-success-subtle rounded-pill fw-semibold px-3" style="font-size:.75rem;">
                                            <i class="bi bi-check-circle-fill me-1"></i> Completed
                                        </span>
                                    <?php elseif($order->status === 'processing'): ?>
                                        <span class="badge bg-primary-subtle rounded-pill fw-semibold px-3" style="font-size:.75rem;">
                                            <i class="bi bi-arrow-repeat me-1"></i> Processing
                                        </span>
                                    <?php else: ?>
                                        <span class="badge bg-warning-subtle rounded-pill fw-semibold px-3" style="font-size:.75rem;">
                                            <i class="bi bi-clock-history me-1"></i> Pending
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td class="py-3 text-muted small"><?php echo e($order->created_at->format('M d, Y')); ?></td>
                                <td class="text-end px-4 py-3">
                                    <a href="<?php echo e(route('admin.orders.show', $order)); ?>" class="btn btn-sm btn-light rounded-3 fw-medium px-3">
                                        View
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <div class="py-4">
                                        <div class="rounded-circle d-inline-flex align-items-center justify-content-center p-3 mb-3"
                                             style="width:64px; height:64px; background:var(--surface-2);">
                                            <i class="bi bi-inbox text-muted fs-3 opacity-50"></i>
                                        </div>
                                        <p class="mb-1 fw-bold" style="color:var(--text);">No recent orders</p>
                                        <span class="text-muted small">Completed transactions will appear here.</span>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\REAKSMEY.SAN\Desktop\online-shop\backend\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>