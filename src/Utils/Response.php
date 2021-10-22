<?php
declare(strict_types=1);

namespace src\Utils;


class Response
{
    public function __construct(array $data) {
        header('Content-Type: application/json');
        $escaped = $this->escape($data);
        echo json_encode($escaped);
    }

    private function escape(array $params): array
    {
        $clearParams = [];

        foreach($params as $key => $param){
            switch(true){
                case is_array($param):
                    $clearParams[$key] = $this->escape($param);
                    break;
                case is_int($param):
                    $clearParams[$key] = $param;
                    break;
                case $param:
                    $clearParams[$key] = htmlentities($param);
                    break;
                default:
                    $clearParams[$key] = $param;
                    break;
            }
        }
        return $clearParams;
    }
}