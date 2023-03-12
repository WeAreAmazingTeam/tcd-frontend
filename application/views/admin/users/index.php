<header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
    <div class="container">
        <div class="page-header-content pt-4">
            <div class="row align-items-center justify-content-between">
                <div class="col-auto mt-4">
                    <h1 class="page-header-title">
                        Users
                    </h1>
                    <div class="page-header-subtitle">
                        You can find and manage users on this page.
                    </div>
                </div>
                <div class="col-12 col-xl-auto mt-4">
                    <button class="btn btn-orange p-3" type="button" data-toggle="modal" data-target="#modal-create">
                        <i class="fa fa-plus fa-fw"></i>&nbsp;Create New User
                    </button>
                </div>
            </div>
        </div>
    </div>
</header>
<div class="container mt-n10">
    <div class="card mb-4">
        <div class="card-header">Data Users</div>
        <div class="card-body">
            <div class="datatable">
                <table class="table table-bordered table-hover" id="dataTable_theCloud" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th style="width: 45px;">No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>E-Money Balance</th>
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
                <h5 class="modal-title">Create New User</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="form-create">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input class="form-control" id="name" type="text" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input class="form-control" id="email" type="email" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input class="form-control" id="password" type="password" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="role">Role</label>
                        <select class="form-control" id="role">
                            <option value="user">User</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="e_money">E-Money Balance</label>
                        <input class="form-control" id="e_money" data-type="number" type="text" placeholder="">
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="btn-create-submit" class="btn btn-orange" type="submit">Create User</button>
                    <button class="btn btn-primary" type="button" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="modal-edit-label" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit User</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="form-edit">
                <input id="edit-id" type="hidden">
                <div class="modal-body">
                    <div class="form-group">
                    <label for="email">Email</label>
                        <input class="form-control" id="edit-email" type="email" readonly>
                    </div>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input class="form-control" id="edit-name" type="text" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input class="form-control" id="edit-password" type="password" placeholder="">
                        <small class="form-text text-muted">Leave blank if you don't want to change.</small>
                    </div>
                    <div class="form-group">
                        <label for="role">Role</label>
                        <select class="form-control" id="edit-role">
                            <option value="user">User</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="e_money">E-Money Balance</label>
                        <input class="form-control" id="edit-e_money" data-type="number" type="text" placeholder="">
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="btn-edit-submit" class="btn btn-orange" type="submit">Update</button>
                    <button class="btn btn-primary" type="button" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>