<div class="card border-0 shadow-sm rounded-4 overflow-hidden">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr class="text-uppercase text-muted fw-bold" style="font-size:.75rem; letter-spacing:.05em;">
                    <th class="border-0 px-4 py-3">#</th>
                    <th class="border-0 py-3">Image</th>
                    <th class="border-0 py-3">Name</th>
                    <th class="border-0 py-3">Category</th>
                    <th class="border-0 py-3">Price</th>
                    <th class="border-0 py-3">Stock</th>
                    <th class="border-0 py-3">Status</th>
                    <th class="border-0 text-end px-4 py-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td class="px-4 py-3 text-muted fw-medium"><?php echo e($loop->iteration); ?></td>
                        <td class="py-3">
                            <?php if($product->image_url): ?>
                                <img src="<?php echo e($product->image_url); ?>" alt="<?php echo e($product->name); ?>"
                                     class="rounded-3" style="width:44px; height:44px; object-fit:cover; border:1px solid var(--border);"
                                     onerror="this.src='https://placehold.co/44x44?text=?'">
                            <?php else: ?>
                                <div class="rounded-3 d-flex align-items-center justify-content-center"
                                     style="width:44px; height:44px; background:var(--surface-2); border:1px solid var(--border);">
                                    <i class="bi bi-image text-muted opacity-50 fs-5"></i>
                                </div>
                            <?php endif; ?>
                        </td>
                        <td class="py-3 fw-semibold" style="color:var(--text);"><?php echo e($product->name); ?></td>
                        <td class="py-3">
                            <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill fw-semibold px-3" style="font-size:.75rem;">
                                <?php echo e($product->category->name ?? 'Uncategorised'); ?>

                            </span>
                        </td>
                        <td class="py-3 fw-semibold" style="color:var(--text);">$<?php echo e(number_format($product->price, 2)); ?></td>
                        <td class="py-3">
                            <?php if($product->stock <= 0): ?>
                                <span class="badge bg-danger bg-opacity-10 text-danger rounded-pill fw-semibold px-3" style="font-size:.75rem;">Out of Stock</span>
                            <?php elseif($product->stock <= 10): ?>
                                <span class="badge bg-warning bg-opacity-10 text-warning rounded-pill fw-semibold px-3" style="font-size:.75rem;">Low (<?php echo e($product->stock); ?>)</span>
                            <?php else: ?>
                                <span class="badge bg-success bg-opacity-10 text-success rounded-pill fw-semibold px-3" style="font-size:.75rem;"><?php echo e(number_format($product->stock)); ?></span>
                            <?php endif; ?>
                        </td>
                        <td class="py-3">
                            <?php if($product->is_active): ?>
                                <span class="badge bg-success bg-opacity-10 text-success rounded-pill fw-semibold px-3" style="font-size:.75rem;">
                                    <span class="spinner-grow spinner-grow-sm text-success me-1" style="width:6px; height:6px; vertical-align:middle;"></span>Active
                                </span>
                            <?php else: ?>
                                <span class="badge bg-secondary bg-opacity-10 text-secondary rounded-pill fw-semibold px-3" style="font-size:.75rem;">Inactive</span>
                            <?php endif; ?>
                        </td>
                        <td class="text-end px-4 py-3">
                            <div class="d-flex gap-1 justify-content-end">
                                <button type="button" class="btn btn-sm btn-light rounded-3 px-3"
                                        data-bs-toggle="modal" data-bs-target="#showProductModal"
                                        data-name="<?php echo e($product->name); ?>"
                                        data-image="<?php echo e($product->image_url ?? ''); ?>"
                                        data-price="$<?php echo e(number_format($product->price, 2)); ?>"
                                        data-category="<?php echo e($product->category->name ?? 'Uncategorised'); ?>"
                                        data-slug="<?php echo e($product->slug); ?>"
                                        data-stock="<?php echo e($product->stock); ?>"
                                        data-rating="<?php echo e(number_format($product->average_rating, 1)); ?>"
                                        data-reviews-count="<?php echo e($product->reviews->count()); ?>"
                                        data-created="<?php echo e($product->created_at->format('M d, Y')); ?>"
                                        data-description="<?php echo e($product->description ?? ''); ?>"
                                        data-active="<?php echo e($product->is_active); ?>">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-light rounded-3 fw-medium px-3"
                                        data-bs-toggle="modal" data-bs-target="#editProductModal"
                                        data-id="<?php echo e($product->id); ?>"
                                        data-name="<?php echo e($product->name); ?>"
                                        data-category-id="<?php echo e($product->category_id); ?>"
                                        data-price="<?php echo e($product->price); ?>"
                                        data-stock="<?php echo e($product->stock); ?>"
                                        data-description="<?php echo e($product->description); ?>"
                                        data-active="<?php echo e($product->is_active); ?>"
                                        data-image="<?php echo e($product->image_url ?? ''); ?>"
                                        data-url="<?php echo e(route('admin.products.update', $product)); ?>">
                                    <i class="bi bi-pencil me-1"></i> Edit
                                </button>
                                <form method="POST" action="<?php echo e(route('admin.products.destroy', $product)); ?>"
                                      onsubmit="return confirm('Delete this product?')">
                                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-sm btn-light rounded-3 text-danger px-3">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="8" class="text-center py-5">
                            <div class="py-4">
                                <div class="rounded-circle d-inline-flex align-items-center justify-content-center p-3 mb-3"
                                     style="width:64px; height:64px; background:var(--surface-2);">
                                    <i class="bi bi-box-seam text-muted fs-3 opacity-50"></i>
                                </div>
                                <p class="mb-1 fw-bold" style="color:var(--text);">No products yet</p>
                                <span class="text-muted small d-block mb-3">Add your first product to get started.</span>
                                <button type="button" class="btn btn-sm btn-dark rounded-3 px-3" data-bs-toggle="modal" data-bs-target="#createProductModal">Add Product</button>
                            </div>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <?php if($products->hasPages()): ?>
        <div class="card-footer d-flex justify-content-between align-items-center px-4 py-3">
            <span class="text-muted small">Showing <strong><?php echo e($products->firstItem()); ?></strong>–<strong><?php echo e($products->lastItem()); ?></strong> of <strong><?php echo e($products->total()); ?></strong></span>
            <div class="pagination-clean"><?php echo e($products->links('pagination::bootstrap-5')); ?></div>
        </div>
    <?php endif; ?>
</div>
<?php /**PATH C:\Users\REAKSMEY.SAN\Desktop\online-shop\backend\resources\views/admin/products/partials/table.blade.php ENDPATH**/ ?>