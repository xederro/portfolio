<?php
declare(strict_types=1);

namespace src\Utils;


class Response
{
    public function __construct(array $data) {
        header('Content-Type: application/json');
        $escaped = escape($data);
        echo json_encode($escaped);
    }

}