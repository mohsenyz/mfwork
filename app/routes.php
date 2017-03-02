<?php
use App\Request;
use App\Config;
Route::get('/', function(){
  Response::send(Config::get('cache.drivers.file.dir'));
});



Route::get('/amoo', function(){
  Response::view('test', ['ali' => (memory_get_peak_usage(true)/1024/1024)]);
});




Route::get('/amoo/[:id]/[:hello]', 'Test@ali');


?>
