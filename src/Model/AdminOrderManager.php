<?php

namespace App\Model;

class AdminOrderManager extends AbstractManager
{
    public const TABLE = '`order`';
    public const TABLESTATUS = 'status';

    public function selectAllOrderStatus()
    {
        $query = 'SELECT'  .  static::TABLE . '.id, '  .  static::TABLE . '.title,'
        .  static::TABLE  .  '.firstname,'  .  static::TABLE  .  '.lastname,'
        .  static::TABLE  .  '.email,'  .  static::TABLE  .  '.address,'
        .  static::TABLE  .  '.zipcode,'  .  static::TABLE  .  '.city,'
        .  static::TABLE  .  '.detail,' . static::TABLESTATUS  .  '.name FROM '
        .  static::TABLE  .  ' JOIN ' . static::TABLESTATUS  . ' ON '
        .  static::TABLESTATUS  .  '.id = '  . static::TABLE  .  '.status_id WHERE '
        .  static::TABLESTATUS .  '.id='  .  static::TABLE  .  '.status_id';

        return $this->pdo->query($query)->fetchAll();
    }
}
