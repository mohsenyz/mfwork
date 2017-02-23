<?php
namespace App\Terminal;
class Command{
  private $name = null;
  private $func = null;
  public static function newInstance($name, $func){
    $command = new Command;
    $command->name = $name;
    $command->func = $func;
    return $command;
  }


  public function run($args){
    if (!$args || !is_array($args)) $args = array(array());
    call_user_func_array($this->func, $args);
  }


  public function is($name){
    return $this->name == $name;
  }

  public function getName(){
    return $this->name;
  }

  public function getWork(){
    return $this->func;
  }
}
?>
