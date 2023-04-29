<?php


use model\User;

require_once 'BaseController.php';
require_once __DIR__.'/../model/User.php';
class AuthController extends BaseController
{
    public function login()
    {
        $user = new User("user@email.pl", "admin", "Adam", "Małysz");

        if ($this->isPost()) {
            $email = $_POST["email"];
            $password = $_POST["password"];

            if ($user->getEmail() != $email) {
                return $this->render('login', ['messages'=>['User with this email not exists!']]);
            }
            if ($user->getPassword() != $password) {
                return $this->render('login', ['messages'=>['Wrong password!']]);
            }

            return $this->render('flashcards');
        } else {
            return $this->render('login');
        }
    }
}