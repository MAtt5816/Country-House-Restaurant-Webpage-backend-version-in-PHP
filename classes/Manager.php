<?php
  include_once 'UserLogged.php';
  /**
   *
   */
  class Manager extends UserLogged
  {
    protected $userID;

    function __construct(){}

    private function set_userID($uid){
      $this->userID = $uid;
    }

    public function authorization(){
      $user = unserialize($_SESSION['userID']);
      $this->userID = $user->userID;
    }
  }

?>