<?php 

//declare(strict_types=1);

namespace App\Classes;

use PDO;
use PDOException;


class Connection 
{
    private static $instance = null;
    private ?PDO $conn;

    private function __construct()
    {
        $config = require_once(__DIR__ . '/../../config/database.php');
        $hostName = $config['mysql']["host"];
        $databaseName = $config['mysql']['database'];
        $userName = $config['mysql']['username'];
        $password = $config['mysql']['password'];
        try {
            $this->conn = new PDO("mysql:host=$hostName;dbname=$databaseName", $userName, $password);
            // set the PDO error mode to exception
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        } 
        return self::$instance;
    }

    public function getConnection()
    {
        return $this->conn;
    }

    public function __destruct()
    {
        
    }

}