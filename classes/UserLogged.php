<?php
  /**
   *
   */
  class UserLogged
  {
    private $userID;
    function __construct($userID)
    {
      $this->userID = $userID;
      session_start();
      $_SESSION['userID'] = $userID;
    }

    function __destruct()
    {
      $_SESSION = [];
      if (filter_input(INPUT_COOKIE, session_name())) {
        setcookie(session_name(), '', time() - 42000, '/');
      }
      session_destroy();
    }
  }

?>