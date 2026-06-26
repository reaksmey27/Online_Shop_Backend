<?php $__env->startSection('title', 'Admin Login'); ?>

<?php $__env->startSection('content'); ?>
<div class="card border-0 shadow-sm rounded-4 overflow-hidden" style="width: 400px;">
    <div class="card-body p-5">

        <?php echo $__env->make('admin.auth.partials.brand-header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <?php echo $__env->make('admin.auth.partials.errors', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <form method="POST" action="<?php echo e(route('admin.login.post')); ?>">
            <?php echo csrf_field(); ?>

            <div class="mb-3">
                <label class="form-label text-muted small fw-medium">Email Address</label>
                <input type="email" name="email" value="<?php echo e(old('email')); ?>"
                       class="form-control rounded-3 py-2 small <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                       placeholder="admin@example.com" required autofocus>
            </div>

            <div class="mb-4">
                <label class="form-label text-muted small fw-medium">Password</label>
                <input type="password" name="password"
                       class="form-control rounded-3 py-2 small <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                       placeholder="••••••••" required>
            </div>

            <button type="submit" class="btn btn-dark btn-sm rounded-3 w-100 fw-medium py-2">
                <i class="bi bi-box-arrow-in-right me-1"></i> Sign In
            </button>
        </form>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.auth', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\REAKSMEY.SAN\Desktop\online-shop\backend\resources\views/admin/auth/login.blade.php ENDPATH**/ ?>