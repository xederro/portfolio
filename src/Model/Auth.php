<?php

declare(strict_types=1);

namespace src\Model;

use PDO;
use src\Utils\Request;

class Auth extends AbstractModel implements InterfaceModel
{
    public function create(Request $request): array
    {
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

    public function read(Request $request): array
    {
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

    public function update(Request $request){
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

    public function delete(Request $request): array
    {
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

    public function auth(Request $request): bool
    {
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

    private function checkEmail(Request $request): bool
    {
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

}