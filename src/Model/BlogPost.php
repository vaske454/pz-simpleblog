<?php

namespace App\Model;

use PDO;
use PDOException;

class BlogPost
{

    /**
     * @throws \Exception
     */
    public static function create($title, $content, $userId, $categoryId)
    {
        $db = new PDO('mysql:host=db;dbname=db', 'db', 'db');
        $stmt = $db->prepare('INSERT INTO blog_posts (title, content, user_id, category_id) VALUES (:title, :content, :user_id, :category_id)');
        if (!$stmt->execute([
            ':title' => $title,
            ':content' => $content,
            ':user_id' => $userId,
            ':category_id' => $categoryId,
        ])) {
            throw new \Exception('Error creating blog post.');
        }
    }

    public static function getAll()
    {
        try {
            $db = new PDO('mysql:host=db;dbname=db', 'db', 'db');
            // Set error mode to exception
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Check if the table exists
            $tableCheckStmt = $db->query('SHOW TABLES LIKE "blog_posts"');
            if ($tableCheckStmt->rowCount() == 0) {
                // Table does not exist
                return []; // or handle the case as needed
            }

            // Fetch data from the table
            $stmt = $db->query('SELECT id, title, content, user_id, publication_date, category_id FROM blog_posts ORDER BY publication_date DESC');
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Handle any errors, such as connection issues
            error_log($e->getMessage());
            return []; // or handle the error as needed
        }
    }

}
