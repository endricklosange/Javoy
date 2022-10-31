<?php

namespace App;

use App\Model\ActualityManager;
use PHPUnit\Framework\TestCase;

// phpcs:disable

require_once './config/db.php';
require_once './config/config.php';

class CrudTest extends TestCase
{
    public function testRead(): void
    {

        $actualityManager = new ActualityManager();
        $actualities = $actualityManager->selectAll('name');
        $this->assertNotEmpty($actualities);
    }
    public function testShow(): void
    {

        $actualityManager = new ActualityManager();
        $actualities = $actualityManager->selectAll('name');
        $actuality = "";
        foreach ($actualities as $actuality) {
            $actualityManager->selectOneById($actuality['id']);
        }
        $this->assertNotEmpty($actuality);
    }
    public function testCreate(): void
    {
        $actuality = [
            'name' => 'endrick',
            'description' => 'gffdgfdg',
            'image' => 'ContacteUs.png',
        ];
        $actualityManager = new ActualityManager();
        $actualitiesNumberOld = count($actualityManager->selectAll('name'));
        $actualityManager->insert($actuality);
        $actualitiesNumberNew = count($actualityManager->selectAll('name'));
        if ($actualitiesNumberOld < $actualitiesNumberNew) {
            $this->assertTrue(true);
        } else {
            $this->assertTrue(false);
        }
    }
    public function testUpdate(): void
    {
        $actuality = [
            'id' => 5,
            'name' => 'endrick',
            'description' => 'gffdgfdg',
            'image' => 'ContacteUs.png',
            'created_at' => "2022-10-31"
        ];


        $actualityManager = new ActualityManager();
        $actualitiesOld = $actualityManager->selectOneById(5);
        $actualityManager->update($actuality);
        if ($actuality === $actualitiesOld) {
            $this->assertTrue(true);
        } else {
            $this->assertTrue(false);
        }
    }
    public function testDelete(): void
    {
        // Create new acutality
        $actuality = [
            'name' => 'endrick',
            'description' => 'gffdgfdg',
            'image' => 'ContacteUs.png',
        ];

        $actualityManager = new ActualityManager();
        $actualitiesNumberOld = count($actualityManager->selectAll('name'));

        $actualitiesNumber = count($actualityManager->selectAll('name')) - 1;
        $lastActuality = $actualityManager->selectAll('name')[$actualitiesNumber];
        $actualityManager->delete($lastActuality['id']);
        $actualitiesNumberNew = count($actualityManager->selectAll('name'));
        if ($actualitiesNumberOld > $actualitiesNumberNew) {
            $this->assertTrue(true);
        } else {
            $this->assertTrue(false);
        }
    }
}
