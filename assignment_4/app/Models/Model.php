<?php 

declare(strict_types=1);

namespace App\Models;

use PDOException;
use App\Classes\Connection;


class Model 
{
    protected $db;

    public function __construct()
    {
        $this->db = Connection::getInstance()->getConnection();
    }

    
}