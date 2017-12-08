<?php
namespace App\Controller;
use App\Request;
use Response;
class Test{
  public function ali($arr, $ali){
    echo $arr . " " . $ali . "<br>";
    var_dump(Request::all());
    Response::view('test', ['ali' => (memory_get_peak_usage(true)/1024/1024)]);
  }
}

?>
