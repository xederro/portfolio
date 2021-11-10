<div class="container" style="width: 100%">
    <div class="container-sm">
        <div class="card mt-4 w-100 p-0" style="width: 300px">
            <div class="card-header">
                <h1 class="h1">Login</h1>
            </div>
            <div class="card-body">
                <form action="javascript:validate()" method="post">
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" id="password">
                    </div>

                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#alert">
                        Delete
                    </button>

                    <div class="modal fade" id="alert" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content bg-dark">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">WAIT!</h5>
                                </div>
                                <div class="modal-body">
                                    Are you sure that you want to delete your account? This will be irreversible!
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">No</button>
                                    <button type="submit" class="btn btn-danger">Yes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="/public/js/delete.min.js"></script>