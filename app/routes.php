<?php
use App\Request;
use App\Config;
Route::get('/', function(){
  Response::send("Hello world + iran :sweat_smile:");
});



Route::get('/amoo', function(){
  Response::view('test', ['ali' => (memory_get_peak_usage(true)/1024/1024)]);
});




Route::get('/amoo/[:id]/[:hello]', 'Test@ali');


?>
