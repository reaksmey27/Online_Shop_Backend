<div class="modal fade" id="showUserModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content border-0 shadow-lg rounded-4 bg-white mx-auto">

            <div class="modal-header border-bottom border-light-subtle px-4 py-3">
                <div>
                    <h5 class="modal-title fw-bold text-dark fs-5">User Specification Profile</h5>
                    <p class="text-muted small mb-0">Verified operational metrics, transactional logs, and profile tracking metadata.</p>
                </div>
                <button type="button" class="btn-close small shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body p-4">
                <div class="row g-4">

                    
                    <div class="col-lg-4 border-end border-light-subtle">
                        <div class="p-2 text-center">
                            <div id="modal_user_avatar" class="rounded-circle bg-dark text-white d-inline-flex align-items-center justify-content-center fw-bold mx-auto mb-3 border border-light-subtle"
                                 style="width: 72px; height: 72px; font-size: 1.6rem; letter-spacing: -0.02em;">
                                —
                            </div>
                            <h5 class="fw-bold text-dark mb-1" id="modal_user_name">—</h5>
                            <p class="text-secondary small mb-4" id="modal_user_email">—</p>

                            <div class="d-flex justify-content-center align-items-center gap-2 bg-light p-3 rounded-4 border border-light-subtle-subtle">
                                <div class="text-center flex-grow-1">
                                    <div class="fw-bold text-dark fs-5 mb-0.5" id="modal_user_orders_count">0</div>
                                    <div class="text-muted small" style="font-size: 0.75rem;">Total Orders</div>
                                </div>
                                <div class="vr bg-secondary opacity-25" style="height: 32px;"></div>
                                <div class="text-center flex-grow-1">
                                    <div class="fw-bold text-success fs-5 mb-0.5" id="modal_user_total_spent">$0.00</div>
                                    <div class="text-muted small" style="font-size: 0.75rem;">Total Spent</div>
                                </div>
                            </div>

                            <div class="mt-4 pt-3 text-center text-muted small border-top border-light-subtle-subtle">
                                <i class="bi bi-calendar-check me-1"></i> Account Created: <span id="modal_user_joined" class="fw-medium text-dark">—</span>
                            </div>
                        </div>
                    </div>

                    
                    <div class="col-lg-8">
                        <h6 class="mb-3 fw-bold text-dark d-flex align-items-center gap-2">
                            <i class="bi bi-clock-history text-muted"></i> Historical Purchase Feed
                        </h6>

                        <div class="card border border-light-subtle rounded-4 overflow-hidden bg-white shadow-none">
                            <div class="table-responsive" style="max-height: 320px;">
                                <table class="table table-hover align-middle mb-0">
                                    <thead class="bg-light table-light sticky-top">
                                        <tr class="text-uppercase text-muted fw-bold" style="font-size: 0.7rem; letter-spacing: 0.05em;">
                                            <th class="border-0 px-4 py-2.5">Order ID</th>
                                            <th class="border-0 py-2.5">Items</th>
                                            <th class="border-0 py-2.5">Total Amount</th>
                                            <th class="border-0 py-2.5">Status</th>
                                            <th class="border-0 py-2.5">Date</th>
                                            <th class="border-0 text-end px-4 py-2.5">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="modal_orders_table_body">
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="modal-footer bg-light border-top border-light-subtle px-4 py-3">
                <button type="button" class="btn btn-dark btn-sm rounded-3 fw-medium px-4 py-2 small" data-bs-dismiss="modal">Close Window</button>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\Users\REAKSMEY.SAN\Desktop\online-shop\backend\resources\views/admin/users/partials/modal.blade.php ENDPATH**/ ?>