<?php
namespace App\Terminal\Commands;
use App\Terminal\Response;
use App\Terminal\CliColor;
use App\Terminal\Console;
use App\Terminal\Args;



Console::on("cache:clear", function($_arg){

  deleteDir(__DIR__ . "/../../../../app/storage/cache");


  echo Response::getString('All of caches, have cleared!', CliColor::F_GREEN) . "\n";

});


?>
