<?php
namespace App\Terminal;
use App\Terminal\Command;
use App\Terminal\Response;
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
    if ($args == null || !is_array($args)){
      echo Response::getString('Command (' . $args[0] . ') not found!', CliColor::F_RED) . "\n";
    }
    if (!isset($args[0])){
      echo Response::getString('Command (' . $args[0] . ') not found!', CliColor::F_RED) . "\n";
    }
    foreach (self::$commands as $key => $value) {
      if ($value->is($args[0])){
        unset($args[0]);
        $value->run(array(array_values($args)));
        return;
      }
    }
    echo Response::getString('Command (' . $args[0] . ') not found!', CliColor::F_RED) . "\n";
  }
}

?>
