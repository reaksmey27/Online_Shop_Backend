<div class="modal fade" id="showUserModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content border-0 shadow-lg rounded-4 bg-white mx-auto">

            {{-- Modal Header --}}
            <div class="modal-header border-bottom border-light-subtle px-4 py-3">
                <div>
                    <h5 class="modal-title fw-bold text-dark fs-5">User Profile Overview</h5>
                    <p class="text-muted small mb-0">Review consumer lifecycle stats, account parameters, and transaction records.</p>
                </div>
                <button type="button" class="btn-close small shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            {{-- Modal Body --}}
            <div class="modal-body p-4">
                <div class="row g-4">

                    {{-- Left Column: Profile Insight Card --}}
                    <div class="col-lg-4 border-end border-light-subtle">
                        <div class="p-3 text-center">
                            {{-- Dynamic Initials Avatar --}}
                            <div id="modal_user_avatar" class="rounded-circle bg-dark text-white d-flex align-items-center justify-content-center fw-bold mx-auto mb-3 border border-light-subtle"
                                 style="width: 72px; height: 72px; font-size: 1.6rem; letter-spacing: -0.02em;">
                                —
                            </div>

                            <h6 class="fw-bold text-dark mb-1" id="modal_user_name">—</h6>
                            <p class="text-muted small mb-4" id="modal_user_email">—</p>

                            <div class="d-flex justify-content-center align-items-center gap-3 bg-light p-3 rounded-4 border border-light-subtle-subtle">
                                <div class="text-center flex-grow-1">
                                    <div class="fw-bold text-dark fs-5" id="modal_user_orders_count">0</div>
                                    <div class="text-muted small" style="font-size: 0.75rem;">Total Orders</div>
                                </div>
                                <div class="vr bg-secondary opacity-25" style="height: 30px;"></div>
                                <div class="text-center flex-grow-1">
                                    <div class="fw-bold text-dark fs-5" id="modal_user_spent">$0.00</div>
                                    <div class="text-muted small" style="font-size: 0.75rem;">Total Spent</div>
                                </div>
                            </div>

                            <div class="mt-4 pt-2 text-center text-muted small border-top border-light-subtle-subtle">
                                <i class="bi bi-calendar-check me-1"></i> Account Created: <span id="modal_user_joined" class="fw-medium text-secondary">—</span>
                            </div>
                        </div>
                    </div>

                    {{-- Right Column: Order History Feed --}}
                    <div class="col-lg-8">
                        <div class="d-flex justify-content-between align-items-center mb-3 px-1">
                            <h6 class="mb-0 fw-bold text-dark d-flex align-items-center gap-2">
                                <i class="bi bi-clock-history text-muted"></i> Historical Purchase Feed
                            </h6>
                        </div>

                        <div class="card border border-light-subtle rounded-4 overflow-hidden bg-white shadow-none">
                            <div class="table-responsive" style="max-height: 340px;">
                                <table class="table table-hover align-middle mb-0">
                                    <thead class="bg-light table-light sticky-top">
                                        <tr class="text-uppercase text-muted fw-bold" style="font-size: 0.7rem; letter-spacing: 0.05em;">
                                            <th class="border-0 px-4 py-2.5">Order ID</th>
                                            <th class="border-0 py-2.5">Items Count</th>
                                            <th class="border-0 py-2.5">Gross Amount</th>
                                            <th class="border-0 py-2.5">Status</th>
                                            <th class="border-0 py-2.5">Fulfillment Date</th>
                                        </tr>
                                    </thead>
                                    <tbody id="modal_user_orders_table">
                                        {{-- Populated dynamically via JavaScript mapping --}}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            {{-- Modal Footer --}}
            <div class="modal-footer bg-light border-top border-light-subtle px-4 py-3">
                <button type="button" class="btn btn-dark btn-sm rounded-3 fw-medium px-4 py-2 small" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>
