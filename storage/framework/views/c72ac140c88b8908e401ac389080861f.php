<script>
(function () {
    function byId(id) { return document.getElementById(id); }

    function setupImageToggle(pfx, formSelector) {
        const form = document.querySelector(formSelector);
        if (!form) return;
        form.querySelectorAll('input[name="image_type"]').forEach(function (radio) {
            radio.addEventListener('change', function () {
                const secFile = byId(pfx + '_section_file');
                const secUrl  = byId(pfx + '_section_url');
                const prev    = byId(pfx + '_imagePreview');
                if (secFile) secFile.style.display = this.value === 'file' ? 'block' : 'none';
                if (secUrl)  secUrl.style.display  = this.value === 'url'  ? 'block' : 'none';
                if (prev)    prev.style.display = 'none';
            });
        });
    }

    setupImageToggle('prod_create', '#createProductModal form');
    setupImageToggle('prod_edit',   '#editProductForm');

    window.previewProductFromFile = function (input, pfx) {
        const preview = byId(pfx + '_imagePreview');
        const img     = byId(pfx + '_previewImg');
        if (!input?.files?.[0] || !preview || !img) return;
        const reader = new FileReader();
        reader.onload = function (e) { img.src = e.target.result; preview.style.display = 'block'; };
        reader.readAsDataURL(input.files[0]);
    };

    window.previewProductFromUrl = function (url, pfx) {
        const preview = byId(pfx + '_imagePreview');
        const img     = byId(pfx + '_previewImg');
        if (!preview || !img) return;
        if (String(url || '').trim()) {
            img.src = url;
            img.onerror = function () { preview.style.display = 'none'; };
            img.onload  = function () { preview.style.display = 'block'; };
        } else {
            preview.style.display = 'none';
        }
    };

    document.addEventListener('DOMContentLoaded', function () {

        // Show modal
        const showModal = document.getElementById('showProductModal');
        if (showModal) {
            showModal.addEventListener('show.bs.modal', function (event) {
                const btn = event.relatedTarget;
                const name         = btn.getAttribute('data-name');
                const image        = btn.getAttribute('data-image');
                const price        = btn.getAttribute('data-price');
                const category     = btn.getAttribute('data-category');
                const slug         = btn.getAttribute('data-slug');
                const stock        = parseInt(btn.getAttribute('data-stock'));
                const rating       = btn.getAttribute('data-rating');
                const reviewsCount = btn.getAttribute('data-reviews-count');
                const created      = btn.getAttribute('data-created');
                const description  = btn.getAttribute('data-description');
                const isActive     = btn.getAttribute('data-active');

                showModal.querySelector('#show_modal_title').textContent = name;
                showModal.querySelector('#show_name').textContent        = name;
                showModal.querySelector('#show_price').textContent       = price;
                showModal.querySelector('#show_category').textContent    = category;
                showModal.querySelector('#show_slug').textContent        = slug;
                showModal.querySelector('#show_created').textContent     = created;
                showModal.querySelector('#show_rating').innerHTML =
                    '<span class="text-warning me-1">★</span>' + rating +
                    ' <span class="text-muted small">/ 5.0 (' + reviewsCount + ' reviews)</span>';
                showModal.querySelector('#show_description').textContent = description || 'No description provided.';

                const imgContainer = showModal.querySelector('#show_image_container');
                imgContainer.innerHTML = image
                    ? '<img src="' + image + '" alt="' + name + '" class="rounded-4 img-fluid" style="width:100%;max-height:240px;object-fit:cover;border:1px solid var(--border);">'
                    : '<div class="rounded-4 d-flex align-items-center justify-content-center" style="height:200px;background:var(--surface-2);border:1px solid var(--border);"><i class="bi bi-image text-muted opacity-50 display-6"></i></div>';

                const stockBadge = showModal.querySelector('#show_stock_badge');
                if (stock <= 0) {
                    stockBadge.className   = 'badge bg-danger bg-opacity-10 text-danger rounded-pill fw-semibold px-3';
                    stockBadge.textContent = 'Out of Stock';
                } else if (stock <= 10) {
                    stockBadge.className   = 'badge bg-warning bg-opacity-10 text-warning rounded-pill fw-semibold px-3';
                    stockBadge.textContent = 'Low Stock (' + stock + ' left)';
                } else {
                    stockBadge.className   = 'badge bg-success bg-opacity-10 text-success rounded-pill fw-semibold px-3';
                    stockBadge.textContent = stock + ' in stock';
                }

                const statusBadge = showModal.querySelector('#show_status_badge');
                if (isActive == '1') {
                    statusBadge.className = 'badge bg-success bg-opacity-10 text-success rounded-pill fw-semibold px-3';
                    statusBadge.innerHTML = '<span class="spinner-grow spinner-grow-sm text-success me-1" style="width:6px;height:6px;vertical-align:middle;"></span>Active';
                } else {
                    statusBadge.className  = 'badge bg-secondary bg-opacity-10 text-secondary rounded-pill fw-semibold px-3';
                    statusBadge.textContent = 'Inactive';
                }
            });
        }

        // Edit modal
        const editModal = document.getElementById('editProductModal');
        if (editModal) {
            editModal.addEventListener('show.bs.modal', function (event) {
                const btn = event.relatedTarget;
                const url         = btn.getAttribute('data-url');
                const name        = btn.getAttribute('data-name');
                const categoryId  = btn.getAttribute('data-category-id');
                const price       = btn.getAttribute('data-price');
                const stock       = btn.getAttribute('data-stock');
                const description = btn.getAttribute('data-description');
                const isActive    = btn.getAttribute('data-active');
                const image       = btn.getAttribute('data-image') || '';

                editModal.querySelector('#editProductForm').setAttribute('action', url);
                editModal.querySelector('#edit_name').value        = name;
                editModal.querySelector('#edit_category_id').value = categoryId || '';
                editModal.querySelector('#edit_price').value       = price;
                editModal.querySelector('#edit_stock').value       = stock;
                editModal.querySelector('#edit_description').value = description || '';

                const activeSwitch = editModal.querySelector('#edit_is_active');
                if (activeSwitch) activeSwitch.checked = (isActive == '1');

                const fileRadio = byId('prod_edit_type_file');
                const urlRadio  = byId('prod_edit_type_url');
                const secFile   = byId('prod_edit_section_file');
                const secUrl    = byId('prod_edit_section_url');
                const prevWrap  = byId('prod_edit_imagePreview');
                const urlInput  = byId('prod_edit_imageUrl');
                const curWrap   = byId('prod_edit_currentImageWrap');
                const curImg    = byId('prod_edit_currentImg');

                if (fileRadio) fileRadio.checked = true;
                if (urlRadio)  urlRadio.checked  = false;
                if (secFile)   secFile.style.display = 'block';
                if (secUrl)    secUrl.style.display  = 'none';
                if (prevWrap)  prevWrap.style.display = 'none';
                if (urlInput)  urlInput.value = '';
                if (curWrap && curImg) {
                    curImg.src = image;
                    curWrap.style.display = image ? 'block' : 'none';
                }
            });
        }
    });
})();
</script>
<?php /**PATH C:\Users\REAKSMEY.SAN\Desktop\online-shop\backend\resources\views/admin/products/partials/image-script.blade.php ENDPATH**/ ?>