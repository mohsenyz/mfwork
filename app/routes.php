<?php
use App\Request;

Route::get('/', function(){
  echo "ali";
  Response::redirect("http://google.com/");
});



Route::get('/amoo', function(){
  $variable = "mohsen";
  if (Request::has("ali"))
    $variable = Request::input("ali");
  Response::view('test', ['ali' => (memory_get_peak_usage(true)/1024/1024)]);
});



Route::get('/amoo/[:id]/[:hello]', "Test@ali");


?>
