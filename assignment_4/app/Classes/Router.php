<?php 

namespace App\Classes;

use Closure;

class Router 
{
    private static array $lists = [];

    public static function get(string $page, Closure $closure)
    {
        static::$lists[] = [
            'page' => $page,
            'method' => 'GET',
            'logic' => $closure
        ];
    }

    public static function post(string $page, Closure $closure)
    {
        static::$lists[] = [
            'page' => $page,
            'method' => 'POST',
            'logic' => $closure
        ];
    }

    public static function run()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $page = trim(explode("?", $_SERVER['REQUEST_URI'])[0], '/');
        // $page = trim($_SERVER['REQUEST_URI'], '/');
        // $params = explode("?", $_SERVER['REQUEST_URI'])[1] ?? [];
        foreach(self::$lists as $item)
        {
            
                // echo $page . '==' . trim($item['page'],'/') . "<br>";
            if($page === trim($item['page'], '/') && $method === $item['method'])
            {
                $item['logic']();
                return;
            }
            
        }
        die('Not Found!');
    }
}