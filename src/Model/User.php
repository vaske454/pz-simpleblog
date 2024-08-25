<?php

namespace App\Model;

use App\Core\Database\Connection;
use App\Exception\RegistrationException;
use PDO;
use PDOException;

class User
{
    public $id;
    public $username;

    private static function tableExists()
    {
        try {
            $db = Connection::getInstance();
            $stmt = $db->prepare("SHOW TABLES LIKE :tableName");
            $stmt->execute(['tableName' => 'users']);
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            // Handle the error as needed
            error_log('Error checking table existence: ' . $e->getMessage());
            return false;
        }
    }

    public static function authenticate($username, $password)
    {
        if (!self::tableExists()) {
            error_log('Table users does not exist.');
            return null;
        }

        $db = Connection::getInstance();
        $stmt = $db->prepare('SELECT * FROM users WHERE username = :username');
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $instance = new self();
            $instance->id = $user['id'];
            $instance->username = $user['username'];
            return $instance;
        }

        return null;
    }

    /**
     * @throws RegistrationException
     */
    public static function create($username, $password)
    {
        if (!self::tableExists()) {
            error_log('Table users does not exist.');
            throw new RegistrationException('Table users does not exist.', 2006);
        }

        $passwordHash = password_hash($password, PASSWORD_BCRYPT);
        $db = Connection::getInstance();
        $stmt = $db->prepare('INSERT INTO users (username, password) VALUES (:username, :password)');
        if ($stmt->execute(['username' => $username, 'password' => $passwordHash])) {
            return self::authenticate($username, $password);
        } else {
            throw new RegistrationException($stmt->errorInfo()[2], 2006);
        }
    }

    public static function getUsernameById($id)
    {
        if (!self::tableExists()) {
            error_log('Table users does not exist.');
            return null;
        }

        $db = Connection::getInstance();
        $stmt = $db->prepare('SELECT username FROM users WHERE id = :id');
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function getById($id)
    {
        if (!self::tableExists()) {
            error_log('Table users does not exist.');
            return null;
        }

        $db = Connection::getInstance();
        $stmt = $db->prepare('SELECT id, username FROM users WHERE id = :id');
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // New method to get the current user from the session
    public static function getCurrentUser()
    {
        if (isset($_SESSION['user']->id)) {
            return self::getById($_SESSION['user']->id);
        }

        return null;
    }
}
