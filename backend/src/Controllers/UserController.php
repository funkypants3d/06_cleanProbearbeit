<?php

namespace App\Controllers;

use PDO;
use App\Models\UserModel;

class UserController
{

    public function create(PDO $pdo, string $email, string $password): UserModel
    {
        $user = new UserModel(['email' => $email, 'password' => $password]);
        return $user;
    }

    public function delete(PDO $pdo, int $id): bool
    {
        return false;
    }
}
