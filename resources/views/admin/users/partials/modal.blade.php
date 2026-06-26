<div class="modal fade" id="showUserModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content border-0 shadow-lg rounded-4 mx-auto">

            <div class="modal-header border-bottom px-4 py-3">
                <div>
                    <h5 class="modal-title fw-bold fs-5" style="color:var(--text);">User Profile</h5>
                    <p class="text-muted small mb-0">Account details and order history.</p>
                </div>
                <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body p-4">
                <div class="row g-4">

                    {{-- Left: Profile summary --}}
                    <div class="col-lg-4 border-end" style="border-color:var(--border) !important;">
                        <div class="p-2 text-center">
                            <div id="modal_user_avatar" class="user-avatar rounded-circle d-inline-flex align-items-center justify-content-center fw-bold mx-auto mb-3"
                                 style="width:72px; height:72px; font-size:1.6rem;">—</div>
                            <h5 class="fw-bold mb-1" id="modal_user_name" style="color:var(--text);">—</h5>
                            <p class="text-muted small mb-4" id="modal_user_email">—</p>

                            <div class="d-flex justify-content-center align-items-center gap-2 p-3 rounded-4"
                                 style="background:var(--surface-2); border:1px solid var(--border);">
                                <div class="text-center flex-grow-1">
                                    <div class="fw-bold fs-5 mb-0" id="modal_user_orders_count" style="color:var(--text);">0</div>
                                    <div class="text-muted small" style="font-size:.75rem;">Orders</div>
                                </div>
                                <div class="vr opacity-25" style="height:32px;"></div>
                                <div class="text-center flex-grow-1">
                                    <div class="fw-bold fs-5 mb-0 text-success" id="modal_user_total_spent">$0.00</div>
                                    <div class="text-muted small" style="font-size:.75rem;">Spent</div>
                                </div>
                            </div>

                            <div class="mt-4 pt-3 text-muted small border-top" style="border-color:var(--border) !important;">
                                <i class="bi bi-calendar-check me-1"></i>
                                Joined <span id="modal_user_joined" class="fw-medium" style="color:var(--text);">—</span>
                            </div>
                        </div>
                    </div>

                    {{-- Right: Order history --}}
                    <div class="col-lg-8">
                        <h6 class="mb-3 fw-bold d-flex align-items-center gap-2" style="color:var(--text);">
                            <i class="bi bi-clock-history text-muted"></i> Order History
                        </h6>
                        <div class="card border rounded-4 overflow-hidden shadow-none" style="border-color:var(--border) !important;">
                            <div class="table-responsive" style="max-height:320px;">
                                <table class="table table-hover align-middle mb-0">
                                    <thead class="table-light sticky-top">
                                        <tr class="text-uppercase text-muted fw-bold" style="font-size:.7rem; letter-spacing:.05em;">
                                            <th class="border-0 px-4 py-2">Order</th>
                                            <th class="border-0 py-2">Items</th>
                                            <th class="border-0 py-2">Amount</th>
                                            <th class="border-0 py-2">Status</th>
                                            <th class="border-0 py-2">Date</th>
                                            <th class="border-0 text-end px-4 py-2">Link</th>
                                        </tr>
                                    </thead>
                                    <tbody id="modal_orders_table_body"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="modal-footer border-top px-4 py-3">
                <button type="button" class="btn btn-dark btn-sm rounded-3 fw-medium px-4 py-2 small" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
