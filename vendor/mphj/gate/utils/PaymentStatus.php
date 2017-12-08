<?php
namespace App\Gate\Utils;

class PaymentStatus{
  const SUCCESS = 200;
  const FAILED = 0;

  private $refId;
  private $status;
  private $shStatus;

  public function __construct($refId = null, $status = null, $shStatus){
    $this->refId = $refId;
    $this->status = $status;
    $this->shStatus = $shStatus;
  }

  public function setRefId($refId){
    $this->refId = $refId;
  }

  public function getRefId(){
    return $this->refId;
  }


  public function setStatus($status){
    $this->status = $status;
  }


  public function getStatus(){
    return $this->status;
  }

  public function isSuccess(){
    return $this->shStatus == self::SUCCESS;
  }
}

?>
