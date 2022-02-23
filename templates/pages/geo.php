<div class="container">
    <div class="container-sm">
        <div class="card bg-dark text-light mt-4 w-100 p-0" style="width: 300px">
            <div class="card-header">
                <h1 class="h1">Other IP</h1>
            </div>
            <div class="card-body">
                <form action="javascript:validate()" method="get">
                    <div class="mb-3">
                        <label for="ip" class="form-label">IP address</label>
                        <input type="number" id="ip1" min="0" max="255">.
                        <input type="number" id="ip2" min="0" max="255">.
                        <input type="number" id="ip3" min="0" max="255">.
                        <input type="number" id="ip4" min="0" max="255">
                    </div>
                    <button type="submit" class="btn btn-danger">Check</button>
                </form>
            </div>
        </div>
    </div>


    <div class="container-sm">
        <div class="card bg-dark text-light mt-4 w-100 p-0" style="width: 300px">
            <div class="card-header">
                <h1 class="h1">Info about <?php echo !($additional['geo']->status == 'fail') ? $additional['geo']->query : ""; ?></h1>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item list-group-item-dark bg-dark text-light">
                    <h6>
                        Country: <?php echo !($additional['geo']->status == 'fail') ? $additional['geo']->country : ""; ?>
                    </h6>
                </li>
                <li class="list-group-item list-group-item-dark bg-dark text-light">
                    <h6>
                        City: <?php echo !($additional['geo']->status == 'fail') ? $additional['geo']->city : ""; ?>
                    </h6>
                </li>
                <li class="list-group-item list-group-item-dark bg-dark text-light">
                    <?php
                        if($additional['geo']->status == 'fail'){
                            echo "Something went wrong while trying to check your address: {$additional['geo']->query}";
                        }
                        else{
                            echo "<iframe class='w-100' height='500px' src='https://maps.google.com/maps?q={$additional['geo']->lat},%20{$additional['geo']->lon}&t=&z=13&ie=UTF8&iwloc=&output=embed' frameborder='0' scrolling='no' marginheight='0' marginwidth='0'></iframe>";
                        }
                    ?>
                </li>
            </ul>
        </div>
    </div>
</div>


<script src="/public/js/geo.min.js"></script>
