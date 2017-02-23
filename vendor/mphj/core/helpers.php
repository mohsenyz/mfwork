<?php

function mphj_import($arr){
  foreach ($arr as $key => $value) {
    if (substr($value, -1) == "*"){
      $dir = str_replace("*", "", $value);
      $dir = str_replace(".", "/", $dir);
      $dir = str_replace("!", "..", $dir);
      mphj_import_dir($dir);
    }
  }
}


function mphj_import_dir($dir){
  $dh = opendir($dir);
  if ($dh){
    while (($file = readdir($dh)) !== false){
      if (is_file($dir . $file)){
        require_once $dir . $file;
      }
    }
    closedir($dh);
  }
}



function mphj_import_file($file){
  $len = substr_count($file, "/") - 1;
  $file = str_replace(".", "/", $file, $len);
  require_once $file . ".php";
}


function mphj_contains($a, $b){
  return strpos($a, $b) !== false;
}



function mphj_add_line_after_line($file, $line, $pos){
  $contents = file($file, FILE_IGNORE_NEW_LINES);
  if($pos > sizeof($contents)) {
    $pos = sizeof($contents) + 1;
  }
  array_splice($contents, $pos - 1, 0, array($line));
  $contents = implode("\n", $contents);
  file_put_contents($file, $contents);
}

?>
