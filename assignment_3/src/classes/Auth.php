<?php 

namespace App\Classes;

class Auth 
{
    private static $isAuthenticated = false;
    private static $role;
    private static $email;

    public static function setAuthenticated($value, $role, $email)
    {
        self::$isAuthenticated = $value;
        self::$role = $role;
        self::$email = $email;
    }

    public static function authenticated()
    {
        return [
            "isAuthenticated" => self::$isAuthenticated,
            "role" => self::$role,
            "email" => self::$email 
        ];
    }
}