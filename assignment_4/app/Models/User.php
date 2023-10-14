<?php 

declare(strict_types=1);

namespace App\Models;

use PDO;
use PDOException;
use App\Classes\Session;

class User extends Model 
{
    private $user; 

    public function __construct($user=[])
    {
        $this->user = $user;
        parent::__construct();
    }

    public function create(array $data)
    {
        $name = $data['name'];
        $email = $data['email'];
        $password = password_hash($data['password'], PASSWORD_BCRYPT);
        
        $sql = "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)";
        try {
            $stmt = $this->db->prepare($sql);
        
            // Bind parameters to the placeholders
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':password', $password, PDO::PARAM_STR);
        
            $stmt->execute();
            $insertedId = $this->db->lastInsertId();
            return $insertedId;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    
    }

    public function getAllCustomers()
    {
        $sql = "SELECT * FROM users WHERE type = 'customer'";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $users;
    }

    public function getAllUsers()
    {
        $user_id = $_SESSION['user']['id'];
        $sql = "SELECT * FROM users WHERE type = 'customer' AND id != :user_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_STR);
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $users;
    }

    public function getUserById($id)
    {
        try {
            $sql = "SELECT * FROM users WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            return $user;
        } catch (\PDOException $e) {
            Session::setFlashMessage('error', $e->getMessage());
        }
    }

    public function loginUser()
    {
        try {
            $email = $this->user['email'];
            $password = $this->user['password'];
            $sql = "SELECT * FROM users WHERE email = :email";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(":email", $email);
            $stmt->execute();

            // Fetch the user data
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            // Check if a user was found
            $userInputPassword = 'adminpassword'; // The password the user is trying to log in with
            $storedHashedPassword = '$2y$10$VLRqVEkzLojLjTkc10IiJOdb38eO1H5wIiHk6y/Fcjy6VDwwPLJ9x'; // The hashed password stored in the database
            
            if ($user && password_verify($password, $user['password'])) {
            // You can redirect the user or perform other actions.
                return $user;
            } else {
                return null;
                
            }
        } catch (\PDOException $e) {
            //throw $th;
            return null;
            Session::setFlashMessage('error', $e->getMessage());
        }
    }

    public function getMyTransactions($user_id)
    {
        $sql = "SELECT * FROM accounts WHERE user_id = :user_id AND type != 'initial'";
        try {
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }

    public function getAllTransactions()
    {
        $sql = "SELECT * FROM accounts";
        try {
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }
}