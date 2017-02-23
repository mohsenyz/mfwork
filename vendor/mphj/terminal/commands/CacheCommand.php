<?php
namespace App\Terminal\Commands;
use App\Terminal\Response;
use App\Terminal\CliColor;
use App\Terminal\Console;
use App\Terminal\Args;



Console::on("cache:clear", function($_arg){

  $files = glob(__DIR__ . "/../../../../app/storage/cache/*");
  foreach($files as $file){
    if(is_file($file))
      unlink($file);
  }


  echo Response::getString('All of caches, have cleared!', CliColor::F_GREEN) . "\n";

});


?>
