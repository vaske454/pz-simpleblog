<?php

namespace App\Model;

use PDO;

class User
{
    public $id;
    public $username;

    public static function authenticate($username, $password)
    {
        $db = new PDO('mysql:host=db;dbname=db', 'db', 'db');
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

    public static function create($username, $password)
    {
        $db = new PDO('mysql:host=db;dbname=db', 'db', 'db');
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $db->prepare('INSERT INTO users (username, password) VALUES (:username, :password)');
        if ($stmt->execute(['username' => $username, 'password' => $passwordHash])) {
            return self::authenticate($username, $password);
        } else {
            // Print error information for debugging
            print_r($stmt->errorInfo());
            return null;
        }
    }
}
