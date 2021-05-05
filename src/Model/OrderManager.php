<?php

namespace App\Model;

class OrderManager extends AbstractManager
{
    public const TABLE = "`order`";

    /**
     * Insert order in database
     */

    public function insert(array $order)
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE .
        " (title, lastname, firstname, email, address, zipcode, city, country, detail, status_id) 
        VALUES (:title, :lastname, :firstname, :email, :address, :zipcode, :city, :country, :detail, :status_id)");

        $statement->bindValue('title', $order['title'], \PDO::PARAM_STR);
        $statement->bindValue('lastname', $order['lastname'], \PDO::PARAM_STR);
        $statement->bindValue('firstname', $order['firstname'], \PDO::PARAM_STR);
        $statement->bindValue('email', $order['email'], \PDO::PARAM_STR);
        $statement->bindValue('address', $order['address'], \PDO::PARAM_STR);
        $statement->bindValue('zipcode', $order['zipcode'], \PDO::PARAM_INT);
        $statement->bindValue('city', $order['city'], \PDO::PARAM_STR);
        $statement->bindValue('country', $order['country'], \PDO::PARAM_STR);
        $statement->bindValue('detail', $order['detail'], \PDO::PARAM_STR);
        $statement->bindValue('status_id', '1', \PDO::PARAM_STR);
        return $statement->execute();
    }

    public function selectAllOrderStatus()
    {
        $query = 'SELECT o.*, s.name FROM' . static::TABLE . ' o JOIN '
        . StatusManager::TABLE  . ' s ON s.id = o.status_id';

        return $this->pdo->query($query)->fetchAll();
    }

    public function selectByIdOrder(int $id)
    {
        // prepared request

        $statement = $this->pdo->prepare('SELECT o.*, s.name FROM' . static::TABLE . ' o JOIN '
        . StatusManager::TABLE  . ' s ON s.id = o.status_id WHERE o.id=:id');
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch();
    }

    public function update(array $orderStatus): bool
    {
        $statement = $this->pdo->prepare("UPDATE " . self::TABLE . " SET status_id = :status_id WHERE id = :id");

        $statement->bindValue('id', $orderStatus['id'], \PDO::PARAM_INT);
        $statement->bindValue('status_id', $orderStatus['status_id'], \PDO::PARAM_INT);

        return $statement->execute();
    }
}
