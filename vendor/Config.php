<?php
namespace App;
use Exception;
class Config{
  private static $middlewares = null;
  public static function get($name, $def = null){
    $arr = explode('.', $name);
    $confName = __DIR__ . '/../app/confs/' . $arr[0] . '.php';
    if (file_exists($confName)){
      $vars = require $confName;
      if (isset($vars[$arr[1]])){
        return $vars[$arr[1]];
      }
    }
    return $def;
  }



  public static function has($name){
    if (self::get($name, null) != null){
      return true;
    }
    return false;
  }



  public static function middleware($name){
    if (isset(self::$middlewares[$name])){
      return self::$middlewares[$name];
    }
    throw new Exception('Error: middleware name ' . $name . ' not found');
  }


  public static function hasMiddleware($name){
    return isset(self::$middlewares[$name]);
  }

  public static function init(){
    self::$middlewares = require __DIR__ . '/../app/confs/middleware.php';
  }
}

?>
