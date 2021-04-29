<?php

namespace App\Model;

class ActualityManager extends AbstractManager
{
    public const TABLE = 'actuality';
    public function insert(array $actuality): void
    {
        $query = "INSERT INTO " . self::TABLE . " (`name`, `description`, `article`,`image`,`created_at`)
        VALUES (:name, :description, :article, :image, :created_at)";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue('name', $actuality['name'], \PDO::PARAM_STR);
        $statement->bindValue('description', $actuality['description'], \PDO::PARAM_STR);
        $statement->bindValue('article', $actuality['article'], \PDO::PARAM_STR);
        $statement->bindValue('image', $actuality['image'], \PDO::PARAM_STR);
        $statement->bindValue('created_at', $actuality['created_at'], \PDO::PARAM_STR);
        $statement->execute();
    }
}
