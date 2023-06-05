<?php


use model\User;

require_once 'BaseController.php';
require_once __DIR__.'/../model/User.php';
require_once __DIR__.'/../repository/ActivateRepository.php';
class ActivateController extends BaseController
{
    public function activate()
    {
        if ($this->isPost()) {
            $code = $_POST["code"];
            $email = $_POST["email"];

            $repository = new ActivateRepository();

            $user = $repository->userExists($email);

            if (!$user) {
                return $this->render('activate', ['messages'=>['User with this email not exists or account is activated!']]);
            }

            if ($user->getCode() == $code) {
                $repository->activate($email);
                return $this->render('activated_successfully');
            } else {
                return $this->render('activate', ['messages'=>['Bad verification code!']]);
            }
        }
        return $this->render('activate');

    }
}