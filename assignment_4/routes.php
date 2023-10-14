<?php 

use App\Classes\Router;
use App\Classes\Session;
use App\Controllers\AdminController;
use App\Controllers\DepositController;
use App\Controllers\HomeController;
use App\Controllers\LoginController;
use App\Controllers\RegisterController;
use App\Controllers\TransferController;
use App\Controllers\WithdrawController;

//route for home page
Router::get('/', function(){
    (new HomeController())->home();
});

Router::get('/admin-dashboard', function(){
    (new AdminController())->home();
});

Router::get('/transactions', function(){
    (new AdminController())->transactions();
});

Router::get('/add_customer', function(){
    (new AdminController())->addCustomer();
});

Router::post('/add_customer', function(){
    (new AdminController())->storeCustomer();
});

Router::get('/customer_transactions', function(){
   (new AdminController())->customerTransactions($_GET['id']);
});

Router::get('/login', function(){
   (new LoginController())->showLoginForm(); 
});

Router::post('/login', function(){
   (new LoginController())->login(); 
});

Router::get('/register', function(){
   (new RegisterController())->showRegisterForm(); 
});

Router::post('/register', function(){
   (new RegisterController())->register(); 
});

Router::get('/logout', function(){
   Session::logout();
});

Router::get('/dashboard', function(){
   (new HomeController())->home();
});

Router::get('/deposit', function(){
   (new DepositController())->index();
});

Router::post('/deposit', function(){
   (new DepositController())->store();
});

Router::get('/withdraw', function(){
   (new WithdrawController())->index();
});

Router::post('/withdraw', function(){
   (new WithdrawController())->store();
});

Router::get('/transfer', function(){
   (new TransferController())->index();
});

Router::post('/transfer', function(){
   (new TransferController())->store();
});