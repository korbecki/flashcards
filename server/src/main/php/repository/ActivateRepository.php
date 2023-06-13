<?php



require_once 'Repository.php';
require_once __DIR__ . '/../dto/UserDto.php';

class ActivateRepository extends Repository
{
    public function userExists($email): ?UserDto
    {
        $sql = 'SELECT user_id, name, surname, user_name, password, email, a.code FROM system_user
                    INNER JOIN activate a on a.activate_id = system_user.activate_id
                    WHERE email = :email AND a.is_activated = false;';
        $statement = $this->database->connect()->prepare($sql);

        $statement->bindParam(':email', $email);
        $statement->execute();
        $user = $statement->fetch(PDO::FETCH_ASSOC);

        if (!$user)
            return null;

        return new UserDto($user['user_id'], $user['email'], $user['password'], $user['name'], $user['surname'], $user['user_name'], $user['code']);
    }

    public function activate($email)
    {
        $sql = "UPDATE activate SET is_activated = true WHERE activate_id = (SELECT activate_id FROM system_user WHERE email = :email LIMIT 1)";
        $statement = $this->database->connect()->prepare($sql);
        $statement->bindParam(':email', $email);
        $statement->execute();
    }

    public function sendEmail($email)
    {
        $sql = "UPDATE activate SET status = 'NEW' WHERE activate_id = (SELECT activate_id FROM system_user WHERE email = :email LIMIT 1)";
        $statement = $this->database->connect()->prepare($sql);
        $statement->bindParam(':email', $email);
        $statement->execute();
    }

}