<?php
  $login_button = "Zaloguj";
  if(isset($is_session)){
    if($is_session){
      $login_button = "Wyloguj";
    }
  }

  echo '
  <ul>
    <li><a href="index.php">Strona główna</a></li>
    <li><a href="menu.php">Menu</a><ul>
      <li><a href="menu.php#zupy">Zupy</a></li>
      <li><a href="menu.php#glowne">Dania główne</a></li>
      <li><a href="menu.php#maczne">Potrawy mączne</a></li>
    </ul></li>
    <li><a href="zamowienie.php">Zamów online</a></li>
    <li><a href="kontakt.php">Kontakt</a></li>';
  if($login_button == "Zaloguj"){
    echo '<li><a href="panel.php" id="login">'.$login_button.'</a></li>';
  }
  else{
    echo '
    <li><a href="panel.php?form=Konto">Konto</a><ul>
      <li><a href="panel.php?form=Konto">Moje konto</a></li>
      <li><a href="panel.php?form=Wyloguj">Wyloguj</a></li>
    </ul></li>
    ';
  }
  echo '</ul>';
?>
