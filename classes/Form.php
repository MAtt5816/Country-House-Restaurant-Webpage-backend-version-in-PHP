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
          echo "<br>Niepoprawnie dane: " . $errors;
          return "";
      }
    }

    function insertToDB($bd){
        $data = $this->validation($this->filter_array);
        if($data != ""){
            $positions = "";
            foreach ($data['position'] as $val){
                $positions .= $val.",";
            }
            $positions = substr_replace($positions, "", -1);
            $data['position'] = $positions;

            $string = "";
            foreach ($data as $val){
                $string .='"'.$val.'", ';
            }
            $string = substr_replace($string, "", -2, 2);
        //    $sql = "INSERT INTO klienci (`Id`, `Nazwisko`, `Panstwo`, `Zamowienie`, `Wiek`, `Email`, `Platnosc`) VALUES (NULL, $string);";   //TODO
            if($bd->insert($sql)){
                echo "Dodano do bazy";
            }
            else{
              echo "Błąd dodania do bazy";
            }
        }
    }

    function __destruct()
    {}
  }

?>
