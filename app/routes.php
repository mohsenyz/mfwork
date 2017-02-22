<?php
use App\Request;

Route::get('/', function(){
  echo "ali";
});



Route::get('/amoo', function(){
  $variable = "mohsen";
  if (Request::has("ali"))
    $variable = Request::input("ali");
  Response::view('test', ['ali' => $variable]);
});


Route::get('/amoo/[:id]/[:hello]', function($all, $hh){
  echo "amoo" . $all . "<br>" . $hh;
});


?>
