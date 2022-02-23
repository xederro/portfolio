<?php
declare(strict_types=1);

namespace src\Controller;


use mysql_xdevapi\Exception;
use PDOException;
use src\Exception\AppException;
use src\Exception\ConfigurationException;
use src\Exception\NotFoundException;
use src\Exception\StorageException;
use src\Model\Link;
use src\Model\User;
use src\Model\Weather;
use src\Utils\Request;
use src\Utils\Response;
use src\View;
use Google\GTrends;

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
            'contact' => "contact",
            'weather' => "weather",
            'chat' => "chat",
            'geo' => "geo",
            'trends' => "trends",
            'short' => "short",
            'deleteShort' => "deleteShort",
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
        switch ($page){
            case 'short':
                if(!empty($request->getParam('id'))){
                    $db = new Link(require_once("config/config.php"));
                    $output = $db->readOne($request->getParam('id'));
                    if ($output != []){
                        $long = $output[0]['long'];
                        header("Location: $long");
                    }
                    else{
                        header("Location: /Error/404");
                    }
                }
                elseif(empty($request->sessionParam('user')['id'])){
                    header("Location: /Login");
                }
                else{
                    $db = new Link(require_once("config/config.php"));
                    $this->view->render($page, $request->getData(), ['links' => $db->read($request->sessionParam('user')['id'])]);
                }
                break;
            case 'geo':
                if(!empty($request->getParam("ip"))){
                    $geo = json_decode(file_get_contents("http://ip-api.com/json/{$_GET["ip"]}?fields=status,country,city,lat,lon,query"));
                }
                else{
                    $geo = json_decode(file_get_contents("http://ip-api.com/json/{$_SERVER['REMOTE_ADDR']}?fields=status,country,city,lat,lon,query"));
                }
                $this->view->render($page, $request->getData(), ['geo' => $geo]);
                break;
            case 'trends':

                /**
                 * @throws AppException
                 */

                $options = [
                    'hl' => 'en-US',
                    'tz' => 360,
                    'geo' => 'US',
                ];
                try {
                    $gt = new GTrends($options);
                    $this->view->render($page, $request->getData(), ['trends' => $gt->getDailySearchTrends()['default']['trendingSearchesDays']]);
                }
                catch (\Exception $e) {
                    throw new AppException("There was an error while trying to show trends " . $e, 408);
                }
                break;
            default:
                $this->view->render($page, $request->getData());
                break;

        }

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
                case 'contact':
                    try {
                        mail("xederro@gmail.com","Contact Form " . $request->postParam('name') . " Mail: " . $request->postParam('email'), $request->postParam('message'), ['From'=>'admin@dawid.j.pl','Reply-To'=>$request->postParam('email'), 'Content-type'=>'text/html', 'charset'=>'utf-8']);
                        new Response([]);
                    }
                    catch (\Exception $e){
                        new Response(['server'=>$e]);
                    }
                    return;
                case 'weather':
                    $db = new Weather(require_once("config/config.php"));
                    new Response($db->read($request));
                    return;
                case 'short':
                    $db = new Link(require_once("config/config.php"));
                    new Response($db->create($request));
                    return;
                case 'deleteShort':
                    $auth = new AuthController(new User(require("config/config.php")));
                    if ($auth->auth($request)){
                        $db = new Link(require("config/config.php"));
                        new Response($db->delete($request));
                    }
                    else{
                        new Response(['error' => 'auth']);
                    }
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