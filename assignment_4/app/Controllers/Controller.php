<?php 

namespace App\Controllers;

use App\Classes\Connection;

class Controller 
{
    protected $db;

    public function __construct()
    {
        $this->db = Connection::getInstance()->getConnection();
    }
    
    public function view($page)
    {
        $rootDirectory = $_SERVER['DOCUMENT_ROOT'];
        include($rootDirectory . '/../views/' . $page);
    }
}