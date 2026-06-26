<div class="modal fade" id="showProductModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg rounded-4 mx-auto" style="max-width:100%; width:850px;">
            <div class="modal-header border-bottom px-4 py-3">
                <div>
                    <h5 class="modal-title fw-bold fs-5" id="show_modal_title" style="color:var(--text);">Product Details</h5>
                    <p class="text-muted small mb-0">Product information and stock details.</p>
                </div>
                <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <div class="row g-4">
                    <div class="col-md-5 text-center border-end" style="border-color:var(--border) !important;">
                        <div id="show_image_container" class="mb-4"></div>
                        <h5 class="fw-bold mb-1" id="show_name" style="color:var(--text);">—</h5>
                        <p class="fw-bold fs-4 mb-3" id="show_price" style="color:var(--text);">$0.00</p>
                        <div id="show_status_badge" class="mb-2"></div>
                    </div>
                    <div class="col-md-7">
                        <table class="table table-borderless align-middle mb-0">
                            <tbody>
                                <tr class="border-bottom" style="border-color:var(--border) !important;">
                                    <td class="text-muted small fw-medium py-2" style="width:140px;">Category</td>
                                    <td class="py-2">
                                        <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill fw-semibold px-3 small" id="show_category">—</span>
                                    </td>
                                </tr>
                                <tr class="border-bottom" style="border-color:var(--border) !important;">
                                    <td class="text-muted small fw-medium py-2">Slug</td>
                                    <td class="py-2"><code class="text-muted px-2 py-1 rounded small" id="show_slug">—</code></td>
                                </tr>
                                <tr class="border-bottom" style="border-color:var(--border) !important;">
                                    <td class="text-muted small fw-medium py-2">Stock</td>
                                    <td class="py-2"><div id="show_stock_badge" class="d-inline-block"></div></td>
                                </tr>
                                <tr class="border-bottom" style="border-color:var(--border) !important;">
                                    <td class="text-muted small fw-medium py-2">Rating</td>
                                    <td class="py-2 small fw-medium" id="show_rating" style="color:var(--text);">—</td>
                                </tr>
                                <tr class="border-bottom" style="border-color:var(--border) !important;">
                                    <td class="text-muted small fw-medium py-2">Created</td>
                                    <td class="py-2 text-muted small" id="show_created">—</td>
                                </tr>
                                <tr>
                                    <td class="text-muted small fw-medium py-2">Description</td>
                                    <td class="py-2 text-muted small lh-base" id="show_description">—</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-top px-4 py-3">
                <button type="button" class="btn btn-dark btn-sm rounded-3 fw-medium px-4 py-2 small" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\Users\REAKSMEY.SAN\Desktop\online-shop\backend\resources\views/admin/products/partials/show-modal.blade.php ENDPATH**/ ?>