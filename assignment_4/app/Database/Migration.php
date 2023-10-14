<?php 

namespace App\Database;


use PDO;
use Exception;
use PDOException;
use App\Classes\Connection;

class Migration 
{
    public  $db;

    public function __construct($db)
    {
        try {
            $this->db = $db;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function run()
    {
        $files = glob(__DIR__ . "/migrations/*");
        
        foreach($files as $file)
        {
            if(is_file($file)){
                $sql = file_get_contents($file);
                try {
                    $this->db->exec($sql);
                } catch (PDOException $e) {
                    echo  $e->getMessage();
                }
               printf("$file created successfully");
            }
        }
    }
}