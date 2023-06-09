<?php

use model\User;
use dto\UserActivateDto;

require_once 'Repository.php';
require_once __DIR__.'/../model/User.php';
require_once __DIR__.'/../dto/UserActivateDto.php';
class UserRepository extends Repository
{
    public function getUser(string $email): ?User
    {
        $statement = $this->database->connect()->prepare('SELECT * FROM system_user WHERE email = :email');

        $statement->bindParam(':email', $email);
        $statement->execute();

        $user = $statement->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            return null;
        }

        return new User($user['user_id'], $user['email'], $user['password'], $user['name'], $user['surname'], $user['user_name']);
    }

    public function getUserActivateDto(string $email): ?UserActivateDto
    {
        $statement = $this->database->connect()->prepare('SELECT * FROM v_system_user WHERE email = :email');

        $statement->bindParam(':email', $email);
        $statement->execute();

        $user = $statement->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            return null;
        }

        return new UserActivateDto($user['user_id'], $user['email'], $user['password'], $user['name'], $user['surname'], $user['user_name'], $user['is_activated']);
    }

    public function saveUser(User $user)
    {
        $statement = $this->database->connect()->prepare('
            INSERT INTO system_user(name, surname, user_name, password, email) VALUES(?, ?, ?, ?, ?)');
        $statement->execute([$user->getName(), $user->getSurname(), $user->getUserName(), md5($user->getPassword()), $user->getEmail()]);
    }

    public function userNameExists(User $user): bool
    {
        $statement = $this->database->connect()->prepare('
            SELECT * FROM system_user WHERE user_name = :userName');
        $userName = $user->getUserName();
        $statement->bindParam(':userName', $userName);

        $statement->execute();

        $user = $statement->fetch(PDO::FETCH_ASSOC);

        return !($user == false);
    }
    public function userEmailExists(User $user): bool
    {
        $statement = $this->database->connect()->prepare('
            SELECT * FROM system_user WHERE email = :email');
        $email = $user->getEmail();
        $userName = $user->getUserName();
        $statement->bindParam(':email', $email);

        $statement->execute();

        $user = $statement->fetch(PDO::FETCH_ASSOC);

        return !($user == false);
    }
}