<?php
  include_once 'Form.php';
  include_once 'UserLogged.php';

  class LoginForm extends Form
  {
    protected  $filter_array = array(
      'login' => FILTER_SANITIZE_ADD_SLASHES,
      'passwd' => FILTER_SANITIZE_ADD_SLASHES
    );

    function __construct()
    {
      echo '
          <h3>Formularz logowania</h3>
          <input type="text" name="login" placeholder="login" required><br />
          <input type="password" name="passwd" placeholder="password" required>
          <input type="submit" name="submit" value="Zaloguj">
          <input type="reset" name="reset" value="Wyczyść">
          <label for="register">Nie masz konta? Załóż je:</label>
          <input type="submit" name="register" value="Zarejestruj się" formnovalidate>
      ';

      Form::__construct($this->filter_array);
    }

    function __destruct(){
      Form::__destruct();
    }

    public function login($db){
      $data = $this->validation($this->filter_array);
      if($data != ""){
        $login = $data['login'];
        $pass = hash('sha256', $data['passwd']);

        $sql = "SELECT `ID`, `password` FROM `user` WHERE `login` LIKE '{$login}'";
        $fields = ['ID','password'];
        $result = array();
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
            echo "Błąd logowania";
        }

        if(!empty($result)){
          $value = $result[0];
          $userID = $value['ID'];
          $password = $value['password'];
          if($pass === $password){
            $log = new UserLogged($userID);
            $log->login();
            header("Refresh:0");
          }
          else{
            echo 'Niewłaściwe dane logowania';
          }
        }
      }
    }

    public function logout(){
      UserLogged::logout();
    }
  }
?>