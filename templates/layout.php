<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Dawid Jabłonski: Portfolio of PHP developer focused on web development.">
    <link rel="manifest" href="manifest.json">
    <title>Dawid Jabłoński - <?php echo strtolower($page) ?></title>
    <link rel="icon" href="favicon.ico" type="image/x-icon" />
    <link href="/public/css/tidy.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>
<body >
<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="Portfolio">Dawid Jabłoński</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link <?php if($page == "portfolio")echo 'active'?>" href="/Portfolio">Portfolio</a>
                    <a class="nav-link <?php if($page == "weather")echo 'active'?>" href="/Weather">Weather</a>
                    <a class="nav-link <?php if($page == "chat")echo 'active'?>" href="/Chat">Chat</a>
                    <a class="nav-link <?php if($page == "trends")echo 'active'?>" href="/Trends">Trends</a>
                    <a class="nav-link <?php if($page == "geo")echo 'active'?>" href="/Geo">Geo</a>
                </div>
            </div>
        </div>
    </nav>
</header>

<?php require_once("templates/pages/$page.php"); ?>

<footer class="bg-dark navbar navbar-dark">
    <div class="container-fluid">
        <p class="w-100 text-center">&copy;<span id="year">20XX</span> - Portfolio -  Dawid Jabłoński</p>
    </div>
</footer>
<script src="/public/js/layout.min.js"></script>
<script> document.getElementById("year").innerHTML = (new Date()).getFullYear()</script>
</body>
</html>