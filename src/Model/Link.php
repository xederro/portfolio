<?php
declare(strict_types=1);

namespace src\Model;

use PDO;
use src\Controller\AuthController;
use src\Exception\StorageException;
use src\Utils\Request;

class Link extends AbstractModel
{

    /**
     * @param Request $request
     * @return array
     * @throws StorageException
     */
    public function create(Request $request): array{
        try {
            if($this->isInused($request->postParam('short'))){
                $query = "INSERT INTO link VALUES ('". $request->postParam('short') ."','". $request->postParam('long') ."','". $request->sessionParam('user')['id'] ."');";
                return $this->dbConnection->query($query)->fetchAll(PDO::FETCH_ASSOC);
            }
            else{
                return ['error'=>'link'];
            }
        }
        catch (\Exception $e){
            throw new StorageException('There was a problem while trying to add Link data ' . $e);
        }
    }

    /**
     * reads link data from database
     *
     * @param string $user_id
     * @return array
     * @throws StorageException
     */
    public function read(string $user_id): array
    {
        try {
            $query = "SELECT * FROM link WHERE user_id = '$user_id' ORDER BY id";

            return $this->dbConnection->query($query)->fetchAll(PDO::FETCH_ASSOC);
        }
        catch (\Exception $e){
            throw new StorageException('There was a problem while trying to get Link data ' . $e);
        }
    }

    /**
     * reads link data from database
     *
     * @param string $id
     * @return array
     * @throws StorageException
     */
    public function readOne(string $id): array
    {
        try {
            $query = "SELECT `long` FROM link WHERE id = '$id'";

            return $this->dbConnection->query($query)->fetchAll(PDO::FETCH_ASSOC);
        }
        catch (\Exception $e){
            throw new StorageException('There was a problem while trying to get Link data ' . $e);
        }
    }

    /**
     * @param Request $request
     * @return array
     */
    public function update(Request $request): array{
        return [];
    }

    /**
     * @param Request $request
     * @return array
     */
    public function delete(Request $request): array{
        try {
            $link = $request->postParam('link');

            if($link){
                $query = "DELETE FROM link WHERE id = '$link'";
                return $this->dbConnection->query($query)->fetchAll(PDO::FETCH_ASSOC);
            }

            return ['error' => 'auth'];
        }
        catch (\Exception $e){
            throw new StorageException('There was a problem while trying to remove Link data ' . $e);
        }
    }

    /**
     * @param string $short
     * @return boolean
     * @throws StorageException
     */
    public function isInused(string $short): bool{
        try {
            return $this->dbConnection->query("SELECT id FROM link WHERE id = '$short'")->fetchAll(PDO::FETCH_ASSOC) == [];
        }
        catch (\Exception $e){
            throw new StorageException('There was a problem while trying to check if link already exist ' . $e);
        }

    }
}