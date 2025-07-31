<?php

namespace App;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Nyholm\Psr7\Factory\Psr17Factory;

// This controller will not be PSR compliant, I just want to keep this simple and easy to overview

class AuthController
{
    private \PDO $db;
    private Psr17Factory $psr17Factory;

    public function __construct(\PDO $db)
    {
        $this->db = $db;
        $this->psr17Factory = new Psr17Factory();
    }

    public function authenticate(ServerRequestInterface $request): ResponseInterface
    {
        $params = json_decode($request->getBody()->getContents(), true);
        $email = $params['email'] ?? '';
        $password = $params['password'] ?? '';

        $stmt = $this->db->prepare("SELECT id, password FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(\PDO::FETCH_ASSOC);

        if (!$user || !password_verify($password, $user['password'])) {
            $response = $this->psr17Factory->createResponse(401);
            $response->getBody()->write('Invalid credentials');
            return $response;
        }

        session_start();
        $_SESSION['user_id'] = $user['id'];

        $response = $this->psr17Factory->createResponse(200);
        $response->getBody()->write('Authenticated successfully');
        return $response;
    }
}
