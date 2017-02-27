<?php
use App\Request;
use App\Gate\Zarinpal;
Route::get('/', function(){
  Response::redirect("");
});



Route::get('/amoo', function(){
  $variable = "mohsen";
  if (Request::has("ali"))
    $variable = Request::input("ali");
  $payment = ZarinPal::request(100, "http://sakha-shat.ir/verify", "Just a test");
  var_dump($payment);
  $serialized = serialize($payment);
  file_put_contents('authority.ser', $serialized);
  return Response::send($payment->getAuthority() . '<br>' . $payment->getAmount() . '<br>' . $payment->getReqUrl());
  //Response::view('test', ['ali' => (memory_get_peak_usage(true)/1024/1024)]);
});

Route::get('/verify', function(){
  $payment = unserialize(file_get_contents('authority.ser'));
  $status = ZarinPal::verify($payment);
  var_dump($status);
  if ($status->isSuccess()){
    return Response::send("<h1>success<h1>" . $status->getRefId());
  }else{
    return Response::send("<h1>Failed</h1>" . $status->getStatus());
  }
});



Route::get('/amoo/[:id]/[:hello]', 'Test@ali');


?>
