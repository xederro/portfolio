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

    public function __construct(array $get, array $post, array $server, array $cookie, array $session)
    {
        $this->get=$get;
        $this->post=$post;
        $this->server=$server;
        $this->cookie=$cookie;
        $this->session=$session;
    }

    public function hasPost(): bool
    {
        return !empty($this->post);
    }

    public function getParam(string $name, $default = null)
    {
        return $this->get[$name] ?? $default;
    }

    public function cookieParam(string $name, $default = null)
    {
        return $this->cookie[$name] ?? $default;
    }

    public function serverParam(string $name, $default = null)
    {
        return $this->server[$name] ?? $default;
    }

    public function sessionParam(string $name, $default = null)
    {
        return $this->session[$name] ?? $default;
    }

    public function postParam(string $name, $default = null)
    {
        return $this->post[$name] ?? $default;
    }

    public function isPost():bool
    {
        return $this->server["REQUEST_METHOD"] === 'POST';
    }

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