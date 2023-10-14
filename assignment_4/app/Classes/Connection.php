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
        $hostName = "localhost";
        $databaseName = "assignment_4";
        $userName = "root";
        $password = "";
        try {
            $this->conn = new PDO("mysql:host=$hostName;dbname=$databaseName", $userName, $password);
            // set the PDO error mode to exception
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //echo "Connected successfully";
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    // public static function getInstance()
    // {
    //     if(!self::$instance){
    //         echo 'new instance';
    //         self::$instance = new self();
    //     }
    //     echo 'old instance';
    //     return self::$instance;
    // }
    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self();
           // echo 'New instance created.'; // Optionally, you can include this message.
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


    // public function createTable($sql)
    // {
    //     try {
    //         $this->conn->exec($sql);
    //     } catch (PDOException $e) {
    //         echo  $e->getMessage();
    //     }
    // }
   

}