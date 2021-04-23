<?php

namespace App\Model;

class ProductManager extends AbstractManager
{
    public const TABLE = 'product';

    /**
     * Insert new item in database
     */

    public function insert(array $product)
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE .
        " (name, price, description, year, image, created_at, category) 
        VALUES (:name, :price, :description, :year, :image, :created_at, :category)");

        $statement->bindValue('name', $product['name'], \PDO::PARAM_STR);
        $statement->bindValue('price', $product['price'], \PDO::PARAM_INT);
        $statement->bindValue('description', $product['description'], \PDO::PARAM_STR);
        $statement->bindValue('year', $product['year'], \PDO::PARAM_INT);
        $statement->bindValue('image', $product['image'], \PDO::PARAM_STR);
        $statement->bindValue('created_at', $product['created_at'], \PDO::PARAM_STR);
        $statement->bindValue('category', $product['category'], \PDO::PARAM_STR);

        return $statement->execute();
    }

    /**
     * Update item in database
     */
    public function update(array $product): void
    {
        $statement = $this->pdo->prepare(
            "UPDATE " . self::TABLE .
                " SET
                    `name` = :name,
                    `price` = :price, 
                    `description` = :description,
                    `year` = :year,
                    `image` = :image,
                    `created_at` = :created_at,
                    `category` = :category
                WHERE id=:id "
        );

        $statement->bindValue('name', $product['name'], \PDO::PARAM_STR);
        $statement->bindValue('price', $product['price'], \PDO::PARAM_INT);
        $statement->bindValue('description', $product['description'], \PDO::PARAM_STR);
        $statement->bindValue('year', $product['year'], \PDO::PARAM_INT);
        $statement->bindValue('image', $product['image'], \PDO::PARAM_STR);
        $statement->bindValue('created_at', $product['created_at'], \PDO::PARAM_STR);
        $statement->bindValue('category', $product['category'], \PDO::PARAM_STR);
        $statement->bindValue('id', $product['id'], \PDO::PARAM_INT);

        $statement->execute();
    }
}
