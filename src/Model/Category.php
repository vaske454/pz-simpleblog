<?php

namespace App\Model;

use PDO;
use PDOException;

class Category
{
    private static function getConnection()
    {
        try {
            return new PDO('mysql:host=db;dbname=db', 'db', 'db');
        } catch (PDOException $e) {
            // Log the error and rethrow if needed
            error_log('Database connection error: ' . $e->getMessage());
            throw $e;
        }
    }

    public static function categoryExists($name)
    {
        try {
            $db = self::getConnection();
            $stmt = $db->prepare('SELECT COUNT(*) FROM categories WHERE name = :name');
            $stmt->execute(['name' => $name]);
            return $stmt->fetchColumn() > 0;
        } catch (PDOException $e) {
            // Handle the error as needed
            error_log('Error checking category existence: ' . $e->getMessage());
            return false;
        }
    }

    public static function insertCategory($name)
    {
        try {
            $db = self::getConnection();
            $stmt = $db->prepare('INSERT INTO categories (name) VALUES (:name)');
            $stmt->execute(['name' => $name]);
        } catch (PDOException $e) {
            // Handle the error as needed
            error_log('Error inserting category: ' . $e->getMessage());
            throw $e; // Optionally rethrow the exception
        }
    }

    public static function getCategories()
    {
        try {
            $db = self::getConnection();
            $stmt = $db->query('SELECT id, name FROM categories ORDER BY name');
            if ($stmt === false) {
                return [];
            }
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Handle the error as needed
            error_log('Error fetching categories: ' . $e->getMessage());
            return []; // or handle the case as needed
        }
    }

    public static function getCategoryById($id)
    {
        try {
            $db = self::getConnection();
            $stmt = $db->prepare('SELECT name FROM categories WHERE id = :id');
            $stmt->execute([':id' => $id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Handle the error as needed
            error_log('Error fetching category by ID: ' . $e->getMessage());
            return null; // or handle the case as needed
        }
    }
}
