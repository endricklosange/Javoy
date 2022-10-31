<?php

namespace App\Model;

class UserManager extends AbstractManager
{
    public const TABLE = 'user';

    public function selectUserEmail(string $email): array
    {
        $query = 'SELECT * FROM ' . static::TABLE . " WHERE email ='" . $email . "'";

        return $this->pdo->query($query)->fetchAll();
    }
    public function insert($email, $password)
    {
        $statement = $this->pdo->prepare("INSERT INTO `" . self::TABLE .
            "` ( `email`, `password`) VALUES (:email,'" . $password . "')");
        $statement->bindValue('email', $email, \PDO::PARAM_STR);
        return $statement->execute();
    }
}
