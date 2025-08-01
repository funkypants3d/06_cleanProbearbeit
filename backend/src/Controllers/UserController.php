<?php

namespace App\Controllers;

use PDO;
use App\Models\UserModel;

class UserController
{

    public function create(PDO $pdo, string $email, string $password): void
    {
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("INSERT INTO users (email, password) VALUES (:email, :password)");
        $stmt->execute([
            'email' => $email, 
            'password' => $hashed, 
        ]);
    }

    public function delete(PDO $pdo, int $id): bool
    {
        // I am not quite sure how to implement this just yet
        // I know I want the Router to check the request, which should have info about which logged in user made the request, and hand in the according $id. 
        // I think, maybe I first call the AuthController to find out which authenticated user acutally made the request and return that to the router
        // which then calls this delete() action?
        // I will probably sleep over this and save this task for tomorrow. 
        return false;
    }
}
