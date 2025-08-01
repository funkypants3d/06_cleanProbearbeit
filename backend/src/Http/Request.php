<?php

namespace App\Http;

class Request
{
    public string $method;
    public string $uri;
    public array $query;
    public array $body;

    public function __construct()
    {
        // simple Request class I built with GPT step by step to get the necessary funcitonality
        // should work for now, will have to be updated to delete account later on, since I want to use DELETE method for that. 
        
        $this->method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        $this->uri = $_SERVER['REQUEST_URI'] ?? '/';
        $this->query = $_GET;
        $this->body = $_POST;
    }
}
