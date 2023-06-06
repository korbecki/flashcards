<?php


use model\User;

require_once 'BaseController.php';
require_once __DIR__.'/../model/User.php';
require_once __DIR__.'/../repository/UserRepository.php';
class AuthController extends BaseController
{
    public function login()
    {
        $userRepository = new UserRepository();

        if ($this->isPost()) {
            $email = $_POST["email"];
            $password = $_POST["password"];
            $user = $userRepository->getUser($email);

            if (!$user) {
                return $this->render('login', ['messages'=>['User with this email not exists!']]);
            }

            if ($user->getPassword() != $password) {
                return $this->render('login', ['messages'=>['Wrong password!']]);
            }

            if($user->get)

            setcookie("user", $user->getUserId(), time()+(86400 * 30), "/");
            $flashcardController = new FlashcardsController();
            return $flashcardController->flashcards();
        } else {
            return $this->render('login');
        }
    }
}