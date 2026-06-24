<script>
    document.addEventListener('DOMContentLoaded', function () {
        const showUserModal = document.getElementById('showUserModal');
        if (showUserModal) {
            showUserModal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget;

                // Unpack Data Attributes Payload
                const name = button.getAttribute('data-name');
                const email = button.getAttribute('data-email');
                const joined = button.getAttribute('data-joined');
                const ordersCount = button.getAttribute('data-orders-count');
                const totalSpent = button.getAttribute('data-total-spent');

                // Bind elements inside profile UI template view matrix
                showUserModal.querySelector('#modal_user_name').textContent = name;
                showUserModal.querySelector('#modal_user_email').textContent = email;
                showUserModal.querySelector('#modal_user_joined').textContent = joined;
                showUserModal.querySelector('#modal_user_orders_count').textContent = ordersCount;
                showUserModal.querySelector('#modal_user_total_spent').textContent = totalSpent;

                // Render dynamic customer text avatar
                const avatarContainer = showUserModal.querySelector('#modal_user_avatar');
                if (name) {
                    avatarContainer.textContent = name.charAt(0).toUpperCase();
                }

                // Parse and append contextual rows to active table viewport
                const ordersData = JSON.parse(button.getAttribute('data-orders-json') || '[]');
                const tableBody = showUserModal.querySelector('#modal_orders_table_body');
                tableBody.innerHTML = '';

                if (ordersData.length === 0) {
                    tableBody.innerHTML = `
                        <tr>
                            <td colspan="6" class="text-center text-muted py-5">
                                <i class="bi bi-bag text-secondary opacity-50 fs-4 d-block mb-2"></i>
                                <span class="small">No active transaction items recorded for this profile.</span>
                            </td>
                        </tr>`;
                } else {
                    ordersData.forEach(order => {
                        let contextClass = 'secondary';
                        switch(order.status_raw) {
                            case 'delivered':  contextClass = 'success'; break;
                            case 'pending':    contextClass = 'warning'; break;
                            case 'cancelled':  contextClass = 'danger';  break;
                            case 'processing': contextClass = 'info';    break;
                            case 'shipped':    contextClass = 'primary'; break;
                        }

                        const row = document.createElement('tr');
                        row.className = 'border-bottom border-light-subtle-subtle';
                        row.innerHTML = `
                            <td class="px-4 py-2.5 fw-semibold text-dark">#${order.id}</td>
                            <td class="py-2.5 text-secondary small">${order.items_count} item(s)</td>
                            <td class="py-2.5 fw-semibold text-dark">$${order.total_amount}</td>
                            <td class="py-2.5">
                                <span class="badge bg-${contextClass} bg-opacity-10 text-${contextClass} px-2 py-1 rounded fw-medium" style="font-size: 0.7rem;">
                                    ${order.status}
                                </span>
                            </td>
                            <td class="py-2.5 text-muted small">${order.date}</td>
                            <td class="px-4 py-2.5 text-end">
                                <a href="${order.url}" class="btn btn-sm btn-outline-dark rounded-3 px-2 py-1" style="font-size: 0.75rem;">
                                    <i class="bi bi-arrow-up-right-square"></i> Open
                                </a>
                            </td>
                        `;
                        tableBody.appendChild(row);
                    });
                }
            });
        }
    });
</script>
<?php /**PATH C:\Users\REAKSMEY.SAN\Desktop\online-shop\backend\resources\views/admin/users/partials/scripts.blade.php ENDPATH**/ ?>