<?php 

declare(strict_types=1);

namespace App\Classes;



class LoginController 
{
    private $email,$password;
    private const SUCCESS = 1;
    private const FAIL = 0;
    
    public function __construct(string $email, string $password)
    {
        $this->email = $email;
        $this->password = $password;
    }

    public function login()
    {

        if($this->checkEmptyInput() === self::FAIL){
            return [
                'status' => self::FAIL,
                'msg' => "Insert all the fields.\n"
            ];
        }else if($this->checkValidEmail() === self::FAIL){
            return [
                'status' => self::FAIL,
                'msg' => "Insert valid email.\n"
            ];
        }else{
            $data = (new Login($this->email,$this->password))->LoginUser();
            return $data;
            // return [
            //     'status' => self::SUCCESS,
            //     'msg' => "User login successful.\n"
            // ];
        }
    }

    private function checkEmptyInput()
    {
        if(empty($this->email)  || empty($this->password) ){
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

    

    
}