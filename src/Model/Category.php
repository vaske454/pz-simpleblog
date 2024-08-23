<?php

namespace App\Model;

use PDO;

class Category
{
    public static function categoryExists($name)
    {
        $db = new PDO('mysql:host=db;dbname=db', 'db', 'db');
        $stmt = $db->prepare('SELECT COUNT(*) FROM categories WHERE name = :name');
        $stmt->execute(['name' => $name]);
        return $stmt->fetchColumn() > 0;
    }

    public static function insertCategory($name)
    {
        $db = new PDO('mysql:host=db;dbname=db', 'db', 'db');
        $stmt = $db->prepare('INSERT INTO categories (name) VALUES (:name)');
        $stmt->execute(['name' => $name]);
    }

    public static function getCategories()
    {
        $db = new PDO('mysql:host=db;dbname=db', 'db', 'db');
        $stmt = $db->query('SELECT id, name FROM categories ORDER BY name');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getCategoryById($id)
    {
        $db = new PDO('mysql:host=db;dbname=db', 'db', 'db');
        $stmt = $db->prepare('SELECT name FROM categories WHERE id = :id');
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
