<?php

namespace App\Model;

class OrderManager extends AbstractManager
{
    public const TABLE = 'order';

    /**
     * Insert order in database
     */

    public function insert(array $order)
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE .
        " (title, lastname, firstname, email, zipcode, city, country, created_at, category) 
        VALUES (:title, :lastname, :firstname, :email, :zipcode, :city, :country, :created_at, :category)");

        $statement->bindValue('title', $order['title'], \PDO::PARAM_STR);
        $statement->bindValue('lastname', $order['lastname'], \PDO::PARAM_STR);
        $statement->bindValue('firstname', $order['firstname'], \PDO::PARAM_STR);
        $statement->bindValue('email', $order['email'], \PDO::PARAM_STR);
        $statement->bindValue('zipcode', $order['zipcode'], \PDO::PARAM_INT);
        $statement->bindValue('city', $order['city'], \PDO::PARAM_STR);
        $statement->bindValue('country', $order['country'], \PDO::PARAM_STR);
        $statement->bindValue('created_at', $order['created_at'], \PDO::PARAM_STR);

        return $statement->execute();
    }
}