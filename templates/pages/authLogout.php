<?php
unset($_SESSION);
session_destroy();
$location = $params['server']['HTTP_REFERER'] ?? '/';
header("Location: $location");