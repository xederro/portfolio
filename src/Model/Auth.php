<?php

declare(strict_types=1);

namespace src\Model;

use PDO;
use src\Exception\StorageException;
use src\Utils\Request;

class Auth extends AbstractModel implements InterfaceModel
{
    /**
     * creates new user in database / register
     *
     * @param Request $request
     * @return array
     * @throws StorageException
     */
    public function create(Request $request): array
    {
        try {
            if($request->isPost() && $request->hasPost() && $this->checkEmail($request)){
                $password = password_hash($request->postParam('password'), PASSWORD_DEFAULT);
                $query = "INSERT INTO users VALUES (null, '{$request->postParam('name')}', '{$request->postParam('email')}', '$password')";

                if($this->dbConnection->query($query)){
                    $this->read($request);
                    return [];
                }
                else {
                    return ['error' => 'server'];
                }
            }
            else{
                return ['error' => 'email'];
            }
        }
        catch (\Exception $e){
            throw new StorageException('There was a problem while trying to create new user', 500);
        }
    }

    /**
     * reads user from database / login
     *
     * @param Request $request
     * @return string[]
     * @throws StorageException
     */
    public function read(Request $request): array
    {
        try {
            if($request->isPost() && $request->hasPost() && $this->auth($request)){
                $query = "SELECT `id`, `name`, `email` FROM users WHERE `email` = '{$request->postParam('email')}'";
                $user = $this->dbConnection->query($query)->fetchAll(PDO::FETCH_ASSOC)[0];

                $_SESSION['user']['id'] = $user['id'];
                $_SESSION['user']['name'] = $user['name'];
                $_SESSION['user']['email'] = $user['email'];

                return $user;
            }
            else{
                return ['error'=>'pass'];
            }
        }
        catch (\Exception $e){
            throw new StorageException('There was a problem while trying to get user', 500);
        }
    }

    /**
     * updates user in database / edit
     *
     * @param Request $request
     * @return array
     * @throws StorageException
     */
    public function update(Request $request): array
    {
        try {
            if($request->isPost() && $request->hasPost() && $this->auth($request) && (!empty($request->postParam('name')) || !empty($request->postParam('npassword')))){
                $query = "UPDATE users SET ";
                if (!empty($request->postParam('name'))){
                    $query .= "name = '{$request->postParam('name')}' ";
                }
                if (!empty($request->postParam('npassword'))){
                    $password = password_hash($request->postParam('npassword'), PASSWORD_DEFAULT);
                    $query .= "password = '{$password}' ";
                }
                $query .= "WHERE id = {$request->sessionParam('user')['id']}";

                if($this->dbConnection->query($query)->fetchAll(PDO::FETCH_ASSOC) == []){
                    $_SESSION['user']['id'] = $request->sessionParam('user')['id'];
                    $_SESSION['user']['name'] = !empty($request->postParam('name')) ? $request->postParam('name') : $request->sessionParam('user')['name'];
                    return [];
                }
                else {
                    return ['error' => 'server'];
                }

            }
            else{
                return ['error' => 'pass'];
            }
        }
        catch (\Exception $e){
            throw new StorageException('There was a problem while trying to update user', 500);
        }
    }

    /**
     * deletes new user in database
     *
     * @param Request $request
     * @return array
     * @throws StorageException
     */
    public function delete(Request $request): array
    {
        try {
            if($request->isPost() && $request->hasPost() && $this->auth($request)){
                $query = "DELETE FROM `users` WHERE `id` = '{$request->sessionParam('user')['id']}'";
                if ($this->dbConnection->query($query)->fetchAll(PDO::FETCH_ASSOC) == []){
                    session_unset();
                    session_destroy();
                    return [];
                }
                else{
                    return ['error'=>'server'];
                }
            }
            else{
                return ['error'=>'pass'];
            }
        }
        catch (\Exception $e){
            throw new StorageException('There was a problem while trying to delete user', 500);
        }
    }

    /**
     * checks if password provided by user match one in database
     *
     * @param Request $request
     * @return bool
     * @throws StorageException
     */
    public function auth(Request $request): bool
    {
        try {
            if($request->isPost() && $request->hasPost()){
                $email = empty($request->postParam('email')) ? $request->sessionParam('user')['email'] : $request->postParam('email');
                $query = "SELECT `password` FROM users WHERE `email` = '$email'";
                $password = $this->dbConnection->query($query)->fetchAll(PDO::FETCH_ASSOC);
                if ($password == []){
                    return false;
                }
                else{
                    $password = $password[0]['password'];
                    return password_verify($request->postParam('password'), $password);
                }
            }
            else{
                return false;
            }
        }
        catch (\Exception $e){
            throw new StorageException('There was a problem while trying to check password of user', 500);
        }
    }

    /**
     * checks if email is already used in database
     *
     * @param Request $request
     * @return bool
     * @throws StorageException
     */
    private function checkEmail(Request $request): bool
    {
        try {
            if($request->isPost() && $request->hasPost()){
                $query = "SELECT `id` FROM users WHERE `email` = '{$request->postParam('email')}'";
                if($this->dbConnection->query($query)->fetchAll(PDO::FETCH_ASSOC) == []){
                    return true;
                }
                else return false;
            }
            else{
                return false;
            }
        }
        catch (\Exception $e){
            throw new StorageException('There was a problem while trying to check email of user', 500);
        }
    }

}