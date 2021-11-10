<?php
declare(strict_types=1);

namespace src;

class View
{
    private const LAYOUT = "templates/layout.php";

    public function render(string $page, array $params): void
    {
        $params = escape($params);
        require_once self::LAYOUT;
    }
}