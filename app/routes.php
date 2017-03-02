<?php
use App\Request;
Route::get('/', function(){
  Response::send("welcome");
});



Route::get('/amoo', function(){
  Response::view('test', ['ali' => (memory_get_peak_usage(true)/1024/1024)]);
});




Route::get('/amoo/[:id]/[:hello]', 'Test@ali');


?>
