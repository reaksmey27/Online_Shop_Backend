<div class="card border-0 shadow-sm rounded-4 mb-4">
    <div class="card-body p-3">
        <form method="GET" action="<?php echo e(route('admin.users.index')); ?>" class="row g-2 align-items-center">
            <div class="col-md-9">
                <div class="position-relative">
                    <i class="bi bi-search text-muted position-absolute top-50 start-0 translate-middle-y ms-3" style="font-size:.9rem;"></i>
                    <input type="text" name="search" value="<?php echo e(request('search')); ?>"
                           class="form-control rounded-3 py-2 ps-5 small" placeholder="Search by name or email…">
                </div>
            </div>
            <div class="col-md-3 d-flex gap-2">
                <button type="submit" class="btn btn-dark btn-sm rounded-3 w-100 fw-medium py-2">Search</button>
                <a href="<?php echo e(route('admin.users.index')); ?>" class="btn btn-light btn-sm rounded-3 w-100 fw-medium py-2">Reset</a>
            </div>
        </form>
    </div>
</div>
<?php /**PATH C:\Users\REAKSMEY.SAN\Desktop\online-shop\backend\resources\views/admin/users/partials/filters.blade.php ENDPATH**/ ?>