<?php

require_once '../Models/EntryModel.php';

class EntryController
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function createEntry(int $author, string $message): EntryModel
    {
        $stmt = $this->db->prepare("INSERT INTO entries (author, message, timestamp) VALUES (:author, :message, NOW())");
        $stmt->execute(['author' => $author, 'message' => $message]);

        $id = (int) $this->db->lastInsertId();
        $timestamp = $this->db->query("SELECT timestamp FROM entries WHERE id = $id")->fetchColumn();

        return new EntryModel(['id' => $id, 'author' => $author, 'message' => $message, 'timestamp' => $timestamp]);
    }

    public function getEntries(): array
    {
        $stmt = $this->db->query("SELECT * FROM entries LIMIT 15");
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return array_map(fn($row) => new EntryModel($row), $rows);
    }
}
