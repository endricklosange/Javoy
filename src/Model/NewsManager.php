<?php

namespace App\Model;

class NewsManager extends AbstractManager
{
    public const TABLE = 'actuality';

    public function insert(array $news): void
    {
        $query = "INSERT INTO" . self::TABLE . " (`name`,`description`,`image`) 
        VALUES (:name, :description, :image)";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue('name', $news['name'], \PDO::PARAM_STR);
        $statement->bindValue('description', $news['description'], \PDO::PARAM_STR);
        $statement->bindValue('image', $news['image'], \PDO::PARAM_STR);

        $statement->execute();
    }
}
