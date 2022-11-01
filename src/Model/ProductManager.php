<?php

namespace App\Model;

class ProductManager extends AbstractManager
{
    public const TABLE = 'product';

    public function selectAllWithCategory()
    {
        $query = 'SELECT p.*, c.name AS category_name  FROM ' . self::TABLE . ' p
                  JOIN ' . CategoryManager::TABLE . ' c ON c.id = p.category_id';

        return $this->pdo->query($query)->fetchAll();
    }
    public function selectByIdWithCategory(int $id)
    {
        $statement = $this->pdo->prepare('SELECT product.*,category.name  AS category_name FROM `' .
        self::TABLE . '`JOIN ' . CategoryManager::TABLE .
        ' category ON category.id = product.category_id WHERE product.id= :id');
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch();
    }
    public function selectByIdCategory(int $id)
    {
        $statement = $this->pdo->prepare('SELECT p.*, c.name AS category_name FROM ' . self::TABLE . ' p JOIN '
            . CategoryManager::TABLE  . ' c ON c.id = p.category_id WHERE category_id = :id');
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll();
    }



    /**
     * Insert new item in database
     */

    public function insert(array $product)
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE .
            " (name, price, description, year, image, category_id) 
        VALUES (:name, :price, :description, :year, :image, :category)");

        $statement->bindValue('name', $product['name'], \PDO::PARAM_STR);
        $statement->bindValue('price', $product['price'], \PDO::PARAM_STR);
        $statement->bindValue('description', $product['description'], \PDO::PARAM_STR);
        $statement->bindValue('year', $product['year'], \PDO::PARAM_INT);
        $statement->bindValue('image', $product['image'], \PDO::PARAM_STR);
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
                    `category_id` = :category
                WHERE id=:id "
        );

        $statement->bindValue('name', $product['name'], \PDO::PARAM_STR);
        $statement->bindValue('price', $product['price'], \PDO::PARAM_STR);
        $statement->bindValue('description', $product['description'], \PDO::PARAM_STR);
        $statement->bindValue('year', $product['year'], \PDO::PARAM_INT);
        $statement->bindValue('image', $product['image'], \PDO::PARAM_STR);
        $statement->bindValue('category', $product['category'], \PDO::PARAM_STR);
        $statement->bindValue('id', $product['id'], \PDO::PARAM_INT);

        $statement->execute();
    }
}
