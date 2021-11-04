<?php
declare(strict_types=1);

namespace src\Controller;


use PDOException;
use src\Model\Weather;
use src\Utils\Request;
use src\Utils\Response;
use src\View;

class PortfolioController
{
    private const PAGE = "portfolio";

    private View $view;

    public function __construct(Request $params){
        $this->view = new View();
        $page = match ($params->getParam('page')){
            default => self::PAGE,
            'weather' => "weather",
            'chat' => "chat",
            'geo' => "geo",
            'trends' => "trends",
            'error' => "error"
        };

        if(!is_null($params->getParam('data'))){
            $this->data($page, $params);
        }
        else{
            $this->site($page, $params);
        }
    }

    private function site(string $page, Request $request){
        $this->view->render($page, $request->getData());
    }

    private function data(string $page, Request $request){

        try
        {
            switch ($page){
                case 'weather':
                    $db = new Weather(require_once("config/config.php"));
                    return new Response($db->getData($request));
            }

        }
        catch(PDOException $e)
        {
            echo 'Połączenie nie mogło zostać utworzone: ' . $e->getMessage();
        }
    }
}