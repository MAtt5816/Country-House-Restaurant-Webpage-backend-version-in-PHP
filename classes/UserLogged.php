<?php
  /**
   *
   */
  class UserLogged
  {
    public $userID;
    protected $sessionID;
    function __construct($userID)
    {
      $this->userID = $userID;
    }

    public function login(){
      $this->sessionID = session_id();
      $user = new UserLogged($this->userID);
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