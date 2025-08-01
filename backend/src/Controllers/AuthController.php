<?php

namespace App;

use PDO;
use Exception;
use InvalidArgumentException;

// This controller will not be PSR compliant, I just want to keep this simple and easy to overview

class AuthController
{

    /*
    public static function authenticate(PDO $pdo, ServerRequestInterface $request): Response
    {
        
    }
    */

    public static function authenticate($pdo, $request): void
    {
        try {

            $body = json_decode((string) $request->getBody(), true);
            $email = $body['email'] ?? '';
            $password = $body['password'] ?? '';

            if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                http_response_code(400);
                echo json_encode(['error' => 'Invalid email address']);
                exit;
            }

            $stmt = $pdo->prepare('SELECT id, email, password FROM users WHERE email = :email');
            $stmt->execute([
                'email' => $email,
            ]);

            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if(!$user || !password_verify($password, $user['password'])) {
                http_response_code(401);
                echo json_encode(['error' => 'Invalid credentials']);
                exit;
            }

            echo json_encode(['message' => 'login successful']);
            exit;

        } catch (Exception $e) {
            http_response_code(400);
            echo json_encode(['error' => $e->getMessage()]);
            exit;
        }
    }
}
