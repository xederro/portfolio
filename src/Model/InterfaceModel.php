<?php
declare(strict_types=1);

namespace src\Model;


use MongoDB\Driver\Query;
use src\Utils\Request;

interface InterfaceModel
{
    /**
     * @param Request $request
     * @return array
     */
    public function read(Request $request, string $query): array;
}