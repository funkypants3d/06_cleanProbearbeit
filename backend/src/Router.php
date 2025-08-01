<?php

namespace App;

use App\Http\Request;
use EntryController;
use PDO;
use UserController;

class Router
{

    public function __construct(PDO $pdo){}

    public function dispatch(Request $request)
    {
        $method = $request->method;
        $uri = $request->uri;
    
        if ($method === 'OPTIONS') {
            http_response_code(200);
            return 'OK';
        }        

        // simple Router layout using if statements to decide which action to call
        if ($method === 'GET' && $uri === '/entries') {
            return (new EntryController())->list();
        }

        if ($method === 'POST' && $uri === '/entries') {
            return (new EntryController())->create(
                // need to pass the author and message to this function
                '', ''
            );
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
    }
}
