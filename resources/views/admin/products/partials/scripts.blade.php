<script>
    document.addEventListener('DOMContentLoaded', function () {

        // 1. Telemetry binding configuration logic for the SHOW modal
        const showProductModal = document.getElementById('showProductModal');
        if (showProductModal) {
            showProductModal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget;

                const name = button.getAttribute('data-name');
                const image = button.getAttribute('data-image');
                const price = button.getAttribute('data-price');
                const category = button.getAttribute('data-category');
                const slug = button.getAttribute('data-slug');
                const stock = parseInt(button.getAttribute('data-stock'));
                const rating = button.getAttribute('data-rating');
                const reviewsCount = button.getAttribute('data-reviews-count');
                const created = button.getAttribute('data-created');
                const description = button.getAttribute('data-description');
                const isActive = button.getAttribute('data-active');

                showProductModal.querySelector('#show_modal_title').textContent = name;
                showProductModal.querySelector('#show_name').textContent = name;
                showProductModal.querySelector('#show_price').textContent = price;
                showProductModal.querySelector('#show_category').textContent = category;
                showProductModal.querySelector('#show_slug').textContent = slug;
                showProductModal.querySelector('#show_created').textContent = created;
                showProductModal.querySelector('#show_rating').innerHTML = `<span class="text-warning me-1">★</span>${rating} <span class="text-muted small">/ 5.0 (${reviewsCount} reviews)</span>`;
                showProductModal.querySelector('#show_description').textContent = description || 'No written description details compiled.';

                const imgContainer = showProductModal.querySelector('#show_image_container');
                if (image) {
                    imgContainer.innerHTML = `<img src="${image}" alt="${name}" class="rounded-4 img-fluid border border-light-subtle" style="width: 100%; max-height: 240px; object-fit: cover;">`;
                } else {
                    imgContainer.innerHTML = `<div class="rounded-4 bg-light text-secondary d-flex align-items-center justify-content-center border border-light-subtle" style="height: 200px;"><i class="bi bi-image opacity-50 display-6"></i></div>`;
                }

                const stockBadge = showProductModal.querySelector('#show_stock_badge');
                if (stock <= 0) {
                    stockBadge.className = "badge bg-danger bg-opacity-10 text-danger px-2.5 py-1.5 rounded-pill fw-semibold";
                    stockBadge.textContent = "Out of Stock";
                } else if (stock <= 10) {
                    stockBadge.className = "badge bg-warning bg-opacity-10 text-warning px-2.5 py-1.5 rounded-pill fw-semibold";
                    stockBadge.textContent = `Low Stock (${stock} left)`;
                } else {
                    stockBadge.className = "badge bg-success bg-opacity-10 text-success px-2.5 py-1.5 rounded-pill fw-semibold";
                    stockBadge.textContent = `${stock} units available`;
                }

                const statusBadge = showProductModal.querySelector('#show_status_badge');
                if (isActive == "1") {
                    statusBadge.className = "badge bg-success bg-opacity-10 text-success px-2.5 py-1.5 rounded-pill fw-semibold";
                    statusBadge.innerHTML = `<span class="spinner-grow spinner-grow-sm text-success me-1 d-inline-block" style="width: 6px; height: 6px; vertical-align: middle;"></span>Active`;
                } else {
                    statusBadge.className = "badge bg-secondary bg-opacity-10 text-secondary px-2.5 py-1.5 rounded-pill fw-semibold";
                    statusBadge.textContent = "Disabled";
                }
            });
        }

        // 2. Form variable tracking logic for the EDIT modal
        const editProductModal = document.getElementById('editProductModal');
        if (editProductModal) {
            editProductModal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget;

                const url = button.getAttribute('data-url');
                const name = button.getAttribute('data-name');
                const categoryId = button.getAttribute('data-category-id');
                const price = button.getAttribute('data-price');
                const stock = button.getAttribute('data-stock');
                const description = button.getAttribute('data-description');
                const isActive = button.getAttribute('data-active');

                const form = editProductModal.querySelector('#editProductForm');
                form.setAttribute('action', url);

                editProductModal.querySelector('#edit_name').value = name;
                editProductModal.querySelector('#edit_category_id').value = categoryId || '';
                editProductModal.querySelector('#edit_price').value = price;
                editProductModal.querySelector('#edit_stock').value = stock;
                editProductModal.querySelector('#edit_description').value = description;

                const activeSwitch = editProductModal.querySelector('#edit_is_active');
                activeSwitch.checked = (isActive == "1");
            });
        }
    });
</script>
