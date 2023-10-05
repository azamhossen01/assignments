<?php 

declare(strict_types=1);

namespace App\Classes;



class RegisterController 
{
    private $name,$email,$password;
    private const SUCCESS = 1;
    private const FAIL = 0;
    private array $customers;
    
    public function __construct(string $name, string $email, string $password)
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->customers = (new JsonStorage())->load('customers');
    }

    public function register()
    {

        if($this->checkEmptyInput() === self::FAIL){
            return [
                'status' => self::FAIL,
                'msg' => "Insert all the fields.\n"
            ];
        }elseif($this->checkValidEmail() === self::FAIL){
            return [
                'status' => self::FAIL,
                'msg' => "Insert valid email.\n"
            ];
        }elseif($this->checkEmailExists() === self::FAIL){
            return [
                'status' => self::FAIL,
                'msg' => "Email is already exists.\n"
            ];
        }else{
            $this->customers[] = [
                'name' => $this->name,
                'email' => $this->email,
                'password' => $this->password
            ];
            (new JsonStorage())->save('customers',$this->customers);
            return [
                'status' => self::SUCCESS,
                'msg' => "User registration successful.\n"
            ];
        }
    }

    private function checkEmptyInput()
    {
        if(empty($this->name) || empty($this->email)  || empty($this->password) ){
            return self::FAIL;
        }else{
            return self::SUCCESS;
        }
    }

    private function checkValidEmail()
    {
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            return self::FAIL;
          }else{
            return self::SUCCESS;
          }
    }

    private function checkEmailExists()
    {
        $old_data = (new JsonStorage())->load('customers');
        foreach($old_data as $key=>$customer){
            if($customer['email'] === $this->email){
                return self::FAIL;
            }
        }
        return self::SUCCESS;
    }

    
}