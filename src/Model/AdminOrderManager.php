<?php

namespace App\Model;

class AdminOrderManager extends AbstractManager
{
    public const TABLE = '`order`';

    public function selectAllOrderStatus()
    {
        $query = 'SELECT'  .  static::TABLE . '.id, '  .  static::TABLE . '.title,'
        .  static::TABLE  .  '.firstname,'  .  static::TABLE  .  '.lastname,'
        .  static::TABLE  .  '.email,'  .  static::TABLE  .  '.address,'
        .  static::TABLE  .  '.zipcode,'  .  static::TABLE  .  '.city,'
        .  static::TABLE  .  '.detail,' . StatusManager::TABLE  .  '.name FROM '
        .  static::TABLE  .  ' JOIN ' . StatusManager::TABLE  . ' ON '
        .  StatusManager::TABLE  .  '.id = '  . static::TABLE  .  '.status_id WHERE '
        .  StatusManager::TABLE .  '.id='  .  static::TABLE  . '.status_id ORDER BY '
        .  static::TABLE . '.id '  .  ' DESC';

        return $this->pdo->query($query)->fetchAll();
    }

    public function selectByIdOrder(int $id)
    {
        // prepared request

        $statement = $this->pdo->prepare('SELECT'  .  static::TABLE . '.id, '  .  static::TABLE . '.title,'
        .  static::TABLE  .  '.firstname,'  .  static::TABLE  .  '.lastname,'
        .  static::TABLE  .  '.email,'  .  static::TABLE  .  '.address,'
        .  static::TABLE  .  '.zipcode,'  .  static::TABLE  .  '.city,'  .  static::TABLE  .  '.status_id,'
        .  static::TABLE  .  '.country,' .  static::TABLE  .  '.detail,'
        .  StatusManager::TABLE  .  '.name FROM '
        .  static::TABLE  .  ' JOIN ' . StatusManager::TABLE  . ' ON '
        .  StatusManager::TABLE  .  '.id = '  . static::TABLE  .  '.status_id WHERE '  . static::TABLE  .  '.id=:id');
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
