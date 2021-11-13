<?php


namespace src\Model;


use PDO;
use src\Exception\ConfigurationException;

abstract class AbstractModel
{
    protected PDO $dbConnection;


    /**
     * creates new pdo connection with database
     *
     * @param $data
     * @throws ConfigurationException
     */
    public final function __construct($data)
    {
        try {
            $data = $data['db'];
            $this->dbConnection = new PDO("{$data['driver']}:host={$data['host']};dbname={$data['database']}", "{$data['user']}", "{$data['password']}");
        }
        catch (\Exception $e){
            throw new ConfigurationException('There was an error with database', 500);
        }
    }
}