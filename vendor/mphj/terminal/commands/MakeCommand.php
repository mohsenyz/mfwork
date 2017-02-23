<?php
namespace App\Terminal\Commands;
use App\Terminal\Response;
use App\Terminal\CliColor;
use App\Terminal\Console;
use App\Terminal\Args;



Console::on("make:command", function($_arg){
  if (count($_arg) == 0){
    echo Response::getString('Please enter your new command name, i dont know what to create !, try like example:', CliColor::F_RED) . "\n";
    echo Response::getString('                                         ', CliColor::F_BLACK, CliColor::B_LIGHT_GRAY) . "\n";
    echo Response::getString('  php artisan make:command MyNewCommand  ', CliColor::F_BLACK, CliColor::B_LIGHT_GRAY) . "\n";
    echo Response::getString('                                         ', CliColor::F_BLACK, CliColor::B_LIGHT_GRAY) . "\n";
    return;
  }


  $name = $_arg[0];
  $fileDir = __DIR__ . '/../../../../app/terminal/commands/' . $name . '.php';
  $fileTemplate = __DIR__ . '/../../../../app/terminal/SimpleCommand.php';
  $templateContent = file_get_contents($fileTemplate);
  $templateContent = str_replace("simplecommand", $name, $templateContent);
  file_put_contents($fileDir, $templateContent);
  echo Response::getString('New Command (' . $name . ') have created! see it in /app/terminal/commands', CliColor::F_GREEN) . "\n";
  echo Response::getString('try testing it with entering: ', CliColor::F_GREEN) . "\n";
  echo Response::getString('  php artisan ' . $name . '  ', CliColor::F_BLACK, CliColor::B_LIGHT_GRAY) . "\n";
});


?>
