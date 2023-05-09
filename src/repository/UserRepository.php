<?php

use model\User;

require_once 'Repository.php';
require_once __DIR__.'/../model/User.php';
class UserRepository extends Repository
{
    public function getUser(string $email): ?User
    {
        $statement = $this->database->connect()->prepare('SELECT * FROM system_user WHERE email = :email');

        $statement->bindParam(':email', $email);
        $statement->execute();

        $user = $statement->fetch(PDO::FETCH_ASSOC);

        if ($user == false) {
            return null;
        }

        return new User($user['email'], $user['password'], $user['name'], $user['surname']);
    }
}