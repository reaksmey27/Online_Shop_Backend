<script>
(function () {
    function byId(id) { return document.getElementById(id); }

    // Generic toggle handler for a given prefix within a form
    function setupProductImageToggle(pfx, formSelector) {
        const form = document.querySelector(formSelector);
        if (!form) return;
        form.querySelectorAll('input[name="image_type"]').forEach(function (radio) {
            radio.addEventListener('change', function () {
                const sectionFile = byId(pfx + '_section_file');
                const sectionUrl  = byId(pfx + '_section_url');
                const previewWrap = byId(pfx + '_imagePreview');
                if (sectionFile) sectionFile.style.display = this.value === 'file' ? 'block' : 'none';
                if (sectionUrl)  sectionUrl.style.display  = this.value === 'url'  ? 'block' : 'none';
                if (previewWrap) previewWrap.style.display = 'none';
            });
        });
    }

    setupProductImageToggle('prod_create', '#createProductModal form');
    setupProductImageToggle('prod_edit',   '#editProductForm');

    // Preview helpers (called inline via onchange/oninput)
    window.previewProductFromFile = function (input, pfx) {
        const preview = byId(pfx + '_imagePreview');
        const img     = byId(pfx + '_previewImg');
        if (!input || !input.files || !input.files[0] || !preview || !img) return;
        const reader = new FileReader();
        reader.onload = function (e) {
            img.src = e.target.result;
            preview.style.display = 'block';
        };
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

    // Edit modal: populate all fields + show current image
    document.addEventListener('DOMContentLoaded', function () {

        // SHOW modal binding
        const showProductModal = document.getElementById('showProductModal');
        if (showProductModal) {
            showProductModal.addEventListener('show.bs.modal', function (event) {
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

                showProductModal.querySelector('#show_modal_title').textContent = name;
                showProductModal.querySelector('#show_name').textContent        = name;
                showProductModal.querySelector('#show_price').textContent       = price;
                showProductModal.querySelector('#show_category').textContent    = category;
                showProductModal.querySelector('#show_slug').textContent        = slug;
                showProductModal.querySelector('#show_created').textContent     = created;
                showProductModal.querySelector('#show_rating').innerHTML        =
                    '<span class="text-warning me-1">★</span>' + rating +
                    ' <span class="text-muted small">/ 5.0 (' + reviewsCount + ' reviews)</span>';
                showProductModal.querySelector('#show_description').textContent =
                    description || 'No written description details compiled.';

                const imgContainer = showProductModal.querySelector('#show_image_container');
                if (image) {
                    imgContainer.innerHTML = '<img src="' + image + '" alt="' + name +
                        '" class="rounded-4 img-fluid border border-light-subtle" style="width:100%;max-height:240px;object-fit:cover;">';
                } else {
                    imgContainer.innerHTML =
                        '<div class="rounded-4 bg-light text-secondary d-flex align-items-center justify-content-center border border-light-subtle" style="height:200px;">' +
                        '<i class="bi bi-image opacity-50 display-6"></i></div>';
                }

                const stockBadge = showProductModal.querySelector('#show_stock_badge');
                if (stock <= 0) {
                    stockBadge.className   = 'badge bg-danger bg-opacity-10 text-danger px-2.5 py-1.5 rounded-pill fw-semibold';
                    stockBadge.textContent = 'Out of Stock';
                } else if (stock <= 10) {
                    stockBadge.className   = 'badge bg-warning bg-opacity-10 text-warning px-2.5 py-1.5 rounded-pill fw-semibold';
                    stockBadge.textContent = 'Low Stock (' + stock + ' left)';
                } else {
                    stockBadge.className   = 'badge bg-success bg-opacity-10 text-success px-2.5 py-1.5 rounded-pill fw-semibold';
                    stockBadge.textContent = stock + ' units available';
                }

                const statusBadge = showProductModal.querySelector('#show_status_badge');
                if (isActive == '1') {
                    statusBadge.className = 'badge bg-success bg-opacity-10 text-success px-2.5 py-1.5 rounded-pill fw-semibold';
                    statusBadge.innerHTML =
                        '<span class="spinner-grow spinner-grow-sm text-success me-1 d-inline-block" style="width:6px;height:6px;vertical-align:middle;"></span>Active';
                } else {
                    statusBadge.className  = 'badge bg-secondary bg-opacity-10 text-secondary px-2.5 py-1.5 rounded-pill fw-semibold';
                    statusBadge.textContent = 'Disabled';
                }
            });
        }

        // EDIT modal binding
        const editProductModal = document.getElementById('editProductModal');
        if (editProductModal) {
            editProductModal.addEventListener('show.bs.modal', function (event) {
                const btn = event.relatedTarget;
                const url         = btn.getAttribute('data-url');
                const name        = btn.getAttribute('data-name');
                const categoryId  = btn.getAttribute('data-category-id');
                const price       = btn.getAttribute('data-price');
                const stock       = btn.getAttribute('data-stock');
                const description = btn.getAttribute('data-description');
                const isActive    = btn.getAttribute('data-active');
                const image       = btn.getAttribute('data-image') || '';

                const form = editProductModal.querySelector('#editProductForm');
                form.setAttribute('action', url);

                editProductModal.querySelector('#edit_name').value        = name;
                editProductModal.querySelector('#edit_category_id').value = categoryId || '';
                editProductModal.querySelector('#edit_price').value       = price;
                editProductModal.querySelector('#edit_stock').value       = stock;
                editProductModal.querySelector('#edit_description').value = description || '';

                const activeSwitch = editProductModal.querySelector('#edit_is_active');
                if (activeSwitch) activeSwitch.checked = (isActive == '1');

                // Reset image section to file tab
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

                // Show current image
                if (curWrap && curImg) {
                    if (image) {
                        curImg.src = image;
                        curWrap.style.display = 'block';
                    } else {
                        curWrap.style.display = 'none';
                    }
                }
            });
        }
    });
})();
</script>
