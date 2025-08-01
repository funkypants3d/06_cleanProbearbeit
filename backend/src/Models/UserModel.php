<?php

namespace App\Models;

class UserModel
{
    public int $id;
    public string $email;
    public string $password;

    public function __construct(array $data)
    {
        $this->id = $data['id'] ?? 0;
        $this->email = $data['email'];
        $this->password = $data['password'];
    }
}
