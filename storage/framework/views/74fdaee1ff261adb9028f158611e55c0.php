<?php if($errors->any()): ?>
    <div class="alert border-0 rounded-3 small px-3 py-2 mb-4 d-flex align-items-center" role="alert">
        <i class="bi bi-exclamation-circle-fill me-2 fs-6 text-danger"></i>
        <div class="text-danger"><?php echo e($errors->first()); ?></div>
    </div>
<?php endif; ?>
<?php /**PATH C:\Users\REAKSMEY.SAN\Desktop\online-shop\backend\resources\views/admin/auth/partials/errors.blade.php ENDPATH**/ ?>