<?php

namespace App;

use App\Model\UserManager;
use PHPUnit\Framework\TestCase;

// phpcs:disable

require_once './config/db.php';
require_once './config/config.php';

class SecurityTest extends TestCase
{
    private const PRODUCT_MAX_LENGHT = 80;
    public const MAX_UPLOAD_FILESIZE = 1000000;
    public const ALLOWED_MIMES = ['image/jpeg', 'image/png'];

    public function testEmptyData(): void
    {

        $data = [
            'price' => "",
        ];
        $this->assertEmpty($data['price']);
    }
    public function testGetDataErrorEmpty(): void
    {
        $errors = [];

        $data = [
            'price' => "",
        ];
        if (empty($data['price'])) {
            $errors[] = 'Le prix est obligatoire';
        }
        $this->assertEquals($errors[0], 'Le prix est obligatoire');
    }
    public function testGetDataErrorLimiteString(): void
    {

        $errors = [];
        $data = [
            'name' => "",
        ];
        $data['name'] = str_repeat("a", 81);
        if (strlen($data['name']) > self::PRODUCT_MAX_LENGHT) {
            $errors[] = 'Le nom doit contenir moins de ' . self::PRODUCT_MAX_LENGHT . ' charactères';
        }
        $this->assertEquals($errors[0], 'Le nom doit contenir moins de ' . self::PRODUCT_MAX_LENGHT . ' charactères');
    }
    public function testIfFileErrorIsDifferentFromZero(): void
    {

        $errors = [];
        $file = [
            'name' => 'ContacteUs.png',
            'full_path' => 'ContacteUs.png',
            'type' => 'image/png',
            'tmp_name' => '/tmp/phpIkYkfv',
            'error' =>  1,
            'size' =>  30671,
        ];
        if ($file['error'] != 0) {
            $errors[] = 'Problème lors de l\'upload';
        }
        $this->assertEquals($errors[0], 'Problème lors de l\'upload');
    }
    public function testIfFileErrorIsNotToHeavy(): void
    {

        $errors = [];
        $file = [
            'name' => 'ContacteUs.png',
            'full_path' => 'ContacteUs.png',
            'type' => 'image/png',
            'tmp_name' => '/tmp/phpIkYkfv',
            'error' =>  0,
            'size' =>  1130671,
        ];
        /** @phpstan-ignore-next-line */
        if ($file['size'] > self::MAX_UPLOAD_FILESIZE) {
            $errors[] = 'Le fichier doit faire moins de ' . self::MAX_UPLOAD_FILESIZE / 1000000 . 'Mo';
        }
        $this->assertEquals($errors[0], 'Le fichier doit faire moins de ' . self::MAX_UPLOAD_FILESIZE / 1000000 . 'Mo');
    }
    public function testIfUserEmailIsEqualToFormEmail(): void
    {
        $data = [
            'email' => 'myEmail@gmail.com',
            'password' => 'Lsdfdsfd',
        ];
        $email = $data['email'];
        $password = password_hash($data['password'], PASSWORD_DEFAULT);
        $userManager = new UserManager();
        $userManager->insert($email, $password);
        $userEmail = $userManager->selectUserEmail($email);
        $this->assertEquals($userEmail[0]['email'], $email);
    }

    public function testIfUserPasswordIsEqualToFormpassword(): void
    {
        $data = [
            'password' => 'Lsdfdsfd',
            'email' => 'myEmail@gmail.com',
        ];
        $password = $data['password'];
        $email = $data['email'];
        $userManager = new UserManager();
        $users = $userManager->selectUserEmail($email);
        var_dump($users[0]['password']);
        $usersNumber =  count($userManager->selectAll()) - 1;
        $lastUser = $userManager->selectAll()[$usersNumber];
        $this->assertTrue(password_verify($password, $users[0]['password']));
        $userManager->delete($lastUser['id']);
    }
}
