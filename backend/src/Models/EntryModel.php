<?php

class EntryModel
{
    public int $id;
    public int $author;
    public string $message;
    public string $timestamp;

    public function __construct(array $data)
    {
        $this->id = $data['id'] ?? 0;
        $this->author = $data['author'];
        $this->message = $data['message'];
        $this->timestamp = $data['timestamp'] ?? date('Y-m-d H:i:s');
    }
}
