<?php

declare(strict_types=1);

error_reporting(E_ALL);
ini_set('display_errors', '1');

/**
 * Add data to log
 *
 * @param $data
 */
function addLog($data):void
{
    $log = fopen("Log.php",'a');
    fwrite($log, $data.'/n');
    fclose($log);
}
