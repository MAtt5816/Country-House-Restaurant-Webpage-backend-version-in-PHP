<?php
  /**
   *
   */
  class Form
  {
    function __construct()
    {}

    public function validation($filter_array){
      $args = $filter_array;
      $data = filter_input_array(INPUT_POST, $args);
      var_dump($dane);   //tmp func.
      echo "<br />";    //tmp

      $errors = "";
      foreach ($data as $key => $val) {
          if ($val === false or $val === NULL) {
              $errors .= $key . " ";
          }
      }
      if ($errors === "") {
          return $data;
      } else {
          echo "<br>Nie poprawnie dane: " . $errors;
          return "";
      }
    }

    function __destruct()
    {}
  }

?>
