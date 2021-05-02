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
}
