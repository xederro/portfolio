<?php

declare(strict_types=1);

namespace src\Utils;

class Request
{
    private array $get = [];
    private array $post = [];
    private array $server = [];

    public function __construct(array $get, array $post, array $server)
    {
        $this->get=$get;
        $this->post=$post;
        $this->server=$server;
    }

    public function hasPost(): bool
    {
        return !empty($this->post);
    }

    public function getParam(string $name, $default = null)
    {
        return $this->get[$name] ?? $default;
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
        return $this->escape([
            'get' => $this->get,
            'post' => $this->post,
            'server' => $this->server
        ]);
    }

    private function escape(array $params): array
    {
        $clearParams = [];

        foreach($params as $key => $param){
            switch(true){
                case is_array($param):
                    $clearParams[$key] = $this->escape($param);
                    break;
                case is_int($param) || is_float($param):
                    $clearParams[$key] = $param;
                    break;
                case $param:
                    $clearParams[$key] = htmlentities($param);
                    break;
                default:
                    $clearParams[$key] = $param;
                    break;

            }
        }
        return $clearParams;
    }
}