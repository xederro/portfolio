<?php


namespace src\Model;


use PDO;

abstract class AbstractModel
{
    protected PDO $dbConnection;

    public final function __construct($data)
    {
        $data = $data['db'];
        $this->dbConnection = new PDO("{$data['driver']}:host={$data['host']};dbname={$data['database']}", "{$data['user']}", "{$data['password']}");
    }
}