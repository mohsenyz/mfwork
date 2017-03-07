<?php

namespace App;
use stdClass;
class Request extends stdClass{

  private static $req = null;
  private static $server = null;
  private static $params = null;
  private static $files = null;

  public static function init(){
    self::$server = $_SERVER;
    self::$req = $_REQUEST;
    self::$files = $_FILES;
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

  public static function hasFile($name){
    return isset(self::$files[$name]);
  }

  public static function input($name){
    if (self::has($name))
      return self::$req[$name];
    throw new Exception("input name " . $name . " doesnt exists!");
  }


  public static function setParams($par){
    self::$params = $par;
  }


  public static function getParams(){
    return self::$params;
  }

  public static function getParam($name){
    if (self::hasParam($name))
      return self::$params[$name];
    throw new Exception("parameter name " . $name . " doesnt exists!");
  }


  public static function addParam($name, $value){
    self::$params[$name] = $value;
  }


  public static function hasParam($name){
    return isset(self::$params[$name]);
  }


  public static function all(){
    return self::$req;
  }


  public static function getHeaders(){
    return get_headers();
  }


  public static function getHeader($name){
    return self::getHeaders()[$name];
  }
}



?>
