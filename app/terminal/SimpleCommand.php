<?php
namespace App\Terminal\Commands;
use App\Terminal\Response;
use App\Terminal\CliColor;
use App\Terminal\Console;
use App\Terminal\Args;


/**
  * CommadLine command
  */


Console::on("simplecommand", function($_arg){

  /*
  ---------- SIMPLE ARGUMNET HANDLING TUTORIAL ----------
  $GLOBALS['arg'] = [
    'host' => 'localhost',
    'port' => '8080'
  ];
  Args::parse($_arg, function($name, $value){
    $GLOBALS['arg'][$name] = $value;
  });

  $arg = $GLOBALS['arg'];

  */


  echo Response::getString('Be happy :-/, it is working :-)', CliColor::F_GREEN) . "\n";

});


?>
