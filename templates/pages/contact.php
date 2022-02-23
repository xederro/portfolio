<div class="container" style="width: 100%">
    <div class="container-sm">
        <div class="card mt-4 w-100 p-0 bg-dark text-light" style="width: 300px">
            <div class="card-header">
                <h1 class="h1">Contact Me</h1>
            </div>
            <div class="card-body">
                <form action="javascript:void(0)" method="post">
                    <div class="row">
                        <div class="mb-3 col-12 col-md-4">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp">
                            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                        </div>
                        <div class="mb-3 col-12 col-md-8">
                            <label for="name" class="form-label">Your name</label>
                            <input type="text" class="form-control" name="name" id="name">
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col">
                            <label for="message" class="form-label">Message</label>
                            <textarea class="form-control" id="message" rows="10" name="message"></textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-danger" onclick="validate()">Send</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="/public/js/contact.min.js"></script>