<?php
namespace App\Terminal\Commands;
use App\Terminal\Response;
use App\Terminal\CliColor;
use App\Terminal\Console;
use App\Terminal\Args;



Console::on("serv", function($_arg){
  $GLOBALS['arg'] = [
    'host' => 'localhost',
    'port' => '8080'
  ];
  Args::parse($_arg, function($name, $value){
    $GLOBALS['arg'][$name] = $value;
  });

  $arg = $GLOBALS['arg'];


  echo Response::getString('MFWork is starting on port ' . $arg['port'] . '!', CliColor::F_GREEN) . "\n\n";
  $output = @exec('php -S ' . $arg['host'] . ':' . $arg['port'], $o, $return);
  if ($return){
    echo "\n" . Response::getString('MFWork is not running :-(', CliColor::F_RED) . "\n";
  }
});


?>
