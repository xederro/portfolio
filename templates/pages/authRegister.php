<div class="container" style="width: 100%">
    <div class="container-sm">
        <div class="card mt-4 w-100 p-0" style="width: 300px">
            <div class="card-header">
                <h1 class="h1">Login</h1>
            </div>
            <div class="card-body">
                <form action="javascript:validate()" method="post">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp">
                        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" id="name">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" id="password">
                    </div>
                    <div class="mb-3">
                        <label for="rpassword" class="form-label">Repeat Password</label>
                        <input type="password" class="form-control" name="rpassword" id="rpassword">
                    </div>
                    <button type="submit" class="btn btn-danger">Register</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="/src/js/register.js"></script>