<?php
  $file_name = "texts/announce.txt";
  if (file_exists($file_name)){
    $array = file($file_name);
    echo '<div id="annonce_bar"><p>';
    foreach ($array as $value) {
      echo "$value"."&nbsp;&nbsp;&nbsp;***&nbsp;&nbsp;&nbsp;";
    }
    echo '</p></div>';
  }
?>
