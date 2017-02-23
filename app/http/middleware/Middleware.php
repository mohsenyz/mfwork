<?php
namespace App\Middleware;
use App\Request;
use Response;
class Middleware{
  public static function check(){
    if (Request::getParam('id') == 2){
      Response::send(['status' => 403]);
      return false;
    }
    return true;
  }
}


?>
