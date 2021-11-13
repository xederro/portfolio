<?php
declare(strict_types=1);

namespace src\Controller;


use PDOException;
use src\Exception\AppException;
use src\Exception\ConfigurationException;
use src\Exception\NotFoundException;
use src\Exception\StorageException;
use src\Model\Auth;
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
                case 'authLogin':
                    $db = new Auth(require_once("config/config.php"));
                    new Response($db->read($request));
                    return;
                case 'authRegister':
                    $db = new Auth(require_once("config/config.php"));
                    new Response($db->create($request));
                    return;
                case 'authUpdate':
                    $db = new Auth(require_once("config/config.php"));
                    new Response($db->update($request));
                    return;
                case 'authDelete':
                    $db = new Auth(require_once("config/config.php"));
                    new Response($db->delete($request));
                    return;
            }

        }
        catch(PDOException $e)
        {
            throw new AppException('There was an error while trying to get data',500);
        }
    }
}