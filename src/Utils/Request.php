<?php

declare(strict_types=1);

namespace src\Utils;

class Request
{
    private array $get = [];
    private array $post = [];
    private array $server = [];
    private array $cookie = [];
    private array $session = [];

    /**
     * creates arrays from request data
     *
     * @param array $get
     * @param array $post
     * @param array $server
     * @param array $cookie
     * @param array $session
     */
    public function __construct(array $get, array $post, array $server, array $cookie, array $session)
    {
        $this->get=$get;
        $this->post=$post;
        $this->server=$server;
        $this->cookie=$cookie;
        $this->session=$session;
    }

    /**
     * check if request has post
     *
     * @return bool
     */
    public function hasPost(): bool
    {
        return !empty($this->post);
    }

    /**
     * gets params from get array
     *
     * @param string $name
     * @param null $default
     * @return mixed|null
     */
    public function getParam(string $name, $default = null)
    {
        return $this->get[$name] ?? $default;
    }

    /**
     * gets params from session array
     *
     * @param string $name
     * @param null $default
     * @return mixed|null
     */
    public function sessionParam(string $name, $default = null)
    {
        return $this->session[$name] ?? $default;
    }

    /**
     * gets params from post array
     *
     * @param string $name
     * @param null $default
     * @return mixed|null
     */
    public function postParam(string $name, $default = null)
    {
        return $this->post[$name] ?? $default;
    }

    /**
     * checks if method is post
     *
     * @return bool
     */
    public function isPost():bool
    {
        return $this->server["REQUEST_METHOD"] === 'POST';
    }

    /**
     * gets all request data
     *
     * @return array
     */
    public function getData(): array
    {
        return escape([
            'get' => $this->get,
            'post' => $this->post,
            'server' => $this->server,
            'cookie' => $this->cookie,
            'session' => $this->session
        ]);
    }
}