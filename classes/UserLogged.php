<?php
  /**
   *
   */
  class UserLogged
  {
    private $userID;
    private $sessionID;
    function __construct($userID)
    {
      $this->userID = $userID;
    }

    public function login(){
      session_start();
      $this->sessionID = session_id();
      $user = new UserLogged($userID);
      $_SESSION['userID'] = serialize($user);
    }

    public function logout()
    {
      $_SESSION = [];
      if (filter_input(INPUT_COOKIE, session_name())) {
        setcookie(session_name(), '', time() - 42000, '/');
      }
      session_destroy();
    }
  }
?>