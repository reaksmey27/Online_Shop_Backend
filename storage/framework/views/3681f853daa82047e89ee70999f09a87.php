<div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white mb-4">
    <div class="card-header bg-white border-bottom px-4 py-3">
        <h6 class="mb-0 fw-bold text-dark">Purchased Allocation</h6>
    </div>
    <div class="table-responsive">
        <table class="table align-middle mb-0">
            <thead class="bg-light table-light">
                <tr class="text-uppercase text-muted fw-bold" style="font-size: 0.75rem; letter-spacing: 0.05em;">
                    <th class="border-0 px-4 py-3">Product Name</th>
                    <th class="border-0 py-3">Unit Price</th>
                    <th class="border-0 py-3">Quantity</th>
                    <th class="border-0 text-end px-4 py-3">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="border-bottom border-light-subtle">
                        <td class="px-4 py-3">
                            <div class="d-flex align-items-center gap-3">
                                <?php if($item->product?->image_url): ?>
                                    <img src="<?php echo e($item->product->image_url); ?>" class="rounded-3 border border-light-subtle"
                                         style="width: 42px; height: 42px; object-fit: cover;"
                                         onerror="this.src='https://placehold.co/42x42?text=N/A'">
                                <?php else: ?>
                                    <div class="rounded-3 bg-light d-flex align-items-center justify-content-center border border-light-subtle"
                                         style="width: 42px; height: 42px; flex-shrink: 0;">
                                        <i class="bi bi-image text-secondary opacity-50"></i>
                                    </div>
                                <?php endif; ?>
                                <span class="fw-semibold text-dark small"><?php echo e($item->product->name ?? 'Deleted Product Model'); ?></span>
                            </div>
                        </td>
                        <td class="py-3 text-secondary small">$<?php echo e(number_format($item->price, 2)); ?></td>
                        <td class="py-3 text-secondary small"><?php echo e($item->quantity); ?></td>
                        <td class="fw-bold text-dark text-end px-4 py-3 small">
                            $<?php echo e(number_format($item->price * $item->quantity, 2)); ?>

                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
            <tfoot class="bg-light table-light border-0">
                <tr class="border-0">
                    <td colspan="3" class="text-end fw-bold text-muted text-uppercase small px-4 py-3" style="letter-spacing: 0.05em;">Total Settlement</td>
                    <td class="fw-bold text-success fs-5 text-end px-4 py-3">
                        $<?php echo e(number_format($order->total_amount, 2)); ?>

                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
<?php /**PATH C:\Users\REAKSMEY.SAN\Desktop\online-shop\backend\resources\views/admin/orders/partials/items-table.blade.php ENDPATH**/ ?>