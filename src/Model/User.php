<?php

namespace App\Model;

use App\Core\Database\Connection;
use App\Exception\RegistrationException;
use PDO;

class User
{
    public $id;
    public $username;

    public static function authenticate($username, $password)
    {
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
        $db = Connection::getInstance();
        $stmt = $db->prepare('SELECT username FROM users WHERE id = :id');
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function getById($id)
    {
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
