<?php 

namespace App\Controllers;

use App\Models\User;
use App\Classes\Session;
use App\Classes\Validation;

class LoginController extends Controller 
{

    public function __construct()
    {
        if(Session::isAuthenticated()){
            header("Location: /dashboard");
        }
        parent::__construct();
    }

    public function showLoginForm()
    {
        return view('login');
    }

    public function login()
    {
        $data = $_POST;
        $validator = new Validation($data);
        $rules = [
            'email' => 'required|email',
            'password' => 'required'
        ];
        $validator->validate($rules);
        $errors = $validator->errors();
        // var_dump($errors);
        // die();
        if (!empty($errors)) {
            Session::setFlashMessage('error', $errors);
            header("Location: /login");
        } else {
            $user = new User($data);
            $user = $user->loginUser();
            if(!empty($user)){
                Session::set('user', $user);
                Session::setFlashMessage('success', 'User log in successful');
                if($_SESSION['user']['type'] === 'admin'){
                    header("Location: /admin-dashboard");
                }else{
                    header("Location: /dashboard");
                }
                
            }else{
                Session::setFlashMessage('error', "Login failed. Please check your email and password.");
                header("Location: /login");
            }
            
        }
    }
}