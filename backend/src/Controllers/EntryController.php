<?php

namespace App\Controllers;

use PDO;
use PDOException;
use App\Models\EntryModel;

class EntryController
{

    public function create(PDO $pdo, string $author, string $message): EntryModel
    {
        error_log("Creating entry: $author - $message");

        $stmt = $pdo->prepare('INSERT INTO entries (author, message, created_at) VALUES (:author, :message, NOW())');
        
        try {
            $stmt->execute([
                'author' => $author,
                'message' => $message,
            ]);
            $id = $pdo->lastInsertId();

            $stmt = $pdo->prepare('SELECT * FROM entries WHERE id = :id');
            $stmt->execute(['id' => $id]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            
        } catch (PDOException $e) {
            error_log('DB Error: ' . $e->getMessage());
        }
                
        if (!$row) {
            // fallback or throw exception
            $row = [
                'id' => 0,
                'author' => $author,
                'message' => $message,
                'created_at' => date('Y-m-d H:i:s'),
            ];
        }
        return new EntryModel($row);
    }

    public function list(PDO $pdo): array
    {
        if($pdo) {
            $stmt = $pdo->prepare('SELECT * FROM entries LIMIT 30');
            $stmt->execute();
            return array_map(
                fn($row) => new EntryModel($row), 
                $stmt->fetchAll(PDO::FETCH_ASSOC)
            );
        } else {
            return [null, null, null];
        }
        
    }
}
