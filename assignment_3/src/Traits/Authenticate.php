<?php 


declare(strict_types=1);


namespace App\Traits;

use App\Classes\Auth;

trait Authenticate 
{
    private $email;
    private $success = 1;
    private $fail = 0;

    public function authUser($email,$password)
    {
        $customers = json_decode(file_get_contents('./storage/customers.json'), true) ?? [];
        $admins = json_decode(file_get_contents('./storage/admin.json'), true) ?? [];

        foreach($customers as $customer){
            if($email === $customer['email'] && $password === $customer['password']){
                $result = $this->setAuthData($customer, 'customer', $email);
                return $result;
            }
        }

        foreach($admins as $admin){
            if($email === $admin['email']){
                $result = $this->setAuthData($admin, 'admin', $email);
                return $result;
            }
        }

        return [
            'status' => $this->fail,
            'msg' => 'Credentials does not match!!!'
        ];
    }

    private function setAuthData($data, $role, $email)
    {
        $this->email = $data['email'];
        Auth::setAuthenticated(true, $role, $email);
        return [
            'status' => $this->success,
            'msg' => 'Login successfull!!!'
        ];
    }
}