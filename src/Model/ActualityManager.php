<?php

namespace App\Model;

use DateTime;

class ActualityManager extends AbstractManager
{
    public const TABLE = 'actuality';
    public function insert(array $actuality): void
    {
        $date = new DateTime();
        $currentDate = $date->format('Y-m-d H:i:s');
        $query = "INSERT INTO " . self::TABLE . " (`name`, `description`,`image`,`created_at`)
        VALUES (:name, :description,:image,'" . $currentDate . "')";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue('name', $actuality['name'], \PDO::PARAM_STR);
        $statement->bindValue('description', $actuality['description'], \PDO::PARAM_STR);
        $statement->bindValue('image', $actuality['image'], \PDO::PARAM_STR);
        $statement->execute();
    }
    public function update(array $actuality): void
    {
        $query = "UPDATE " . self::TABLE . " SET `name`=:name, `description`=:description, `image`=:image
                  WHERE id=:id ";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue('name', $actuality['name'], \PDO::PARAM_STR);
        $statement->bindValue('description', $actuality['description'], \PDO::PARAM_STR);
        $statement->bindValue('image', $actuality['image'], \PDO::PARAM_STR);
        $statement->bindValue('id', $actuality['id'], \PDO::PARAM_INT);
        $statement->execute();
    }
}
