<?php

namespace App;

use Nyholm\Psr7\Request;
use EntryController;
use UserController;

class Router
{
    public function dispatch(Request $request)
    {
        $method = $request->getMethod();
        $uri = $request->getUri()->getPath();

        // simple Router layout using if statements to decide which action to call

        if ($method === 'GET' && $uri === '/entries') {
            return (new EntryController())->list();
        }

        if ($method === 'POST' && $uri === '/entries') {
            return (new EntryController())->create();
        }

        if ($method === 'POST' && $uri === '/users') {
            return (new UserController())->create();
        }

        if ($method === 'DELETE' && $uri === '/users') {
            return (new UserController())->delete();
        }

        if ($method === 'POST' && $uri === '/auth') {
            // call static authentication method in here to keep this part of the Gästebuch simple
            return AuthController::authenticateStatic($request, $pdo);
        }

        $factory = new \Nyholm\Psr7\Factory\Psr17Factory();
        return $factory->createResponse(404)->withBody(
            $factory->createStream('404 Not Found')
        );
    }
}
