<?php


require_once 'BaseController.php';
require_once __DIR__ . '/../model/User.php';
require_once __DIR__ . '/../dto/UserActivateDto.php';
require_once __DIR__ . '/../repository/UserRepository.php';

class AuthController extends BaseController
{
    public function logout()
    {
        unset($_COOKIE['user']);
        setcookie('user', '', time() - 3600);
        return $this->login();
    }

    public function login()
    {
        $userRepository = new UserRepository();

        if ($this->isPost()) {
            $email = $_POST["email"];
            $password = $_POST["password"];
            $user = $userRepository->getUserActivateDto($email);

            if (!$user) {
                return $this->render('login', ['messages' => ['User with this email not exists!']]);
            }

            if ($user->getPassword() != md5($password)) {
                return $this->render('login', ['messages' => ['Wrong password!']]);
            }

            if (!$user->getIsActivated()) {
                return $this->render('activate', ['messages' => ['Activate user account!']]);
            }

            setcookie("user", $user->getUserId(), time() + (86400 * 30), "/");
            $flashcardController = new FlashcardsController();
            return $flashcardController->flashcards();
        } else {
            return $this->render('login');
        }
    }
}