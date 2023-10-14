<?php 
namespace App\Classes;
// session_start();

class Session {

    // public static bool $isAuthenticated = false;

    public static function setFlashMessage($key, $message) {
        $_SESSION[$key] = $message;
    }

    public static function getFlashMessage($key) {
        if (isset($_SESSION[$key])) {
            $message = $_SESSION[$key];
            unset($_SESSION[$key]); // Remove the message from session after retrieval
            return $message;
        }
        return null;
    }

    public static function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public static function get($key)
    {
        if(isset($_SESSION[$key])){
            $data = $_SESSION[$key];
            return $data;
        }
        return null;
    }

    public static function isAuthenticated()
    {
        if(isset($_SESSION['user'])){
            return true;
        }else{
            return false;
        }
    }

    public static function logout()
    {
        // Unset all session variables
        $_SESSION = array();

        // Destroy the session
        session_destroy();

        header("Location: /login");
        exit;
    }


}