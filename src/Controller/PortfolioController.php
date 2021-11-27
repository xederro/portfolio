<?php
declare(strict_types=1);

namespace src\Controller;


use PDOException;
use src\Exception\AppException;
use src\Exception\ConfigurationException;
use src\Exception\NotFoundException;
use src\Exception\StorageException;
use src\Model\User;
use src\Model\Weather;
use src\Utils\Request;
use src\Utils\Response;
use src\View;

class PortfolioController
{
    private const PAGE = "portfolio";

    private View $view;

    /**
     * routes client to proper sites, decides if load site or return data
     *
     * @param Request $params
     * @throws AppException
     * @throws ConfigurationException
     * @throws StorageException
     */
    public function __construct(Request $params){
        $this->view = new View();
        $page = match ($params->getParam('page')){
            default => self::PAGE,
            'weather' => "weather",
            'chat' => "chat",
            'geo' => "geo",
            'trends' => "trends",
            'error' => "error",
            'authLogin' => "auth/login",
            'authRegister' => "auth/register",
            'authUpdate' => "auth/update",
            'authDelete' => "auth/delete",
            'authLogout' => "auth/logout",
            'authReset' => "auth/reset",
            'authForget' => "auth/forget",
        };

        if($params->isPost()){
            $this->data($page, $params);
        }
        else{
            $this->site($page, $params);
        }
    }

    /**
     * loads site
     *
     * @param string $page
     * @param Request $request
     * @throws NotFoundException
     */
    private function site(string $page, Request $request){
        $this->view->render($page, $request->getData());
    }

    /**
     * returns data
     *
     * @param string $page
     * @param Request $request
     * @throws AppException
     * @throws ConfigurationException
     * @throws StorageException
     */
    private function data(string $page, Request $request): void
    {
        try
        {
            switch ($page){
                case 'weather':
                    $db = new Weather(require_once("config/config.php"));
                    new Response($db->read($request));
                    return;
                case 'auth/login':
                    $auth = new AuthController(new User(require_once("config/config.php")));
                    new Response($auth->login($request));
                    return;
                case 'auth/register':
                    $auth = new AuthController(new User(require_once("config/config.php")));
                    new Response($auth->add($request));
                    return;
                case 'auth/update':
                    $auth = new AuthController(new User(require_once("config/config.php")));
                    new Response($auth->edit($request));
                    return;
                case 'auth/delete':
                    $auth = new AuthController(new User(require_once("config/config.php")));
                    new Response($auth->remove($request));
                    return;
                case 'auth/forget':
                    $auth = new AuthController(new User(require_once("config/config.php")));
                    new Response($auth->forget($request));
                    return;
                case 'auth/reset':
                    $auth = new AuthController(new User(require_once("config/config.php")));
                    new Response($auth->reset($request));
                    return;
            }

        }
        catch(PDOException $e)
        {
            throw new AppException('There was an error while trying to get data ' . $e,500);
        }
    }
}