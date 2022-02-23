<div class="container" style="width: 100%">
    <div class="container-sm">
        <div class="card mt-4 w-100 p-0 bg-dark text-light" style="width: 300px">
            <div class="card-header">
                <h1 class="h1">Forget Password</h1>
            </div>
            <div class="card-body">
                <form action="javascript:void(0)" method="post">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp">
                        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div>
                    <button type="submit" class="btn btn-danger" onclick="validate()">Send mail</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="/public/js/forget.min.js"></script>

