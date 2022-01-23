<?php
  include_once 'UserLogged.php';
  /**
   *
   */
  class Manager extends UserLogged
  {
    protected $userID = 0;

    function __construct(){}

    private function set_userID($uid){
      $this->userID = $uid;
    }

    public function authorization(){
      $user = unserialize($_SESSION['userID']);
      $this->userID = $user->userID;
    }

    public function main($db, $uid){
      $sql = "SELECT `imie` FROM `dane_klienta` WHERE `user_ID` = $uid";
      $fields = ['imie'];

      try{
        if($db->select($sql, $fields) != 0){
            $result = $db->select($sql, $fields);
        }
        else{
            throw new Exception();
        }
      }
      catch (Exception | mysqli_sql_exception $exception){
          $db->rollback();
          echo "Błąd dostępu do bazy danych";
      }

      $name = $result[0]['imie'];

      echo '
      <div id="welcome">
        Witaj, '.$name.'!
      </div>
      ';
      ?>
        <button type="button" name="data" id="data" onclick="location.href='panel.php?form=Konto&card=data'">Twoje dane</button>
        <button type="button" name="addresses" id="addresses" onclick="location.href='panel.php?form=Konto&card=addresses'">Twoje adresy</button>
        <button type="button" name="orders" id="orders" onclick="location.href='panel.php?form=Konto&card=orders'">Twoje zamówienia</button>
      <?php
    }

    public function data($db, $uid){
      $sql = "SELECT `ID`, `imie`, `nazwisko`, `nr_tel` FROM `dane_klienta` WHERE `user_ID` = $uid";
      $fields = ['ID','imie','nazwisko','nr_tel'];

      $result = array();
      $is_error = false;
      try{
        if($db->select($sql, $fields) != 0){
            $result = $db->select($sql, $fields);
        }
        else{
            throw new Exception();
        }
      }
      catch (Exception | mysqli_sql_exception $exception){
          $db->rollback();
          $is_error = true;
          echo "Błąd dostępu do bazy danych";
      }

      //display user data
      $labels = [
        'imie' => 'Imię',
        'nazwisko' => 'Nazwisko',
        'nr_tel' => 'Numer telefonu'
      ];
      if(!$is_error){
        foreach ($result as $key => $val){
            echo "<table id='{$val['ID']}' class='menu_cat'>";
            if($key === 0){
              echo '<caption>Dane użytkownika</caption>';
            }
            echo "<tbody>";
            foreach ($val as $k => $value) {
              if($k !== 'ID'){
                echo '<tr>';
                echo '<td><b>'.$labels[$k].'</b>: </td>';
                echo '<td>'.$value.'</td>';
                echo '</tr>';
              }
            }
            echo '</tbody>';
            echo "</table>";
        }
      }
    }

    public function addresses($db, $uid){

    }

    public function orders($db, $uid){

    }

    public function show($db){
      $uid = $this->userID;
      if($uid > 0){
        if(isset($_GET['card'])){
          $card = $_GET['card'];
          switch ($card) {
            case 'data':
              $this->data($db, $uid);
              break;
            case 'addresses':
              $this->addresses($db, $uid);
              break;
            case 'orders':
              $this->orders($db, $uid);
              break;
            default:
              break;
          }
        }
        else{
          $this->main($db, $uid);
        }
      }
    }
  }
?>