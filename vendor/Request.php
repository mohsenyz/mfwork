<?php

namespace App;

class Request{

  public static $req = null;
  private static $server = null;

  public static function init(){
    self::$server = $_SERVER;
    self::$req = $_REQUEST;
  }

  public static function method(){
    return self::$server['REQUEST_METHOD'];
  }


  public static function isMethod($method){
    return self::$server['REQUEST_METHOD'] === $method;
  }


  public static function has($name){
    return isset(self::$req[$name]);
  }

  public static function input($name){
    if (self::has($name))
      return self::$req[$name];
    throw new Exception("input name " . $name . " doesnt exists!");
  }
}



?>
