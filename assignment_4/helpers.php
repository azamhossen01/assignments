<?php 

if(!function_exists('view')){
  function view(string $name, array $data=[])
  {
      extract($data);
      require(__DIR__ . "/views/$name.php");
  }
}

if(! function_exists('array_flatten')){
  function array_flatten($array) { 
    if (!is_array($array)) { 
      return false; 
    } 
    $result = array(); 
    foreach ($array as $key => $value) { 
      if (is_array($value)) { 
        $result = array_merge($result, array_flatten($value)); 
      } else { 
        $result = array_merge($result, array($key => $value));
      } 
    } 
    return $result; 
  }
}

if(! function_exists('app_dir')){
  function app_dir()
  {
    return $_SERVER['REQUEST_URI'];
    return __DIR__;
  }
}


