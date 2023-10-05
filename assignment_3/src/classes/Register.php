<?php 

namespace App\Classes;

class Register 
{
    // private $name,$email,$password;
    private $data = [];
    public function __construct($name,$email,$password)
    {
        $this->data = [
            'name' => $name,
            'email' => $email,
            'password' => $password
        ];
    }

    public function RegisterUser()
    {
       $data = (new JsonStorage())->save('customers',$this->data);
       return $data;
    }
}