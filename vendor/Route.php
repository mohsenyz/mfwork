<?php

class Route{
  public static $router = null;

  public static function get($route, $function){
    self::init();
    self::$router->map('GET', $route, $function);
  }



  public static function post($route, $function){
    self::init();
    self::$router->map('POST', $route, $function);
  }


  private static function init(){
    if (self::$router == null)
      self::$router = new AltoRouter();
  }


  public static function start(){
    if (self::$router != null){
      $match = self::$router->match();

      if( $match && is_callable( $match['target'] ) ) {
      	call_user_func_array( $match['target'], $match['params'] );
      } else {
      	header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
      }
    }
  }
}

?>
