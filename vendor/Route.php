<?php
use App\Request;
use App\Config;
class Route{
  private static $router = null;

  public static function get($route, $function, $middleware = null){
    self::init();
    self::$router->map('GET', $route, $function, null, $middleware);
  }



  public static function post($route, $function, $middleware = null){
    self::init();
    self::$router->map('POST', $route, $function, null, $middleware);
  }


  private static function init(){
    if (self::$router == null)
      self::$router = new AltoRouter();
  }


  public static function start(){
    if (self::$router != null){
      $match = self::$router->match();
      if ($match){
        Request::setParams($match['params']);
        if ($match['middleware'] != null && is_array($match['middleware'])){
          if (!self::checkRequestMiddleware($match['middleware'])){
            return;
          }
        }
      }
      if( $match && is_callable( $match['target'] ) ) {
      	call_user_func_array( $match['target'], $match['params'] );
      } else if($match && is_string($match['target'])) {
        $arr = explode('@', $match['target']);
        $className = '\\App\\Controller\\' . $arr[0];
        $obj = new $className;
        call_user_func_array(array($obj, $arr[1]), $match['params']);
      } else {
      	header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
      }
    }
  }



  private static function checkRequestMiddleware($middleware){
    $isValid = true;
    foreach ($middleware as $key => $value) {
      $params = array();
      $middlewareName = $value;
      if (mphj_contains($value, ':')){
        $arr_value = explode(':', $value);
        $param = $arr_value[1];
        $middlewareName = $arr_value[0];
        if (mphj_contains($param, ',')){
          $arr_params = explode(',', $param);
          foreach ($arr_params as $key => $arr_param) {
            $params[] = $arr_param;
          }
        }else{
          $params[] = $param;
        }
      }
      $middlewareClass = Config::middleware($middlewareName);
      $result = call_user_func_array(array($middlewareClass, 'check'), $params);
      if (!$result)
        $isValid = false;
    }
    return $isValid;
  }
}

?>
