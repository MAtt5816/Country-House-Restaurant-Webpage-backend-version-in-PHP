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
    public function show($db){
      $uid = $this->userID;
      if($uid > 0){
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
          <button type="submit" name="load" id="load">Twoje dane</button>
          <button type="submit" name="load" id="load">Twoje adresy</button>
          <button type="submit" name="load" id="load">Twoje zamówienia</button>
        <?php
      }
    }
  }
?>