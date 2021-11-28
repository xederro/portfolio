<?php
declare(strict_types=1);

namespace src;

use src\Exception\NotFoundException;

class View
{
    private const LAYOUT = "templates/layout.php";

    /**
     * Puts $page from templates inside layout
     *
     * @param string $page
     * @param array $params
     * @throws NotFoundException
     */
    public function render(string $page, array $params, array $additional = []): void
    {
        try {
            $params = escape($params);
            $additional = escape($additional);
            require_once self::LAYOUT;
        }
        catch (\Exception $e){
            throw new NotFoundException('Site not found',404);
        }
    }
}