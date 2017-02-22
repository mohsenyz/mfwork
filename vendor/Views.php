<?php

namespace App;

class View{
  private static $blade = null;
  public static function init($i){
    self::$blade = $i;
  }


  public static function make($name, $params = null){
    return self::$blade->run($name, $params);
  }
}

?>
