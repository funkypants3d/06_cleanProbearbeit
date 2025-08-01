<?php

namespace App;

use PDO;
use Exception;
use App\Controllers\EntryController;
use App\Controllers\UserController;
use Psr\Http\Message\ServerRequestInterface;

class Router
{

    public function dispatch(ServerRequestInterface $request, PDO $pdo)
    {
        try {
            $method = $request->getMethod();
            $uri = $request->getUri()->getPath();
        
            if ($method === 'OPTIONS') {
                http_response_code(200);
                return 'OK';
            }        

            // simple Router layout using if statements to decide which action to call
            if ($method === 'GET' && $uri === '/api/entries') {
                http_response_code(200);
                header('Content-Type: application/json');
                $controller = new EntryController();
                $entries = $controller->list($pdo);
                echo json_encode($entries);
                exit;
            }

            if ($method === 'POST' && $uri === '/api/entries') {
                http_response_code(201);
                header('Content-Type: application/json');
                $body = json_decode((string) $request->getBody(), true);
                error_log("Parsed body: " . json_encode($body));
                $author = $body['author'] ?? '';
                $content = $body['content'] ?? '';
                $entry = (new EntryController())->create($pdo, $author, $content);
                echo json_encode($entry);
                exit;
            }

            if ($method === 'POST' && $uri === '/users') {
                $email = '';
                $password = '';
                return (new UserController())->create($pdo, $email, $password);
            }

            if ($method === 'DELETE' && $uri === '/users') {
                $id = '960000';
                return (new UserController())->delete($pdo, $id);
            }

            if ($method === 'POST' && $uri === '/auth') {
                // call static authentication method in here to keep this part of the Gästebuch simple
                return AuthController::authenticate($request, $pdo);
            }
        } catch (Exception $e) {
            http_response_code(500);
            header('Content-Type: application/json');
            error_log('Dispatch error: ' . $e->getMessage());
            return json_encode(['error' => 'Server error', 'message' => $e->getMessage()]);
        }
    }
}
