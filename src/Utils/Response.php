<?php
declare(strict_types=1);

namespace src\Utils;


class Response
{
    /**
     * Creating a json response from data
     *
     * @param array $data
     */
    public function __construct(array $data) {
        header('Content-Type: application/json');
        $escaped = escape($data);
        echo json_encode($escaped);
    }

}