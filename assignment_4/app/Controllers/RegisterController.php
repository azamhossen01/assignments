<?php 

namespace App\Controllers;

use App\Models\User;
use App\Models\Deposit;
use App\Classes\Session;
use App\Classes\Validation;

class RegisterController extends Controller 
{
    public function __construct()
    {
        if(Session::isAuthenticated()){
            header("Location: /dashboard");
        }
        parent::__construct();
    }
    public function showRegisterForm()
    {
        return view('register');
    }

    public function register()
    {
        $data = $_POST;
        $rules = [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6|max:12',
        ];
        
        $validator = new Validation($data);
        $validator->validate($rules);

        
        $errors = $validator->errors();
        
        if (!empty($errors)) {
            Session::setFlashMessage('error', $errors);
            header("Location: /register");
        } else {
            $user = new User($data);
            $user_id = $user->create($data);
            $data = [
                'user_id' => $user_id,
                'amount' => 0,
                'type' => 'initial',
                'in_out' => 'in',
                'balance' => 0
            ];
            (new Deposit())->store($data);
            Session::setFlashMessage('success', 'User registration successful');
            header("Location: /login");
        }


    }
}