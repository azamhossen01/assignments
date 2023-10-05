<?php 
// require_once './classes/Option.php';
// require_once './classes/CLIApp.php';
// require_once './classes/RegisterController.php';
// require_once './classes/LoginController.php';
// require_once './classes/Register.php';
// require_once './classes/Login.php';
// require_once './classes/Storage.php';
// require_once './classes/JsonStorage.php';

require_once __DIR__ . '/vendor/autoload.php';

use App\Classes\CLIApp;

$isAuthenticated = false;

CLIApp::run();

