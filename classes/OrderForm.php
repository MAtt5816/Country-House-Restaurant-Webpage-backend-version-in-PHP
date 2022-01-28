<?php
  include_once 'Menu.php';

  class OrderForm extends Menu
  {
    private $category;
    protected $filter_array = [
        'order_type' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
        'position' => ['filter' => FILTER_SANITIZE_FULL_SPECIAL_CHARS, 'flags' => FILTER_REQUIRE_ARRAY],
        'name' => ['filter' => FILTER_VALIDATE_REGEXP,
          'options' => ['regexp' => '/^([A-Za-z][ ]?)+$/']],
        'surname' => ['filter' => FILTER_VALIDATE_REGEXP,
          'options' => ['regexp' => '/^([A-Za-z][ -]?)+$/']],
        'phone' => ['filter' => FILTER_VALIDATE_REGEXP,
          'options' => ['regexp' => '/^\d{9}$|^$|^\0$/']],
        'time' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
        'hour' => ['filter' => FILTER_VALIDATE_REGEXP,
          'options' => ['regexp' => '/^\d{2}\:\d{2}$|^$|^\0$/']],
        'day' => ['filter' => FILTER_VALIDATE_REGEXP,
          'options' => ['regexp' => '/^\d{4}\-\d{2}\-\d{2}$|^$|^\0$/']],
        'street' => ['filter' => FILTER_VALIDATE_REGEXP,
          'options' => ['regexp' => '/^[A-Za-z0-9]{1}[0-9A-Za-z\/ \.\,\'-]{0,99}$|^$|^\0$/']],
        'number' => ['filter' => FILTER_VALIDATE_REGEXP,
          'options' => ['regexp' => '/^[A-Za-z0-9\/\. ]{,6}|^$|^\0$/']],
        'payment' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
        'comments' => FILTER_SANITIZE_FULL_SPECIAL_CHARS
      ];

    function __construct($category)
    {
      $this->category = $category;
      Menu::__construct($category);
      Form::__construct($this->filter_array);
    }

    public function print($db)
    {
      list($result, $key, $cat) = Menu::build_table($db);
      echo "<fieldset>";
      $content = "<legend>$cat</legend>";
      foreach ($result as $value) {
        $content .= '<input type="checkbox" name="position[]" value="'.$value['name_tag'].'" id="'.$value['name_tag'].'">';
        $content .= '<div class="menuPosition" id="div_'.$value['name_tag'].'">';
        $content .= '<label for="'.$value['name_tag'].'"><span class="menuPosition_element dish_name">';
        $content .= $value['nazwa'].'</span>';
        $content .= '<span class="menuPosition_element price">';
        $content .= $value['cena'].' zł</span></label>';
        $content .= '</div>';
      }
      echo $content;
      echo "</fieldset>";
    }

    function insertToDB($db){
      $data = $this->validation($this->filter_array);
      if($data != ""){
          $positions = "";
          foreach ($data['position'] as $val){
              $positions .= $val.",";
          }
          $positions = substr_replace($positions, "", -1);
          $data['position'] = $positions;

          if(isset($data['day']) && isset($data['hour'])){
              $datetime = $data['day']." ".$data['hour'];
              $data += ['datetime' => $datetime];
          }
          elseif (isset($data['day'])) {
              $data += ['datetime' => $data['day']];
          }
          elseif (isset($data['hour'])) {
              $data += ['datetime' => $data['hour']];
          }
          unset($data['day']);
          unset($data['hour']);

          $string = "";
          foreach ($data as $val){
              $string .='"'.$val.'", ';
          }

          $string = substr_replace($string, "", -2, 2);

          list($type, $order, $name, $surname, $tel, $realisation, $street, $number, $payment, $comment, $realisation_date) = explode(", ", $string);
          $sql = [
              "INSERT INTO `zamowienie`(`ID`, `user_ID`, `typ`, `daneKlienta_ID`, `czasRealizacji_typ`, `dataRealizacji`, `adres_ID`, `uwagi`, `platnosc`)
                  VALUES (NULL, 1, $type, 1, $realisation, STR_TO_DATE($realisation_date, \"%Y-%m-%d %H:%i\"), 1, $comment, $payment);",        //TODO  // replace static ID
              "INSERT INTO `lista_pozycji`(`zamowienie_ID`, `menu_ID`, `ilosc`)
                  VALUES (last_id, 1, 2), (last_id, 5, 3);"
          ];

          $last_id = 0;
          $is_exception = false;
          if($db->transaction()){
            try{
              if($db->insert($sql[0])){
                  $last_id = $db->last_id();
              }
              else{
                  throw new Exception();
              }

              foreach($sql as $key => $query){
                  $query = str_replace("last_id", $last_id, $query);
                  if ($key !== array_key_first($sql)){
                    if (!($db->insert($query))){
                      throw new Exception();
                    }
                  }
              }
              $db->commit();
            }
            catch (Exception | mysqli_sql_exception $exception){
                $db->rollback();
                echo "Błąd dodania do bazy";
                $is_exception = true;
            }
          }
          if(!($is_exception)){
              echo "Dodano do bazy";
          }
      }
    }

    public function choose_data($db, $uid){
      if($uid > 0){
        $sql = [
          "SELECT `dane_klienta`.`ID`, `dane_klienta`.`imie`, `dane_klienta`.`nazwisko`, `dane_klienta`.`nr_tel`
          FROM `dane_klienta` WHERE `dane_klienta`.`user_ID`={$uid}",
          "SELECT `adres`.`ID`, `adres`.`ulica`, `adres`.`numer`
          FROM `adres` WHERE `adres`.`user_ID`={$uid}"
        ];
        $fields = [['ID', 'imie','nazwisko','nr_tel'],['ID','ulica','numer']];
        $result[0] = $db->select($sql[0], $fields[0]);
        $result[1] = $db->select($sql[1], $fields[1]);

        $string = array();
        if($result !== ""){
          foreach ($result[0] as $key => $value) {
            $string[0][$key] = '<option value="'.$value['ID'].'">'.$value['imie'].' '.$value['nazwisko'].'; tel.: '.$value['nr_tel'].'</option>';
          }
          foreach ($result[1] as $key => $value) {
            $string[1][$key] = '<option value="'.$value['ID'].'">'.$value['ulica'].' '.$value['numer'].'</option>';
          }
          return $string;
        }
        else return false;
      }
    }

    public function __destruct()
    {
      Form::__destruct();
      Menu::__destruct();
    }
  }
?>
