<?php
namespace App;
use Exception;
class Config{
  private static $middlewares = null;
  public static function get($name, $def = null){

  }



  public static function has($name){

  }



  public static function middleware($name){
    if (isset(self::$middlewares[$name])){
      return self::$middlewares[$name];
    }
    throw new Exception('Error: middleware name ' . $name . ' not found');
  }

  public static function init(){
    self::$middlewares = require __DIR__ . '/../app/confs/middleware.php';
  }
}

?>
