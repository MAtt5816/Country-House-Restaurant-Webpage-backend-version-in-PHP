<?php
  /**
   *
   */
  class Form
  {
    protected $filter_array = array();

    function __construct($filter_array)
    {
      $this->filter_array = $filter_array;
    }

    public function validation($filter_array){
      $args = $filter_array;
      $data = filter_input_array(INPUT_POST, $args);

      $errors = "";
      foreach ($data as $key => $val) {
        //  if ($val === false or $val === NULL) {
            if ($val === false){
              $errors .= $key . " ";
          }
      }
      if ($errors === "") {
          return $data;
      } else {
          echo "<br>Niepoprawnie dane: " . $errors;
          return "";
      }
    }

    function insertToDB($bd)
    {}

    function __destruct()
    {}
  }

?>
