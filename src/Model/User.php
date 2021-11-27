<?php

declare(strict_types=1);

namespace src\Model;

use PDO;
use Ramsey\Uuid\Uuid;
use src\Exception\StorageException;
use src\Utils\Request;

class User extends AbstractModel implements InterfaceModel
{
    /**
     * creates new user in database / register
     *
     * @param Request $request
     * @return array
     * @throws StorageException
     */
    public function create(Request $request, string $query): array
    {

        try {
            if($this->dbConnection->query($query)){
                return [];
            }
            else {
                return ['error' => 'server'];
            }
        }
        catch (\Exception $e){
            throw new StorageException('There was a problem while trying to create new user ' . $e, 500);
        }
    }

    /**
     * reads user from database / login
     *
     * @param Request $request
     * @return string[]
     * @throws StorageException
     */
    public function read(Request $request, string $query): array
    {
        try {
             return $this->dbConnection->query($query)->fetchAll(PDO::FETCH_ASSOC);
        }
        catch (\Exception $e){
            throw new StorageException('There was a problem while trying to get user ' . $e, 500);
        }
    }

    /**
     * updates user in database / edit
     *
     * @param Request $request
     * @return array
     * @throws StorageException
     */
    public function update(Request $request, string $query): array
    {
        try {
            return $this->dbConnection->query($query)->fetchAll(PDO::FETCH_ASSOC);
        }
        catch (\Exception $e){
            throw new StorageException('There was a problem while trying to update user ' . $e, 500);
        }
    }

    /**
     * deletes new user in database
     *
     * @param Request $request
     * @return array
     * @throws StorageException
     */
    public function delete(Request $request, string $query): array
    {
        try {
            return $this->dbConnection->query($query)->fetchAll(PDO::FETCH_ASSOC);
        }
        catch (\Exception $e){
            throw new StorageException('There was a problem while trying to delete user ' . $e, 500);
        }
    }
}