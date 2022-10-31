<?php

namespace App;

use App\Model\ActualityManager;
use PHPUnit\Framework\TestCase;

// phpcs:disable

require_once './config/db.php';
require_once './config/config.php';

class CrudTest extends TestCase
{
    function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    public function testRead(): void
    {

        $actualityManager = new ActualityManager();
        $actualities = $actualityManager->selectAll();
        $this->assertNotEmpty($actualities);
    }
    public function testShow(): void
    {

        $actualityManager = new ActualityManager();
        $actualities = $actualityManager->selectAll();
        $actuality = "";
        foreach ($actualities as $actuality) {
            $actualityManager->selectOneById($actuality['id']);
        }
        $this->assertNotEmpty($actuality);
    }

    public function testUpdate(): void
    {

        $actualityManager = new ActualityManager();
        $actualities = $actualityManager->selectAll();
        $firstActuality = $actualities[0];
        $actuality = [
            'id' => $firstActuality['id'],
            'name' =>  $this->generateRandomString(),
            'description' => 'gffdgfdg',
            'image' => 'ContacteUs.png',
            'created_at' => $firstActuality['created_at']
        ];
        $actualityManager->update($actuality);
        if ($firstActuality === $actuality) {
            $this->assertTrue(false);
        } else {
            $this->assertTrue(true);
        }
    }
    public function testCreate(): void
    {
        $actuality = [
            'name' => 'endrick',
            'description' => 'gffdgfdg',
            'image' => 'ContacteUs.png',
        ];
        $actualityManager = new ActualityManager();
        $actualitiesNumberOld = count($actualityManager->selectAll());
        $actualityManager->insert($actuality);
        $actualitiesNumberNew = count($actualityManager->selectAll());
        if ($actualitiesNumberOld < $actualitiesNumberNew) {
            $this->assertTrue(true);
        } else {
            $this->assertTrue(false);
        }
    }
    public function testDelete(): void
    {
        $actuality = [
            'name' => 'endrick',
            'description' => 'gffdgfdg',
            'image' => 'ContacteUs.png',
        ];

        $actualityManager = new ActualityManager();

        $actualitiesNumberOld = count($actualityManager->selectAll());

        $actualitiesNumber = count($actualityManager->selectAll()) - 1;
        $lastActuality = $actualityManager->selectAll()[$actualitiesNumber];
        $actualityManager->delete($lastActuality['id']);
        $actualitiesNumberNew = count($actualityManager->selectAll());
        if ($actualitiesNumberOld > $actualitiesNumberNew) {
            $this->assertTrue(true);
        } else {
            $this->assertTrue(false);
        }
    }
}
