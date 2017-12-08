<?php
namespace App\Gate\Utils;
use Response;
class Payment{
  private $amount;
  private $authority;
  private $callback;
  private $reqUrl;
  private $extra;


  public function __construct($amount, $authority, $callback, $reqUrl, $extra = null){
    $this->amount = $amount;
    $this->authority = $authority;
    $this->callback = $callback;
    $this->reqUrl = $reqUrl;
    if ($extra != null && is_array($extra)){
      foreach ($extra as $key => $value) {
        $this->extra[$key] = $value;
      }
    }
  }


  public function getAmount(){
    return $this->amount;
  }

  public function setAmount($amount){
    $this->amount = $amount;
  }

  public function getAuthority(){
    return $this->authority;
  }

  public function setAuthority($authority){
    $this->authority = $authority;
  }


  public function getCallback(){
    return $this->callback;
  }


  public function setCallback($callback){
    $this->callback = $callback;
  }


  public function getReqUrl(){
    return $this->reqUrl;
  }


  public function setReqUrl($reqUrl){
    $this->reqUrl = $reqUrl;
  }



  public function redirect(){
    Response::redirect($this->reqUrl);
  }




}
?>
