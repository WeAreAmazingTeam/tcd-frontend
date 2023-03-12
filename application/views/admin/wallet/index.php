<header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
    <div class="container">
        <div class="page-header-content pt-4">
            <div class="row align-items-center justify-content-between">
                <div class="col-auto mt-4">
                    <h1 class="page-header-title">
                       Wallet Management
                    </h1>
                    <div class="page-header-subtitle">
                        Page to get e-money balance information and withdraw e-money.
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<div class="container mt-n10">
    <div class="row">
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header">Information</div>
                <div class="card-body">
                    <p>
                        <b>Your E-Money Balance:</b><br>
                        <span id="balance"></span>
                    </p>
                    <hr>
                    <p>
                        You cannot deposit to get an E-Money Balance. E-Money Balance can only get if you become the winner in the exclusive campaign and if the prize is E-Money.
                    </p>
                    <p>
                        You will also get an E-Money balance from the campaign you created and if the campaign you created is finished or the target has been reached.
                    </p>
                    <hr>
                    <p class="mb-0">
                        E-Money Balance can be used for donations or can also be withdrawal/disbursed into cash.
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header">Form Withdrawal Request</div>
                <div id="card-body-withdrawal" class="card-body"></div>
            </div>
        </div>
        <div class="col-12 mb-4"><hr></div>
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header">Your E-Money Flow Data</div>
                <div class="card-body">
                    <div class="datatable">
                        <table class="table table-bordered table-hover" id="dataTable_theCloud" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th style="width: 45px;">No</th>
                                    <th>Status</th>
                                    <th>Amount</th>
                                    <th>Note</th>
                                    <th>Date and Time</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header">Data Withdrawal Requests</div>
                <div class="card-body">
                    <div class="datatable">
                        <table class="table table-bordered table-hover" id="dataTable_theCloud_2" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th style="width: 45px;">No</th>
                                    <th>Status</th>
                                    <th>Amount</th>
                                    <th>Note</th>
                                    <th>Date and Time</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
