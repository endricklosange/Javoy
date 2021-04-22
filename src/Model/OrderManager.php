<?php

namespace App\Model;

class OrderManager extends AbstractManager
{
    public const TABLE = 'orders';

    /**
     * Insert order in database
     */

    public function insert(array $orders)
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE .
        " (title, lastname, firstname, email, address, zipcode, city, country, detail) 
        VALUES (:title, :lastname, :firstname, :email, :address, :zipcode, :city, :country, :detail)");

        $statement->bindValue('title', $orders['title'], \PDO::PARAM_STR);
        $statement->bindValue('lastname', $orders['lastname'], \PDO::PARAM_STR);
        $statement->bindValue('firstname', $orders['firstname'], \PDO::PARAM_STR);
        $statement->bindValue('email', $orders['email'], \PDO::PARAM_STR);
        $statement->bindValue('address', $orders['address'], \PDO::PARAM_STR);
        $statement->bindValue('zipcode', $orders['zipcode'], \PDO::PARAM_INT);
        $statement->bindValue('city', $orders['city'], \PDO::PARAM_STR);
        $statement->bindValue('country', $orders['country'], \PDO::PARAM_STR);
        $statement->bindValue('detail', $orders['detail'], \PDO::PARAM_STR);

        return $statement->execute();
    }
}
