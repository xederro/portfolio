<div class="container" style="width: 100%">
    <div class="container-sm">
        <h1 class="text-center">ARGH! Error
            <?php

            echo $params['get']['error'] ?? 'Unknown';

            echo match($params['get']['error'] ?? 'Unknown'){
                '400' => ": Bad Request",
                '401' => ": Unauthorized",
                '403' => ": Forbidden",
                '404' => ": Not Found",
                '500' => ": Server Error",
                default => ": Unknown Error"
            };

            ?>
        </h1>
    </div>
</div>


<script src="/public/js/geo.min.js"></script>
