<script>
(function () {
    function byId(id) { return document.getElementById(id); }

    // Generic toggle handler for a given prefix
    function setupCategoryImageToggle(pfx, formSelector) {
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

    setupCategoryImageToggle('cat_create', '#createCategoryModal form');
    setupCategoryImageToggle('cat_edit',   '#editCategoryForm');

    // Preview helpers (called inline via onchange/oninput)
    window.previewCategoryFromFile = function (input, pfx) {
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

    window.previewCategoryFromUrl = function (url, pfx) {
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

    // Edit modal: populate fields + show current image
    document.addEventListener('DOMContentLoaded', function () {
        const editModal = document.getElementById('editCategoryModal');
        if (!editModal) return;

        editModal.addEventListener('show.bs.modal', function (event) {
            const btn = event.relatedTarget;
            const url         = btn.getAttribute('data-url');
            const name        = btn.getAttribute('data-name');
            const description = btn.getAttribute('data-description');
            const isActive    = btn.getAttribute('data-active');
            const image       = btn.getAttribute('data-image') || '';

            const form = editModal.querySelector('#editCategoryForm');
            form.setAttribute('action', url);

            editModal.querySelector('#edit_name').value        = name;
            editModal.querySelector('#edit_description').value = description || '';

            const activeSwitch = editModal.querySelector('#edit_is_active');
            if (activeSwitch) activeSwitch.checked = (isActive == '1');

            // Reset image section to "file" tab
            const fileRadio = byId('cat_edit_type_file');
            const urlRadio  = byId('cat_edit_type_url');
            const secFile   = byId('cat_edit_section_file');
            const secUrl    = byId('cat_edit_section_url');
            const prevWrap  = byId('cat_edit_imagePreview');
            const urlInput  = byId('cat_edit_imageUrl');
            const curWrap   = byId('cat_edit_currentImageWrap');
            const curImg    = byId('cat_edit_currentImg');

            if (fileRadio) fileRadio.checked = true;
            if (urlRadio)  urlRadio.checked  = false;
            if (secFile)   secFile.style.display = 'block';
            if (secUrl)    secUrl.style.display  = 'none';
            if (prevWrap)  prevWrap.style.display = 'none';
            if (urlInput)  urlInput.value = '';

            // Show current image if it exists
            if (curWrap && curImg) {
                if (image) {
                    curImg.src = image;
                    curWrap.style.display = 'block';
                } else {
                    curWrap.style.display = 'none';
                }
            }
        });
    });
})();
</script>
<?php /**PATH C:\Users\REAKSMEY.SAN\Desktop\online-shop\backend\resources\views/admin/categories/partials/image-script.blade.php ENDPATH**/ ?>