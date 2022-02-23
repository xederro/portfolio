<div class="modal fade text-light" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content bg-dark">
            <div class="modal-body">
                <div class="mb-3">
                    <label for="pass" class="form-label">Password</label>
                    <input type="password" class="form-control" id="pass">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" onclick="approve()" class="btn btn-danger">Delete</button>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="container-sm">
        <div class="card mt-4 w-100 p-0 bg-dark text-light" style="width: 300px">
            <div class="card-header">
                <h1 class="h1">Shorten your link</h1>
            </div>
            <div class="card-body">
                <form action="javascript:void(0)" method="post">
                    <div class="input-group mb-3">
                        <label for="long">Long:&nbsp;</label>
                        <input type="text" id="long" class="form-control" name="long" required>
                    </div>
                    <div class="input-group mb-3">
                        <label for="short">Short:&nbsp;</label>
                        <span class="input-group-text" style="width: 150px">dawid.j.pl/Short/</span>
                        <input type="text" id="short" class="form-control" name="short" required>
                    </div>
                    <button type="submit" onclick="validate()" class="btn btn-danger">Create</button>
                </form>
            </div>
        </div>
    </div>


    <div class="container-sm">
        <div class="card mt-4 w-100 p-0" style="width: 300px">
            <div class="card-header">
                <h1 class="h1">Your links</h1>
            </div>
            <table class="table table-dark">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Short</th>
                    <th scope="col">Long</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                    foreach($additional['links'] as $key => $link){
                        echo "
                            <tr>
                            <th scope='row'>". $key+1 ."</th>
                            <td>dawid.j.pl/Short/{$link['id']}</td>
                            <td>{$link['long']}</td>
                            <td class='text-center'>
                            <button type='button' onclick='del(\"{$link['id']}\")' class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#modal'><i class='bi bi-trash'></i></button>
                            </td>
                            </tr>
                        ";
                    }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<script src="/public/js/short.min.js"></script>