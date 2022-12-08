
<?php
// Start the session
session_start();

class session {

  public function setSession($key, $value){
    $_SESSION[$key] = $value;
  }

  public function isLogged() {
    $user = $_SESSION['user'];
    if ($user = null){
      return false;
    }
  }
};

?>
