<?php
namespace App\Terminal;
use App\Terminal\Command;
class Console{
  public static $commands = array();
  public static function on($commandName, $func){
    foreach (self::$commands as $key => $value) {
      if ($value->is($commandName)){
        return;
      }
    }
    self::$commands[] = Command::newInstance($commandName, $func);
  }


  public static function unregister($commandName){
    foreach (self::$commands as $key => $value) {
      if ($value->is($commandName)){
        unset($value);
      }
    }
  }

  public static function start($args){
    if (!isset($args[0])) $args[0] = 'help';
    foreach (self::$commands as $key => $value) {
      if ($value->is($args[0])){
        unset($args[0]);
        $value->run(array_values($args));
      }
    }
  }
}

?>
