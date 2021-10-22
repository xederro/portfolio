<?php

declare(strict_types=1);

error_reporting(E_ALL);
ini_set('display_errors', '1');


function clean($string) {
    $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

    return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}