<?php

namespace App\Model;

class ProductManager extends AbstractManager
{
    public const TABLE = 'product';

    /**
     * Insert new item in database
     */

    public function insert(array $products)
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE .
        " (name, price, description, year, image, created_at, category) 
        VALUES (:name, :price, :description, :year, :image, :created_at, :category)");

        $statement->bindValue('name', $products['name'], \PDO::PARAM_STR);
        $statement->bindValue('price', $products['price'], \PDO::PARAM_INT);
        $statement->bindValue('description', $products['description'], \PDO::PARAM_STR);
        $statement->bindValue('year', $products['year'], \PDO::PARAM_INT);
        $statement->bindValue('image', $products['image'], \PDO::PARAM_STR);
        $statement->bindValue('created_at', $products['created_at'], \PDO::PARAM_STR);
        $statement->bindValue('category', $products['category'], \PDO::PARAM_STR);

        return $statement->execute();
    }
}
