<?php
namespace App\Terminal;

class Response{

  public function getString($string, $foreground_color = null, $background_color = null) {
    $colored_string = "";
    if ($foreground_color != null) {
      $colored_string .= "\033[" . $foreground_color . "m";
    }
    if ($background_color != null) {
      $colored_string .= "\033[" . $background_color . "m";
    }
		$colored_string .=  $string . "\033[0m";
		return $colored_string;
	}

}

?>
