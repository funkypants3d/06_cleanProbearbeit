<?php

namespace App\Controllers;

use PDO;
use PDOException;
use App\Models\EntryModel;

class EntryController
{


    public function create(PDO $pdo, string $author, string $message): void
    {
        // I decided to refactor this function because it was kind of messy
        error_log("Creating entry: $author - $message");
        try {
            $stmt = $pdo->prepare('INSERT INTO entries (author, message, created_at) VALUES (:author, :message, NOW())');
            $stmt->execute([
                'author' => $author,
                'message' => $message,
            ]);
        } catch (PDOException|\RuntimeException $e) {
            error_log('DB Error: ' . $e->getMessage());
            
        }
    }

    public function list(PDO $pdo): array
    {
        $stmt = $pdo->prepare('SELECT * FROM entries LIMIT 30');
        $stmt->execute();
        return array_map(
            fn($row) => new EntryModel($row), 
            $stmt->fetchAll(PDO::FETCH_ASSOC)
        );   
    }
}
