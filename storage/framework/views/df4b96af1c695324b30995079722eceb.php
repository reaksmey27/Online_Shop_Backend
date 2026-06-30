<?php $__env->startSection('title', 'Dashboard'); ?>
<?php $__env->startSection('breadcrumb', 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid px-4 py-3">

    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-1" style="color:var(--text);">Dashboard</h4>
            <p class="text-muted small mb-0">Welcome back! Here's what's happening with your store.</p>
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
                        <?php if(($pendingOrders ?? 0) > 0): ?>
                            <small class="text-warning fw-semibold"><?php echo e($pendingOrders); ?> pending</small>
                        <?php endif; ?>
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
                        <small class="text-muted">paid orders only</small>
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
                        <?php if(($outOfStock ?? 0) > 0): ?>
                            <small class="text-danger fw-semibold"><?php echo e($outOfStock); ?> out of stock</small>
                        <?php endif; ?>
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
                        <span class="text-muted text-uppercase fw-semibold d-block mb-1" style="font-size:.7rem; letter-spacing:.05em;">Total Customers</span>
                        <h3 class="fw-bold mb-0" style="color:var(--text);"><?php echo e(number_format($totalUsers ?? 0)); ?></h3>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="row g-4 mb-4">

        
        <div class="col-12 col-xl-8">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100">
                <div class="card-header border-0 pt-4 px-4 pb-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h5 class="fw-bold mb-0" style="color:var(--text);">Recent Orders</h5>
                            <small class="text-muted">Latest 6 customer transactions</small>
                        </div>
                        <a href="<?php echo e(route('admin.orders.index')); ?>" class="btn btn-sm btn-light rounded-3 fw-medium px-3 small">
                            View All
                        </a>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr class="text-uppercase text-muted fw-bold" style="font-size:.7rem; letter-spacing:.05em;">
                                    <th class="border-0 px-4 py-3">Order</th>
                                    <th class="border-0 py-3">Customer</th>
                                    <th class="border-0 py-3">Amount</th>
                                    <th class="border-0 py-3">Status</th>
                                    <th class="border-0 py-3">Date</th>
                                    <th class="border-0 text-end px-4 py-3"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = ($recentOrders ?? collect())->take(6); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td class="px-4 py-3 text-muted fw-medium">#<?php echo e($order->id); ?></td>
                                        <td class="py-3 fw-semibold" style="color:var(--text);"><?php echo e($order->user->name); ?></td>
                                        <td class="py-3 fw-bold" style="color:var(--text);">$<?php echo e(number_format($order->total_amount, 2)); ?></td>
                                        <td class="py-3">
                                            <?php
                                                $badge = match($order->status) {
                                                    'completed','delivered' => ['success', 'check-circle-fill', $order->status],
                                                    'processing','shipped'  => ['primary', 'arrow-repeat',      $order->status],
                                                    'cancelled'             => ['danger',  'x-circle-fill',     'cancelled'],
                                                    default                 => ['warning', 'clock-history',     'pending'],
                                                };
                                            ?>
                                            <span class="badge bg-<?php echo e($badge[0]); ?>-subtle rounded-pill fw-semibold px-3" style="font-size:.72rem;">
                                                <i class="bi bi-<?php echo e($badge[1]); ?> me-1"></i> <?php echo e(ucfirst($badge[2])); ?>

                                            </span>
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
                                                <i class="bi bi-inbox text-muted fs-3 opacity-50 d-block mb-2"></i>
                                                <p class="mb-0 fw-bold text-muted">No orders yet</p>
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

        
        <div class="col-12 col-xl-4">
            <div class="d-flex flex-column gap-4 h-100">

                
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-header border-0 pt-4 px-4 pb-3 d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="fw-bold mb-0 text-danger"><i class="bi bi-exclamation-triangle-fill me-1"></i> Low Stock</h6>
                            <small class="text-muted">Products with ≤ 10 units</small>
                        </div>
                        <?php if(($lowStockProducts ?? collect())->count() > 3): ?>
                            <a href="<?php echo e(route('admin.products.index', ['low_stock' => 1])); ?>" class="small text-primary fw-semibold">View All</a>
                        <?php endif; ?>
                    </div>
                    <div class="card-body p-0">
                        <?php $__empty_1 = true; $__currentLoopData = ($lowStockProducts ?? collect())->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <a href="<?php echo e(route('admin.products.index')); ?>?search=<?php echo e(urlencode($product->name)); ?>"
                               class="d-flex align-items-center gap-3 px-4 py-2 border-bottom border-light text-decoration-none hover-bg-light"
                               style="transition: background .15s;">
                                <div class="flex-1 min-w-0">
                                    <p class="mb-0 fw-semibold small text-truncate" style="color:var(--text); max-width:160px;"><?php echo e($product->name); ?></p>
                                </div>
                                <span class="badge <?php echo e($product->stock <= 3 ? 'bg-danger' : 'bg-warning text-dark'); ?> rounded-pill px-2">
                                    <?php echo e($product->stock); ?> left
                                </span>
                            </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <p class="text-muted small text-center py-3 mb-0">All products well-stocked.</p>
                        <?php endif; ?>
                    </div>
                </div>

                
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-header border-0 pt-4 px-4 pb-3">
                        <h6 class="fw-bold mb-0" style="color:var(--text);"><i class="bi bi-trophy-fill text-warning me-1"></i> Best Sellers</h6>
                        <small class="text-muted">Top 6 by units sold</small>
                    </div>
                    <div class="card-body p-0">
                        <?php $__empty_1 = true; $__currentLoopData = ($bestSellers ?? collect())->take(6); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $idx => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <a href="<?php echo e($item->product ? route('admin.products.index') . '?search=' . urlencode($item->product->name) : '#'); ?>"
                               class="d-flex align-items-center gap-3 px-4 py-2 border-bottom border-light text-decoration-none"
                               style="transition: background .15s;">
                                <span class="fw-black text-muted" style="font-size:.75rem; width:16px;"><?php echo e($idx + 1); ?></span>
                                <div class="flex-1 min-w-0">
                                    <p class="mb-0 fw-semibold small text-truncate" style="color:var(--text); max-width:160px;"><?php echo e($item->product?->name ?? '—'); ?></p>
                                    <small class="text-muted">$<?php echo e(number_format($item->product?->price ?? 0, 2)); ?></small>
                                </div>
                                <span class="badge bg-success-subtle text-success rounded-pill px-2 fw-semibold" style="font-size:.72rem;">
                                    <?php echo e($item->total_sold); ?> sold
                                </span>
                            </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <p class="text-muted small text-center py-3 mb-0">No sales yet.</p>
                        <?php endif; ?>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\REAKSMEY.SAN\Desktop\online-shop\backend\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>