<?php

declare(strict_types=1);

namespace src\Controller;

use Ramsey\Uuid\Uuid;
use src\Exception\StorageException;
use src\Model\User;
use src\Utils\Request;

class AuthController
{

    private User $user;

    public function __construct(User $user){
        $this->user = $user;
    }

    /**
     * creates new user in database / register
     *
     * @param Request $request
     * @return array
     * @throws StorageException
     */
    public function add(Request $request): array
    {

        try {
            if($request->isPost() && $request->hasPost() && $this->checkEmail($request)){
                $password = password_hash($request->postParam('password'), PASSWORD_DEFAULT);
                $id = Uuid::fromDateTime(new \DateTime());
                $query = "INSERT INTO users VALUES ('$id', '{$request->postParam('name')}', '{$request->postParam('email')}', '$password', null)";

                $dbOutput = $this->user->create($request, $query);

                if($dbOutput === []){
                    $this->login($request);
                    return $dbOutput;
                }
                else{
                    return $dbOutput;
                }
            }
            else{
                return ['error' => 'email'];
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
    public function login(Request $request): array
    {
        try {
            if($request->isPost() && $request->hasPost() && $this->auth($request)){
                $query = "SELECT `id`, `name`, `email` FROM users WHERE `email` = '{$request->postParam('email')}'";
                $user = ($this->user->read($request, $query))[0];

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
    public function edit(Request $request): array
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
                $query .= "WHERE id = '{$request->sessionParam('user')['id']}'";

                $dbOutput = $this->user->update($request, $query);

                if($dbOutput == []){
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
    public function remove(Request $request): array
    {
        try {
            if($request->isPost() && $request->hasPost() && $this->auth($request)){
                $query = "DELETE FROM `users` WHERE `id` = '{$request->sessionParam('user')['id']}'";

                $dbOutput = $this->user->delete();

                if ($dbOutput == []){
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
            throw new StorageException('There was a problem while trying to delete user ' . $e, 500);
        }
    }

    /**
     * @param Request $request
     * @return array
     * @throws StorageException
     */
    public function reset(Request $request): array
    {
        try {
            if(!empty($request->getParam('token'))){
                $token = json_decode(base64_decode($request->getParam('token')));

                $query = "SELECT `reset` FROM users WHERE `email` = '{$token->email}'";
                $row = $this->user->read($request, $query);
                if($row != []){
                    $reset = json_decode(base64_decode($row[0]['reset']));
                    if ($reset==$token && $token->date >= time()){
                        $password = bin2hex(random_bytes(14));

                        $hash = password_hash($password, PASSWORD_DEFAULT);
                        $query = "UPDATE `users` SET `password` = '$hash', `reset` = null WHERE email = '$token->email'";

                        $dbOutput = $this->user->read($request, $query);

                        if($dbOutput == []){
                            mail("$token->email","New Password", require_once('templates/pages/mail/reset.php'), ['From'=>'admin@dawid.j.pl','Reply-To'=>'admin@dawid.j.pl', 'Content-type'=>'text/html', 'charset'=>'utf-8'],'-fadmin@dawid.j.pl');
                            return [];
                        }
                        else {
                            return ['error' => 'server'];
                        }
                    }
                    else {
                        return ['error' => 'token'];
                    }
                }
                else {
                    return ['error' => 'server'];
                }
            }
            else {
                return ['error' => 'token'];
            }
        }
        catch (\Exception $e){
            throw new StorageException('There was a problem while trying to reset users password ' . $e, 500);
        }
    }

    /**
     * @param Request $request
     * @return array
     * @throws StorageException
     */
    public function forget(Request $request): array
    {
        try {
            if($request->isPost() && $request->hasPost() && !$this->checkEmail($request)){
                $data = base64_encode(json_encode([
                    'date'=> time()+900,
                    'email'=>$request->postParam('email'),
                ]));

                $query = "UPDATE `users` SET `reset` = '$data' WHERE `email` = '{$request->postParam('email')}'";

                $dbOutput = $this->user->read($request, $query);

                if($dbOutput == []){
                    mail($request->postParam('email'),"Reset Password", require_once('templates/pages/mail/forget.php'), ['From'=>'admin@dawid.j.pl','Reply-To'=>'admin@dawid.j.pl', 'Content-type'=>'text/html', 'charset'=>'utf-8'],'-fadmin@dawid.j.pl');
                    //send email with link and token
                    return [];
                }
                else {
                    return ['error' => 'server'];
                }
            }
            else return ['error'=>'email'];
        }
        catch (\Exception $e){
            throw new StorageException('There was a problem while trying to reset users password ' . $e, 500);
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
                $password = $this->user->read($request, $query);
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
            throw new StorageException('There was a problem while trying to check password of user ' . $e, 500);
        }
    }

    /**
     * checks if email isn't already used in database
     *
     * @param Request $request
     * @return bool
     * @throws StorageException
     */
    private function checkEmail(Request $request): bool
    {
        try {
            if($request->isPost() && $request->hasPost()){
                $query = "SELECT `email` FROM users WHERE `email` = '{$request->postParam('email')}'";
                $dbOutput = $this->user->read($request, $query);
                if($dbOutput == []){
                    return true;
                }
                else return false;
            }
            else{
                return false;
            }
        }
        catch (\Exception $e){
            throw new StorageException('There was a problem while trying to check email of user ' . $e, 500);
        }
    }

}