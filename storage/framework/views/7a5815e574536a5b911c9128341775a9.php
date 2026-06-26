<script>
document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('showUserModal');
    if (!modal) return;

    modal.addEventListener('show.bs.modal', function (event) {
        const btn = event.relatedTarget;

        modal.querySelector('#modal_user_name').textContent         = btn.getAttribute('data-name');
        modal.querySelector('#modal_user_email').textContent        = btn.getAttribute('data-email');
        modal.querySelector('#modal_user_joined').textContent       = btn.getAttribute('data-joined');
        modal.querySelector('#modal_user_orders_count').textContent = btn.getAttribute('data-orders-count');
        modal.querySelector('#modal_user_total_spent').textContent  = btn.getAttribute('data-total-spent');

        const avatar = modal.querySelector('#modal_user_avatar');
        const name   = btn.getAttribute('data-name');
        avatar.textContent = name ? name.charAt(0).toUpperCase() : '?';

        const orders    = JSON.parse(btn.getAttribute('data-orders-json') || '[]');
        const tableBody = modal.querySelector('#modal_orders_table_body');
        tableBody.innerHTML = '';

        if (orders.length === 0) {
            tableBody.innerHTML =
                '<tr><td colspan="6" class="text-center text-muted py-5">' +
                '<i class="bi bi-bag opacity-50 fs-4 d-block mb-2"></i>' +
                '<span class="small">No orders yet.</span></td></tr>';
            return;
        }

        const colorMap = {
            delivered:  'success',
            pending:    'warning',
            cancelled:  'danger',
            processing: 'info',
            shipped:    'primary',
        };

        orders.forEach(function (order) {
            const color = colorMap[order.status_raw] || 'secondary';
            const row   = document.createElement('tr');
            row.innerHTML =
                '<td class="px-4 py-2 fw-semibold" style="color:var(--text);">#' + order.id + '</td>' +
                '<td class="py-2 text-muted small">' + order.items_count + '</td>' +
                '<td class="py-2 fw-semibold" style="color:var(--text);">$' + order.total_amount + '</td>' +
                '<td class="py-2"><span class="badge bg-' + color + ' bg-opacity-10 text-' + color + ' rounded fw-medium px-2" style="font-size:.7rem;">' + order.status + '</span></td>' +
                '<td class="py-2 text-muted small">' + order.date + '</td>' +
                '<td class="px-4 py-2 text-end"><a href="' + order.url + '" class="btn btn-sm btn-light rounded-3 px-2 py-1" style="font-size:.75rem;"><i class="bi bi-arrow-up-right-square"></i></a></td>';
            tableBody.appendChild(row);
        });
    });
});
</script>
<?php /**PATH C:\Users\REAKSMEY.SAN\Desktop\online-shop\backend\resources\views/admin/users/partials/scripts.blade.php ENDPATH**/ ?>