<?php
declare(strict_types=1);

namespace src\Controller;


use PDOException;
use src\Model\Auth;
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
            'error' => "error",
            'authLogin' => "authLogin",
            'authRegister' => "authRegister",
            'authUpdate' => "authUpdate",
            'authDelete' => "authDelete",
            'authLogout' => "authLogout",
        };

        if($params->isPost()){
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
                    return new Response($db->read($request));
                case 'authLogin':
                    $db = new Auth(require_once("config/config.php"));
                    return new Response($db->read($request));
                case 'authRegister':
                    $db = new Auth(require_once("config/config.php"));
                    return new Response($db->create($request));
                case 'authUpdate':
                    $db = new Auth(require_once("config/config.php"));
                    return new Response($db->update($request));
                case 'authDelete':
                    $db = new Auth(require_once("config/config.php"));
                    return new Response($db->delete($request));
            }

        }
        catch(PDOException $e)
        {
            echo 'Połączenie nie mogło zostać utworzone: ' . $e->getMessage();
        }
    }
}