<?php
namespace App\Terminal\Commands;
use App\Terminal\Response;
use App\Terminal\CliColor;
use App\Terminal\Console;
use App\Terminal\Args;
use App\Config;


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
  if (file_exists($fileDir)){
    echo Response::getString('File ' . $name . '.php already exists in command folder', CliColor::F_RED) . "\n";
    return;
  }
  $fileTemplate = __DIR__ . '/../../../../app/terminal/SimpleCommand.php';
  $templateContent = file_get_contents($fileTemplate);
  $templateContent = str_replace("simplecommand", $name, $templateContent);
  file_put_contents($fileDir, $templateContent);
  echo Response::getString('New Command (' . $name . ') have created! see it in /app/terminal/commands', CliColor::F_GREEN) . "\n";
  echo Response::getString('try testing it with entering: ', CliColor::F_GREEN) . "\n";
  echo Response::getString('  php artisan ' . $name . '  ', CliColor::F_BLACK, CliColor::B_LIGHT_GRAY) . "\n";
});





Console::on('make:middleware', function($_arg){
  if (count($_arg) == 0){
    echo Response::getString('Please enter your new middleware name, i dont know what to create !, try like example:', CliColor::F_RED) . "\n";
    echo Response::getString('                                                         ', CliColor::F_BLACK, CliColor::B_LIGHT_GRAY) . "\n";
    echo Response::getString('  php artisan make:middleware MyNewMiddleware shortName  ', CliColor::F_BLACK, CliColor::B_LIGHT_GRAY) . "\n";
    echo Response::getString('                                                         ', CliColor::F_BLACK, CliColor::B_LIGHT_GRAY) . "\n";
    return;
  }


  $name = $_arg[0];
  $fileDir = __DIR__ . '/../../../../app/http/middleware/' . $name . '.php';
  if (file_exists($fileDir)){
    echo Response::getString('File ' . $name . '.php already exists in middleware folder', CliColor::F_RED) . "\n";
    return;
  }
  $fileTemplate = __DIR__ . '/../../../../app/http/middleware/Middleware.php';
  $confFile = __DIR__ . '/../../../../app/confs/middleware.php';
  $templateContent = file_get_contents($fileTemplate);
  $templateContent = str_replace("SimpleMiddleware", $name, $templateContent);
  if (isset($_arg[1])){
    if (Config::hasMiddleware($_arg[1])){
      echo Response::getString('Middleware ' . $_arg[1] . ' already defined in confs/middleware.php', CliColor::F_RED) . "\n";
      return;
    }
    $shortName = $_arg[1];
    mphj_add_line_after_line($confFile, "  '" . $shortName . "' => App\\Middleware\\" . $name . "::class,", 4);
  }
  file_put_contents($fileDir, $templateContent);
  echo Response::getString('New middleware (' . $name . ') have created! see it in /app/http/middleware', CliColor::F_GREEN) . "\n";
  if (!isset($_arg[1])){
    echo Response::getString('!!!    Never forget to add your middleware in app/confs/middleware.php    !!!', CliColor::F_YELLOW, CliColor::B_GREEN) . "\n";
  }
});


?>
