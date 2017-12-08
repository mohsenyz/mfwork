<?php
namespace App\Middleware;
use App\Request;
use Response;


/**
  * Middleware
  */

class SimpleMiddleware{

  public function check(){
    /**
      * Check request, if it was incorrect request return false;
      */
    return true;
  }
}


?>
