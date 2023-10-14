<?php 

use App\Classes\Connection;
use App\Database\Migration;

require_once './vendor/autoload.php';


$migration = new Migration(Connection::getInstance()->getConnection());

$migration->run();