<?php
declare(strict_types=1);

namespace src\Model;


use src\Utils\Request;

interface InterfaceModel
{
    /**
     * @param Request $request
     * @return array
     */
    public function read(Request $request): array;
}