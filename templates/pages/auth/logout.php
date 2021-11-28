<?php
unset($_SESSION);
session_destroy();
$location = match($params['server']['HTTP_REFERER'] ?? 'null'){
    default => $params['server']['HTTP_REFERER'],
    '/Edit', '/Delete', 'null' => '/'
};
header("Location: $location");