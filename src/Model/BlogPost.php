<?php

namespace App\Model;

use App\Core\Database\Connection;
use PDO;
use PDOException;

class BlogPost
{
    private $db;

    public function __construct()
    {
        $this->db = Connection::getInstance();
    }

    private function tableExists($tableName)
    {
        try {
            $stmt = $this->db->prepare("SHOW TABLES LIKE :tableName");
            $stmt->execute(['tableName' => $tableName]);
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            error_log('Error checking table existence: ' . $e->getMessage());
            return false;
        }
    }

    private function redirectToHomepage()
    {
        header('Location: /'); // Adjust this URL if your homepage is located elsewhere
        exit();
    }

    /**
     * @throws \Exception
     */
    public function create($title, $content, $userId, $categoryId)
    {
        if (!$this->tableExists('blog_posts')) {
            $this->redirectToHomepage();
        }

        try {
            $stmt = $this->db->prepare('INSERT INTO blog_posts (title, content, user_id, category_id) VALUES (:title, :content, :user_id, :category_id)');
            if (!$stmt->execute([
                ':title' => $title,
                ':content' => $content,
                ':user_id' => $userId,
                ':category_id' => $categoryId,
            ])) {
                throw new \Exception('Error creating blog post.');
            }
        } catch (PDOException $e) {
            error_log('Error creating blog post: ' . $e->getMessage());
            $this->redirectToHomepage();
        }
    }

    public function getAll()
    {
        try {
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            if (!$this->tableExists('blog_posts')) {
                return []; // or handle the case as needed
            }

            $stmt = $this->db->query('SELECT id, title, content, user_id, publication_date, category_id FROM blog_posts ORDER BY publication_date DESC');
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('Error fetching blog posts: ' . $e->getMessage());
            return []; // or handle the case as needed
        }
    }

    public function update($blogId, $title, $content, $userId, $categoryId)
    {
        if (!$this->tableExists('blog_posts')) {
            $this->redirectToHomepage();
        }

        try {
            $stmt = $this->db->prepare('UPDATE blog_posts SET title = :title, content = :content, category_id = :category_id WHERE id = :id AND user_id = :user_id');
            $stmt->execute([
                ':title' => $title,
                ':content' => $content,
                ':category_id' => $categoryId,
                ':id' => $blogId,
                ':user_id' => $userId
            ]);
        } catch (PDOException $e) {
            error_log('Error updating blog post: ' . $e->getMessage());
            $this->redirectToHomepage();
        }
    }

    public function delete($blogId, $userId)
    {
        if (!$this->tableExists('blog_posts')) {
            $this->redirectToHomepage();
        }

        try {
            $stmt = $this->db->prepare('DELETE FROM blog_posts WHERE id = :id AND user_id = :user_id');
            $stmt->execute([
                ':id' => $blogId,
                ':user_id' => $userId
            ]);
        } catch (PDOException $e) {
            error_log('Error deleting blog post: ' . $e->getMessage());
            $this->redirectToHomepage();
        }
    }

    /**
     * @throws \Exception
     */
    public function createComment($content, $blogId, $username)
    {
        if (!$this->tableExists('comments')) {
            $this->redirectToHomepage();
        }

        try {
            $stmt = $this->db->prepare('INSERT INTO comments (content, user_name, blog_post_id) VALUES (:content, :user_name, :blog_post_id)');
            if (!$stmt->execute([
                ':content' => $content,
                ':user_name' => $username,
                ':blog_post_id' => $blogId,
            ])) {
                throw new \Exception('Error creating comment.');
            }
        } catch (PDOException $e) {
            error_log('Error creating comment: ' . $e->getMessage());
            $this->redirectToHomepage();
        }
    }

    public function getCommentsById($id)
    {
        if (!$this->tableExists('comments')) {
            return []; // or handle the case as needed
        }

        try {
            $stmt = $this->db->prepare('SELECT content, user_name FROM comments WHERE blog_post_id = :blog_post_id ORDER BY created_at DESC');
            $stmt->execute([
                ':blog_post_id' => $id,
            ]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('Error fetching comments: ' . $e->getMessage());
            return []; // or handle the case as needed
        }
    }

    public function getByCategoryId($selectedCategory)
    {
        if (!$this->tableExists('blog_posts')) {
            return []; // or handle the case as needed
        }

        try {
            $stmt = $this->db->prepare('SELECT * FROM blog_posts WHERE category_id = :category_id ORDER BY publication_date DESC');
            $stmt->bindParam(':category_id', $selectedCategory, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('Error fetching blog posts by category: ' . $e->getMessage());
            return []; // or handle the case as needed
        }
    }
}
