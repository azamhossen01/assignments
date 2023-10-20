<?php 

use App\Classes\Router;
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../routes.php';
session_start();



Router::run(__DIR__);