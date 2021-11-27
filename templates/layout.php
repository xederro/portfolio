<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Dawid Jabłonski: Portfolio of PHP developer focused on web development.">
    <link rel="manifest" href="manifest.json">
    <title>Dawid Jabłoński  <?php echo $params['server']['REQUEST_URI'] == '' ? 'Portfolio' : substr($params['server']['REQUEST_URI'],1);?></title>
    <link rel="apple-touch-icon" sizes="57x57" href="/public/icon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/public/icon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/public/icon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/public/icon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/public/icon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/public/icon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/public/icon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/public/icon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/public/icon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="/public/icon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/public/icon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/public/icon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/public/icon/favicon-16x16.png">
    <link rel="manifest" href="/manifest.json">
    <meta name="msapplication-TileColor" content="#000000">
    <meta name="msapplication-TileImage" content="/public/icon/ms-icon-144x144.png">
    <meta name="theme-color" content="#000000">
    <meta property="og:title" content="Dawid Jabłoński - A PHP developer / Back-end Developer" />
    <meta property="og:description" content="" />
    <meta property="og:type" content="website" />
    <meta property="og:image" content="/public/img/og.jpg" />
    <meta property="og:url" content="https://www.dawid.j.pl" />
    <link href="/public/css/tidy.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>
<body class="d-flex flex-column min-vh-100" onload="cookie()">
<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/Portfolio">Dawid Jabłoński</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link <?php if($page == "portfolio")echo 'active'?>" href="/Portfolio">Portfolio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if($page == "weather")echo 'active'?>" href="/Weather">Weather</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if($page == "chat")echo 'active'?>" href="/Chat">Chat</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if($page == "trends")echo 'active'?>" href="/Trends">Trends</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if($page == "geo")echo 'active'?>" href="/Geo">Geo</a>
                    </li>

                </ul>
                <ul class="navbar-nav ms-auto">
                    <?php
                        if(empty($params['session']['user']['id'])){
                            echo "<li class='nav-item'><a class='nav-link ";
                            if($page == 'authLogin') echo 'active';
                            echo "' href='/Login'>Login</a></li><li class='nav-item'><a class='nav-link ";
                            if($page == 'authRegister') echo 'active';
                            echo "' href='/Register'>Register</a></li>";
                        }
                        else{
                            echo '<li class="nav-item dropdown"><a class="nav-link dropdown-toggle dropstart" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">';
                            echo $params['session']['user']['name'];
                            echo '</a><ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdownMenuLink"><li><a class="dropdown-item ';
                            if($page == 'authUpdate') echo 'active';
                            echo '" href="/Edit">Edit</a></li><li><a class="dropdown-item ';
                            if($page == 'authDelete') echo 'active';
                            echo '" href="/Delete">Delete</a></li>';
                            echo '<li><a class="dropdown-item" href="/Logout">Logout</a></li></ul></li>';
                        }
                    ?>
                </ul>

            </div>
        </div>
    </nav>
</header>

<div class="modal fade" id="cookieBox" data-bs-backdrop="static" tabindex="-1" aria-labelledby="cookieBoxLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content bg-dark">
            <div class="modal-header">
                <h5 class="modal-title" id="cookieBoxLabel">Cookies 🍪</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Allow this site to use cookies for analytic purposes only.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="noCookie()" title="Yes this will save just one cookie, to dismiss this for later.">Dismiss</button>
                <button type="button" class="btn btn-primary" onclick="allowCookie()">Allow</button>
            </div>
        </div>
    </div>
</div>

<?php require_once("templates/pages/$page.php"); ?>

<footer class="bg-dark navbar navbar-dark mt-auto">
    <div class="container-fluid">
        <p class="w-100 text-center">&copy;<span id="year">20XX</span> - Portfolio -  Dawid Jabłoński</p>
    </div>
</footer>
<script src="/public/js/layout.min.js"></script>
<script> document.getElementById("year").innerHTML = (new Date()).getFullYear()</script>
</body>
</html>