<?php
namespace App\Terminal;
class Args{
  public static function parse($args, $func){
    foreach ($args as $key => $value) {
      $arr = explode("=", $value);
      if (count($arr) == 2){
        $commandName = ltrim($arr[0], '-');
        $commandValue = $arr[1];
        $func($commandName, $commandValue);
      }else{
        $func($value, null);
      }
    }
  }
}
?>
