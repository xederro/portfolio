<?php

declare(strict_types=1);

function escape(array $params): array
{
    $clearParams = [];

    foreach($params as $key => $param){
        switch(true){
            case is_array($param):
                $clearParams[$key] = escape($param);
                break;
            case is_int($param) || is_float($param):
                $clearParams[$key] = $param;
                break;
            default:
                $clearParams[$key] = $param;
                break;
        }
    }
    return $clearParams;
}