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
  return ZarinPal::request(3000, "http://google.com", "Just a test")->redirect();
  //Response::view('test', ['ali' => (memory_get_peak_usage(true)/1024/1024)]);
});



Route::get('/amoo/[:id]/[:hello]', 'Test@ali');


?>
