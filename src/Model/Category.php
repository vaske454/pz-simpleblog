<?php

namespace App\Model;

use App\Core\Database\Connection;
use PDO;
use PDOException;

class Category
{
    private $db;

    public function __construct()
    {
        $this->db = Connection::getInstance();
    }

    private function tableExists()
    {
        try {
            $stmt = $this->db->prepare("SHOW TABLES LIKE :tableName");
            $stmt->execute(['tableName' => 'categories']);
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            // Handle the error as needed
            error_log('Error checking table existence: ' . $e->getMessage());
            return false;
        }
    }

    public function categoryExists($name)
    {
        try {
            $stmt = $this->db->prepare('SELECT COUNT(*) FROM categories WHERE name = :name');
            $stmt->execute(['name' => $name]);
            return $stmt->fetchColumn() > 0;
        } catch (PDOException $e) {
            // Handle the error as needed
            error_log('Error checking category existence: ' . $e->getMessage());
            return false;
        }
    }

    public function insertCategory($name)
    {
        try {
            $stmt = $this->db->prepare('INSERT INTO categories (name) VALUES (:name)');
            if (!$this->tableExists()) {
                error_log('Table categories does not exist.');
                return;
            }
            $stmt->execute(['name' => $name]);
        } catch (PDOException $e) {
            // Handle the error as needed
            error_log('Error inserting category: ' . $e->getMessage());
            throw $e; // Optionally rethrow the exception
        }
    }

    public function getCategories()
    {
        try {
            $stmt = $this->db->query('SELECT id, name FROM categories ORDER BY name');
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

    public function getCategoryById($id)
    {
        if (!$this->tableExists()) {
            error_log('Table categories does not exist.');
            return null;
        }

        try {
            $stmt = $this->db->prepare('SELECT name FROM categories WHERE id = :id');
            $stmt->execute([':id' => $id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Handle the error as needed
            error_log('Error fetching category by ID: ' . $e->getMessage());
            return null; // or handle the case as needed
        }
    }
}
