<?php


use model\User;

require_once 'BaseController.php';
require_once __DIR__.'/../model/User.php';
require_once __DIR__.'/../repository/UserRepository.php';
class RegisterController extends BaseController
{
    public function register()
    {
        $userRepository = new UserRepository();

        if ($this->isPost()) {
            $email = $_POST["email"];
            $password = $_POST["password"];
            $userName = $_POST["user_name"];
            $surname = $_POST["surname"];
            $name = $_POST["name"];

            $user = new User(null, $email, $password, $name, $surname, $userName);

            if ($userRepository->userNameExists($user)) {
                return $this->render('register', ['messages'=>['User with this user name exists!']]);
            }
            if ($userRepository->userEmailExists($user)) {
                return $this->render('register', ['messages'=>['User with this email exists!']]);
            }

            $userRepository->saveUser($user);
            return $this->render('activate', ['messages'=>['Registered successfully!', 'Now confirm your email!']]);

        } else {
            return $this->render('register');
        }
    }
}