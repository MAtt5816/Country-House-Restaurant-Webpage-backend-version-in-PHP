<?php
  if(!isset($_SESSION))
    {
      session_start();
    }
  $is_session = false;
  if(isset($_SESSION['userID'])){
    $is_session = true;
  }
?>
<!DOCTYPE html>
<html lang="pl" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Swojska Chata | panel klienta</title>
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <link rel="stylesheet" href="css/form.css" type="text/css">
  </head>
  <body>
    <header>
      <nav>
        <?php
          include_once 'snippets/navigation.php';
        ?>
      </nav>
      <div id="banner">
        <div>
          <h1>Swojska Chata</h1>
          <h2>Najlepsze obiady domowe w okolicy</h2>
        </div>
        <img src="images/banner.jpg" alt="baner">
      </div>
    </header>
    <main>
      <form action="panel.php" method="post">
        <fieldset class="visibility">
        <?php
        include_once 'classes/Database.php';
        include_once 'classes/LoginForm.php';
        include_once 'classes/RegistrationForm.php';

        if(isset($_POST['register'])){
          $registrationForm = new RegistrationForm();
        }
        else{
          $loginForm = new LoginForm();
          if(isset($_POST['submit']) && isset($_POST['login']) && isset($_POST['password'])){
            $db = new Database("localhost","root","","restauracja");
            $loginForm->login($db);
          }
        }

        if($is_session){
          echo "session OK"; //tmp
        }

        if(isset($_GET['form'])){
          if($_GET['form'] == 'Wyloguj'){
            $loginForm->logout();
            header("Refresh: 0; panel.php?form=Zaloguj");
          }
        }
        ?>
        </fieldset>
      </form>
    </main>
    <?php
      include_once 'snippets/footer.php';
    ?>
  </body>
</html>
