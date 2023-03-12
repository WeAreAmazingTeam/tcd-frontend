<header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
    <div class="container">
        <div class="page-header-content pt-4">
            <div class="row align-items-center justify-content-between">
                <div class="col-auto mt-4">
                    <h1 class="page-header-title">
                        Company Cash Flow
                    </h1>
                    <div class="page-header-subtitle">
                        You can find and manage company cash flow on this page.
                    </div>
                </div>
                <div class="col-12 col-xl-auto mt-4">
                    <button class="btn btn-orange p-3" type="button" data-toggle="modal" data-target="#modal-create">
                        <i class="fa fa-plus fa-fw"></i>&nbsp;Create Company Cash Flow
                    </button>
                </div>
            </div>
        </div>
    </div>
</header>

<div class="container mt-n10">
    <div class="card mb-4">
        <div class="card-header">Data Company Cash Flow</div>
        <div class="card-body">
            <div class="datatable">
                <table class="table table-bordered table-hover" id="dataTable_theCloud" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th style="width: 45px;">No</th>
                            <th>Amount</th>
                            <th>Note</th>
                            <th>Type</th>
                            <th style="width: 95px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-create" tabindex="-1" role="dialog" aria-labelledby="modal-create-label" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create New Company Cash Flow</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="form-create">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="status">Type</label>
                        <select class="form-control" id="status">
                            <option value="in">IN</option>
                            <option value="out">OUT</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="amount">Amount</label>
                        <input class="form-control" id="amount" data-type="number" type="text" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="note">Note/Information</label>
                        <textarea class="form-control" id="note" rows="10"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="btn-create-submit" class="btn btn-orange" type="submit">Submit</button>
                    <button class="btn btn-primary" type="button" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>