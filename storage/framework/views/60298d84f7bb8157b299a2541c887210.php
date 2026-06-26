<div class="card border-0 shadow-sm rounded-4">
    <div class="card-header border-bottom px-4 py-3">
        <h6 class="mb-0 fw-bold" style="color:var(--text);">Shipping Address</h6>
    </div>
    <div class="card-body p-4">
        <p class="mb-0 small text-muted lh-base">
            <i class="bi bi-geo-alt me-1"></i>
            <?php echo e($order->shipping_address ?? 'No shipping address provided.'); ?>

        </p>
    </div>
</div>
<?php /**PATH C:\Users\REAKSMEY.SAN\Desktop\online-shop\backend\resources\views/admin/orders/partials/shipping-card.blade.php ENDPATH**/ ?>