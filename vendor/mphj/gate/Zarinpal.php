<?php
namespace App\Gate;
use App\Gate\Utils\Payment;
use App\Gate\Utils\PaymentStatus;
use App\Config;
use Exception;
class Zarinpal{


  public static function request($amount, $url, $dec){
    $data = array('MerchantID' => Config::get('gate.MerchantID'),
      'Amount' => $amount,
      'CallbackURL' => $url,
      'Description' => $dec);
    $jsonData = json_encode($data);
    $ch = curl_init('https://www.zarinpal.com/pg/rest/WebGate/PaymentRequest.json');
    curl_setopt($ch, CURLOPT_USERAGENT, 'ZarinPal Rest Api v1');
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
      'Content-Type: application/json',
      'Content-Length: ' . strlen($jsonData)
    ));
    $result = curl_exec($ch);
    $err = curl_error($ch);
    $result = json_decode($result, true);
    curl_close($ch);
    if ($err) {
      throw new Exception("cURL Error #:" . $err);
    } else {
      if ($result["Status"] == 100) {
        $reqUrl = 'https://www.zarinpal.com/pg/StartPay/' . $result["Authority"];
        return new Payment($amount, $result["Authority"], $url, $reqUrl, $dec);
      } else {
        return null;
      }
    }
  }





  public static function verify($payment){
    $Authority = $payment->getAuthority();
    $data = array('MerchantID' => Config::get('gate.MerchantID'), 'Authority' => $Authority, 'Amount' => $payment->getAmount());
    $jsonData = json_encode($data);
    $ch = curl_init('https://www.zarinpal.com/pg/rest/WebGate/PaymentVerification.json');
    curl_setopt($ch, CURLOPT_USERAGENT, 'ZarinPal Rest Api v1');
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
      'Content-Type: application/json',
      'Content-Length: ' . strlen($jsonData)
    ));
    $result = curl_exec($ch);
    $err = curl_error($ch);
    curl_close($ch);
    $result = json_decode($result, true);
    if ($err) {
      throw new Exception("cURL Error #:" . $err);
    } else {
      if ($result['Status'] == 100) {
        return new PaymentStatus($result['RefID'], $result['Status'], PaymentStatus::SUCCESS);
      } else {
        return new PaymentStatus(null, $result['Status'], PaymentStatus::FAILED);
      }
    }
  }
}

?>
