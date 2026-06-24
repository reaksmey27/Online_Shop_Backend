<div class="modal fade" id="showProductModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg rounded-4 bg-white mx-auto" style="max-width: 100%; width: 850px;">

            {{-- Modal Header --}}
            <div class="modal-header border-bottom border-light-subtle px-4 py-3">
                <div>
                    <h5 class="modal-title fw-bold text-dark fs-5" id="show_modal_title">Product Parameters</h5>
                    <p class="text-muted small mb-0">System telemetry records and verified metrics.</p>
                </div>
                <button type="button" class="btn-close small shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            {{-- Modal Body --}}
            <div class="modal-body p-4">
                <div class="row g-4">

                    {{-- Left Column: Aesthetic Visual Display --}}
                    <div class="col-md-5 text-center border-end border-light-subtle">
                        <div id="show_image_container" class="mb-4">
                            {{-- Dynamically populated via JavaScript telemetry data --}}
                        </div>
                        <h5 class="fw-bold text-dark mb-1" id="show_name">—</h5>
                        <p class="text-dark fw-bold fs-4 mb-3" id="show_price">$0.00</p>
                        <div id="show_status_badge" class="mb-2">
                            {{-- Dynamically populated via JavaScript --}}
                        </div>
                    </div>

                    {{-- Right Column: Telemetry Parameters Data Table --}}
                    <div class="col-md-7">
                        <div class="table-responsive">
                            <table class="table table-borderless align-middle mb-0">
                                tbody>
                                    <tr class="border-bottom border-light-subtle">
                                        <td class="text-muted small fw-medium py-2.5" style="width: 150px;">Category Class</td>
                                        <td class="py-2.5">
                                            <span class="badge bg-primary bg-opacity-10 text-primary px-2.5 py-1.5 rounded-pill fw-semibold small" id="show_category">
                                                —
                                            </span>
                                        </td>
                                    </tr>
                                    <tr class="border-bottom border-light-subtle">
                                        <td class="text-muted small fw-medium py-2.5">System Handle</td>
                                        <td class="py-2.5">
                                            <code class="text-secondary bg-light px-2 py-1 rounded small fw-normal" id="show_slug">—</code>
                                        </td>
                                    </tr>
                                    <tr class="border-bottom border-light-subtle">
                                        <td class="text-muted small fw-medium py-2.5">Stock Metric</td>
                                        <td class="py-2.5">
                                            <div id="show_stock_badge" class="d-inline-block">
                                                {{-- Dynamically populated via JavaScript --}}
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="border-bottom border-light-subtle">
                                        <td class="text-muted small fw-medium py-2.5">Aggregated Rating</td>
                                        <td class="py-2.5 text-dark fw-medium small" id="show_rating">
                                            —
                                        </td>
                                    </tr>
                                    <tr class="border-bottom border-light-subtle">
                                        <td class="text-muted small fw-medium py-2.5">Registration Date</td>
                                        <td class="py-2.5 text-muted small" id="show_created">—</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted small fw-medium py-2.5">Description</td>
                                        <td class="py-2.5 text-secondary small lh-base" id="show_description">—</td>
                                    </tr>
                                </tbody>
                            </table>
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
