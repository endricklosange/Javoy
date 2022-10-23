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
}
