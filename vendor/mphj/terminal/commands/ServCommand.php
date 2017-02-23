<?php
namespace App\Terminal\Commands;
use App\Terminal\Response;
use App\Terminal\CliColor;
use App\Terminal\Console;
use App\Terminal\Args;



Console::on("serv", function($_arg){
  $arg = [
    'host' => 'localhost',
    'port' => '8080'
  ];
  Args::parse($_arg, function($name, $value){
    $arg[$name] = $value;
  });

  echo Response::getString('MFWork is starting on port ' . $arg['port'] . '!', CliColor::F_GREEN) . "\n";
  echo shell_exec('php -S ' . $arg['host'] . ':' . $arg['port']);
});
