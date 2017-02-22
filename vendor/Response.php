<?php
use Http\DataTypes;
use App\View;
class Response{

  /*private static $codes = [
    200 => "SUCCESS",
    500 => "SERVER ERROR",
    404 => "NOT FOUND",
    401 => "UN AUTHORIZED"
  ];*/


  public static function send($msg, $status = 200){
    if (is_string($msg)){
      echo $msg;
      self::sendContentType(DataTypes.HTML);
    }
    if (is_array($msg)){
      echo json_encode($msg);
      self::sendContentType(DataTypes.JSON);
    }
    self::sendStatus($status);
  }



  public static function view($name, $params = null, $status = 200){
    echo View::make($name, $params);
    self::sendContentType(DataTypes.HTML);
    self::sendStatus($status);
  }



  private static function sendStatus($status){
    header('HTTP/1.1 ' . $status, true, $status);
  }


  private static function sendContentType($type){
    header('Content-type: ' . $type);
  }
}


?>
