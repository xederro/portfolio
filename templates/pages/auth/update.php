<div class="container" style="width: 100%">
    <div class="container-sm">
        <div class="card mt-4 w-100 p-0 bg-dark text-light" style="width: 300px">
            <div class="card-header">
                <h1 class="h1">Edit</h1>
            </div>
            <div class="card-body">
                <form action="javascript:void(0)" method="post">
                    <div class="mb-3">
                        <label for="name" class="form-label">New Name</label>
                        <input type="text" class="form-control" name="name" id="name">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" id="password">
                    </div>
                    <div class="mb-3">
                        <label for="npassword" class="form-label">New Password</label>
                        <input type="password" class="form-control" name="npassword" id="npassword">
                    </div>
                    <div class="mb-3">
                        <label for="rpassword" class="form-label">Repeat New Password</label>
                        <input type="password" class="form-control" name="rpassword" id="rpassword">
                    </div>
                    <button type="submit" class="btn btn-danger" onclick="validate()">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="/public/js/update.min.js"></script>