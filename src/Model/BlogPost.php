<?php

namespace App\Model;

use PDO;

class BlogPost
{

    /**
     * @throws \Exception
     */
    public static function create($title, $content, $userId)
    {
        $db = new PDO('mysql:host=db;dbname=db', 'db', 'db');
        $stmt = $db->prepare('INSERT INTO blog_posts (title, content, user_id) VALUES (:title, :content, :user_id)');
        if (!$stmt->execute([
            ':title' => $title,
            ':content' => $content,
            ':user_id' => $userId
        ])) {
            throw new \Exception('Error creating blog post.');
        }
    }

    public static function getAll()
    {
        $db = new PDO('mysql:host=db;dbname=db', 'db', 'db');
        $stmt = $db->query('SELECT * FROM blog_posts ORDER BY publication_date DESC');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get a blog post by ID
     *
     * @param int $id
     * @return array|null
     * @throws \Exception
     */
    public static function getById($id)
    {
        $db = new PDO('mysql:host=db;dbname=db', 'db', 'db');
        $stmt = $db->prepare('SELECT * FROM blog_posts WHERE id = :id');
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

}
