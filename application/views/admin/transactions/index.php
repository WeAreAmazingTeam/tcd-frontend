<header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
    <div class="container">
        <div class="page-header-content pt-4">
            <div class="row align-items-center justify-content-between">
                <div class="col-auto mt-4">
                    <h1 class="page-header-title">
                        Transactions
                    </h1>
                    <div class="page-header-subtitle">
                        You can find and manage user transactions on this page.
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<div class="container mt-n10">
    <div class="card mb-4">
        <div class="card-header">Data Transactions</div>
        <div class="card-body">
            <div class="datatable">
                <table class="table table-bordered table-hover" id="dataTable_theCloud" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th style="width: 45px;">No</th>
                            <th>Campaign</th>
                            <th>User</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Code</th>
                            <th style="max-width: 200px;">Comment</th>
                            <th style="width: 95px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-view-more" tabindex="-1" role="dialog" aria-labelledby="modal-view-more-label" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">View More Data Transaction</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <p>
                    <b>Campaign:</b><br>
                    <span id="view-more-campaign"></span>
                </p>
                <p>
                    <b>User:</b><br>
                    <span id="view-more-user"></span>
                </p>
                <p>
                    <b>Amount:</b><br>
                    <span id="view-more-amount"></span>
                </p>
                <p>
                    <b>Status:</b><br>
                    <span id="view-more-status" class="text-capitalize"></span>
                </p>
                <p>
                    <b>Code:</b><br>
                    <span id="view-more-code"></span>
                </p>
                <p>
                    <b>Comment:</b><br>
                    <span id="view-more-comment"></span>
                </p>
                <p>
                    <b>Payment URL:</b><br>
                    <span id="view-more-payment_url"></span>
                </p>
                <p class="mb-0">
                    <b>Payment Token:</b><br>
                    <span id="view-more-payment_token"></span>
                </p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" type="button" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>