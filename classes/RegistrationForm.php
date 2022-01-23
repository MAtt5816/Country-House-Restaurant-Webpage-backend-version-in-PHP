<?php
  include_once 'Form.php';

  class RegistrationForm extends Form
  {
    protected  $filter_array = array(
      'name' => ['filter' => FILTER_VALIDATE_REGEXP,
        'options' => ['regexp' => '/^([A-Za-z][ ]?)+$/']],
      'surname' => ['filter' => FILTER_VALIDATE_REGEXP,
        'options' => ['regexp' => '/^([A-Za-z][ ]?)+$/']],
      'phone' => ['filter' => FILTER_VALIDATE_REGEXP,
        'options' => ['regexp' => '/^\d{9}$|^$|^\0$/']],
      'street' => FILTER_SANITIZE_ADD_SLASHES,
      'number' => ['filter' => FILTER_VALIDATE_REGEXP,
        'options' => ['regexp' => '/^[A-Za-z0-9\/\. ]{0,6}|^$|^\0$/']],
      'login' => FILTER_SANITIZE_ADD_SLASHES,
      'password' => FILTER_SANITIZE_ADD_SLASHES,
      'repeat' => FILTER_SANITIZE_ADD_SLASHES
    );

    function __construct()
    {
      Form::__construct($this->filter_array);
    }

    function __destruct(){
      Form::__destruct();
    }

    public function show(){
      echo '
      <form action="panel.php" method="post">
        <fieldset class="visibility">
          <h3>Formularz rejestracji</h3>
          <input type="text" name="name" placeholder="imię" pattern="^([A-Za-z][ ]?)+$" title="Podaj co najmniej dwie litery. Nie uzywaj cyfr." required><br />
          <input type="text" name="surname" placeholder="nazwisko" pattern="^([A-Za-z][ -]?)+$" title="Podaj co najmniej dwie litery. Nie uzywaj cyfr." required><br />
          <input type="text" name="phone" placeholder="nr telefonu" pattern="^\d{9}$" title="Podaj dziewięć cyfr bez spacji i innych znaków." required><br />
          <input type="text" name="street" placeholder="ulica" minlength="2" title="Podaj co najmniej dwa znaki." required><br />
          <input type="text" name="number" placeholder="nr budynku" pattern="^[A-Za-z0-9\/\. ]{,6}$" required><br />
          <input type="text" name="login" placeholder="login" pattern="^[A-Za-z0-9_]{5,65}$" title="Podaj min. 5 liter, cyfr lub zanaków - _" required><br />
          <input type="password" name="password" placeholder="hasło" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[_\W])(?!.*\s).{8,}$" title="Hasło musi zawierać min. 8 małych i wielkich liter, cyfry oraz znaki specjalne." required><br />
          <input type="password" name="repeat" placeholder="powtórz hasło" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[_\W])(?!.*\s).{8,}$" title="Hasło musi zawierać min. 8 małych i wielkich liter, cyfry oraz znaki specjalne." required>
          <input type="submit" name="submit" value="Zarejestruj">
          <input type="reset" name="reset" value="Wyczyść">
          <label for="register">Masz już konto? Zaloguj się:</label>
          <input type="submit" name="else_login" value="Zaloguj się" formnovalidate>
        </fieldset>
      </form>
      ';
    }

    public function regiter($db){
      $data = $this->validation($this->filter_array);
      if($data != ""){
        if($data['password']  == $data['repeat']){
          $data['password'] = hash('sha256', $data['password']);

          $string = "";
          foreach ($data as $value) {
            $string .='"'.$value.'", ';
          }

          $string = substr_replace($string, "", -2, 2);

          list($name, $surname, $tel, $street, $number, $login, $password, $repeat) = explode(", ", $string);

          $sql = [
              "INSERT INTO `user`(`ID`, `login`, `password`)
                  VALUES (NULL, $login, $password);",
              "INSERT INTO `dane_klienta`(`ID`, `user_ID`, `imie`, `nazwisko`, `nr_tel`)
                  VALUES (NULL, last_id, $name, $surname, $tel);" ,          //TODO remove static userID
              "INSERT INTO `adres`(`ID`, `user_ID`, `ulica`, `numer`)
                  VALUES (NULL, last_id, $street, $number);"
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
        else{
          echo "Hasła są różne!";
        }
      }
    }
  }
?>