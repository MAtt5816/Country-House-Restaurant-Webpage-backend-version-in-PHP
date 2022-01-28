<?php
  include_once 'UserLogged.php';
  include_once 'Form.php';
  /**
   *
   */
  class Manager extends UserLogged
  {
    public $userID = 0;

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
                echo '<td class="labels"><b>'.$labels[$k].':</b> </td>';
                echo '<td>'.$value.'</td>';
                echo '</tr>';
              }
            }
            echo '</tbody>';
            echo "</table>";
            echo '<span><button type="button" name="edit" id="edit" onclick="location.href=\'panel.php?form=Konto&card=data&edit='.$val['ID'].'\'">Edytuj dane</button>';
            if($key !== 0){
              echo '<button type="button" name="delete" id="delete" onclick="location.href=\'panel.php?form=Konto&card=data&delete='.$val['ID'].'\'">Usuń dane</button>';
            }
            echo '</span>';
            echo "<hr />";
        }
      }
    }

    public function addresses($db, $uid){
      $sql = "SELECT `ID`, `user_ID`, `ulica`, `numer` FROM `adres` WHERE `user_ID` = $uid";
      $fields = ['ID','ulica','numer'];

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

      //display user address
      $labels = [
        'ulica' => 'Ulica',
        'numer' => 'Numer'
      ];
      if(!$is_error){
        foreach ($result as $key => $val){
            echo "<table id='{$val['ID']}' class='menu_cat'>";
            if($key === 0){
              echo '<caption>Adresy</caption>';
            }
            echo "<tbody>";
            foreach ($val as $k => $value) {
              if($k !== 'ID'){
                echo '<tr>';
                echo '<td class="labels"><b>'.$labels[$k].':</b> </td>';
                echo '<td>'.$value.'</td>';
                echo '</tr>';
              }
            }
            echo '</tbody>';
            echo "</table>";
            echo '<span><button type="button" name="edit" id="edit" onclick="location.href=\'panel.php?form=Konto&card=addresses&edit='.$val['ID'].'\'">Edytuj adres</button>';
            echo '<button type="button" name="delete" id="delete" onclick="location.href=\'panel.php?form=Konto&card=addresses&delete='.$val['ID'].'\'">Usuń adres</button></span>';
            echo "<hr />";
        }
      }
    }

    public function orders($db, $uid){
      $sql = ["SELECT `zamowienie`.`ID`, `zamowienie`.`data`, `zamowienie`.`typ`, `zamowienie`.`dataRealizacji`, `adres`.`ulica`, `adres`.`numer`, `dane_klienta`.`imie`,
        `dane_klienta`.`nazwisko`
        FROM `zamowienie` INNER JOIN `dane_klienta` ON zamowienie.daneKlienta_ID=dane_klienta.ID INNER JOIN `adres` ON zamowienie.adres_ID=adres.ID
        WHERE zamowienie.user_ID=$uid",
        "SELECT `zamowienie`.`ID`, `menu`.`nazwa`, `lista_pozycji`.`ilosc`
          FROM `zamowienie` INNER JOIN `lista_pozycji` ON lista_pozycji.zamowienie_ID=zamowienie.ID INNER JOIN `menu` ON lista_pozycji.menu_ID=menu.ID
          WHERE zamowienie.user_ID=$uid"
        ];

      $fields = [
        ['ID','data','typ','dataRealizacji','ulica','numer','imie','nazwisko'],
        ['ID','nazwa','ilosc']
        ];

      $result = array();
      $is_error = false;
      try{
        foreach ($sql as $key => $value) {
          if($db->select($value, $fields[$key]) != 0){
              $result[$key] = $db->select($value, $fields[$key]);
          }
          else{
              throw new Exception();
          }
        }
      }
      catch (Exception | mysqli_sql_exception $exception){
          $db->rollback();
          $is_error = true;
          echo "Błąd dostępu do bazy danych";
      }

      //display user data
      $labels = [
        'data' => 'Data złożenia',
        'typ' => 'Typ',
        'dataRealizacji' => 'Planowana data realizacji',
        'ulica' => 'Ulica',
        'numer' => 'Numer domu',
        'imie' => 'Imię',
        'nazwisko' => 'Nazwisko',
        'nazwa' => 'Potrawa',
        'ilosc' => 'Ilość'
      ];
      if(!$is_error){
        foreach ($result[0] as $key => $val){
            echo "<table id='{$val['ID']}' class='menu_cat'>";
            if($key === 0){
              echo '<caption>Zamówienia</caption>';
            }
            echo "<tbody>";

            if(is_null($val['dataRealizacji'])){
              $val['dataRealizacji'] = 'jak najszybciej';
            }
            foreach ($val as $k => $value) {
              if($k !== 'ID'){
                echo '<tr>';
                echo '<td class="labels"><b>'.$labels[$k].':</b> </td>';
                echo '<td colspan="2">'.$value.'</td>';
                echo '</tr>';
              }
            }

            foreach ($result[1] as $elem) {
              if($elem['ID'] == $val['ID']){
                echo '<tr><td class="labels"><b>Pozycje zamówienia:</b> </td>';
                echo '<td>'.$elem['nazwa'].'</td><td>'.$elem['ilosc'].'</td>';
                echo '</tr>';
              }
            }
            echo '</tbody>';
            echo "</table>";
            if($val['dataRealizacji'] > date("Y-m-d H:i:s") && $val['dataRealizacji'] !== 'jak najszybciej'){
              echo '<button type="button" name="cancel" id="cancel" onclick="location.href=\'panel.php?form=Konto&card=orders&cancel='.$val['ID'].'\'">Anuluj zamówienie</button>';
            }
            echo "<hr />";
        }
      }
    }

    //CRUD
    public function cancel($db, $id){
        $sql = "DELETE FROM `zamowienie` WHERE `zamowienie`.`ID` = {$id} AND `zamowienie`.`user_ID` = {$this->userID}";

        if($db->delete($sql)){
            echo "Usunięto z bazy";
        }
        else{
            echo "Błąd usunięcia z bazy";
        }
    }

    public function delete($db, $id){
      $sql = "";

      if($_GET['card'] == 'addresses'){
        $sql = "UPDATE `adres` SET `user_ID`=1,`ulica`='XX',`numer`='XX' WHERE `ID`={$id} AND `user_ID` = {$this->userID}";
      }
      else if($_GET['card'] == 'data'){
        $sql = "UPDATE `dane_klienta` SET `user_ID`=1,`imie`='XX',`nazwisko`='XX',`nr_tel`='XX' WHERE `ID`={$id} AND `user_ID` = {$this->userID}";
      }

      if($db->update($sql)){
        echo 'Usunięto z bazy';
      }
      else{
        echo 'Błąd dostępu do bazy';
      }
      header('Refresh: 3; panel.php?form=Konto&card=data');
    }

    public function edit_form($id){
      echo '<form action="panel.php?form=Konto&card='.$_GET['card'].'&edited=ok&edit='.$id.'" method="post">
        <fieldset class="visibility">
        <h3>Formularz edycji danych</h3>';

      if($_GET['card'] == 'addresses'){
        ?>
        <input type="text" name="street" placeholder="ulica" minlength="2" title="Podaj co najmniej dwa znaki." required><br />
        <input type="text" name="number" placeholder="nr budynku" pattern="^[A-Za-z0-9\/\. ]{,6}$" required><br />
        <?php
      }
      else if($_GET['card'] == 'data'){
        ?>
        <input type="text" name="name" placeholder="imię" pattern="^([A-Za-z][ ]?)+$" title="Podaj co najmniej dwie litery. Nie uzywaj cyfr." required><br />
        <input type="text" name="surname" placeholder="nazwisko" pattern="^([A-Za-z][ -]?)+$" title="Podaj co najmniej dwie litery. Nie uzywaj cyfr." required><br />
        <input type="text" name="phone" placeholder="nr telefonu" pattern="^\d{9}$" title="Podaj dziewięć cyfr bez spacji i innych znaków." required><br />
        <?php
      }
      ?>
      <input type="submit" name="submit" value="Zapisz zmiany">
      <input type="reset" name="reset" value="Wyczyść">
      <input type="submit" name="revoke" value="Anuluj edycję" formnovalidate>
      <?php
      echo "</fieldset></form>";
    }

    public function edit($db, $id){
      $sql = "";
      $filter = array();

      if($_GET['card'] == 'addresses'){
        $filter = [
          'street' => FILTER_SANITIZE_ADD_SLASHES,
          'number' => ['filter' => FILTER_VALIDATE_REGEXP,
            'options' => ['regexp' => '/^[A-Za-z0-9\/\. ]{0,6}|^$|^\0$/']]
        ];
      }
      else if($_GET['card'] == 'data'){
        $filter = [
          'name' => ['filter' => FILTER_VALIDATE_REGEXP,
          'options' => ['regexp' => '/^([A-Za-z][ ]?)+$/']],
          'surname' => ['filter' => FILTER_VALIDATE_REGEXP,
            'options' => ['regexp' => '/^([A-Za-z][ -]?)+$/']],
          'phone' => ['filter' => FILTER_VALIDATE_REGEXP,
            'options' => ['regexp' => '/^\d{9}$|^$|^\0$/']]
        ];
      }

      $data = Form::validation($filter);
      if($data != ""){
        $string = "";
        foreach ($data as $val){
            $string .=$val.', ';
        }

        $string = substr_replace($string, "", -2, 2);

        if($_GET['card'] == 'addresses'){
          list($street, $number) = explode(", ", $string);
          $sql = "UPDATE `adres` SET `ulica`='{$street}',`numer`='{$number}' WHERE `ID`={$id} AND `user_ID` = {$this->userID}";
        }
        else if($_GET['card'] == 'data'){
          list($name, $surname, $tel) = explode(", ", $string);
          $sql = "UPDATE `dane_klienta` SET `imie`='{$name}',`nazwisko`='{$surname}',`nr_tel`='{$tel}' WHERE `ID`={$id} AND `user_ID` = {$this->userID}";
        }

        if($db->update($sql)){
          echo "Zaktualizowano dane";
        }
        else{
          echo "Błąd aktualizacji danych";
        }
        header("Refresh: 3; panel.php?form=Konto&card={$_GET['card']}");
      }
    }

    public function show($db){
      $uid = $this->userID;
      if($uid > 0){
        if(isset($_GET['card'])){
          $card = $_GET['card'];
          if(isset($_REQUEST['cancel'])){
            $this->cancel($db, $_GET['cancel']);
          }
          else if(isset($_GET['edit'])){
            if(!isset($_GET['edited'])){
              $this->edit_form($_GET['edit']);
            }
            else if($_GET['edited'] == 'ok'){
              if(filter_input(INPUT_POST, "submit")){
                $action = filter_input(INPUT_POST, "submit");
                switch ($action){
                    case "Zapisz zmiany": {
                        $this->edit($db, $_GET['edit']);
                        break;
                    }
                    case 'Anuluj edycję':
                        header("Refresh: 0; panel.php?form=Konto&card={$_GET['card']}");
                        break;
                }
              }
            }
          }
          else if(isset($_GET['delete'])){
            $this->delete($db, $_GET['delete']);
          }
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