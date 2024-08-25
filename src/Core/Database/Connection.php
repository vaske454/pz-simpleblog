<?php

namespace App\Core\Database;

use PDO;
use PDOException;

class Connection
{
    private static $instance = null;

    private function __construct() {}

    public static function getInstance()
    {
        if (self::$instance === null) {
            try {
                self::$instance = new PDO('mysql:host=db;dbname=db', 'db', 'db');
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                // Log the error and rethrow if needed
                error_log('Database connection error: ' . $e->getMessage());
                throw $e;
            }
        }

        return self::$instance;
    }
}
