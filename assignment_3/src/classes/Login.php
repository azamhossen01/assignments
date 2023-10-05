<?php 


namespace App\Classes;
use App\Traits\Authenticate;

class Login 
{
    use Authenticate;
    private $email,$password;
    public function __construct($email,$password)
    {
        $this->email = $email;
        $this->password = $password;
    }

    public function LoginUser()
    {
        $trait_data = $this->authUser($this->email, $this->password);
        return $trait_data;
    //    $data = (new JsonStorage())->save('customers',$this->data);
    //    return $data;
    }
}