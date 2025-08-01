<?php

namespace App\Models;

use JsonSerializable;
class EntryModel implements JsonSerializable
{
    public int $id;
    public string $author;
    public string $message;
    public string $created_at;

    public function __construct(array $data)
    {
        $this->id = $data['id'] ?? 0;
        $this->author = $data['author'] ?? '';
        $this->message = $data['message'] ?? '';
        $this->created_at = $data['created_at'] ?? date('Y-m-d H:i:s');
    }

    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }
}
