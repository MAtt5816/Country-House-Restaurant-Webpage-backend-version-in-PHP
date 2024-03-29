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
    <link rel="stylesheet" href="css/menu.css" type="text/css">
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
      <?php
      include_once 'classes/Database.php';
      include_once 'classes/LoginForm.php';
      include_once 'classes/RegistrationForm.php';
      include_once 'classes/Manager.php';

      $db = new Database("localhost","root","","restauracja");

      if(isset($_POST['register'])){
        header("Refresh: 0; panel.php?form=Zarejestruj");
      }

      if(filter_input(INPUT_POST, "submit")){
        $action = filter_input(INPUT_POST, "submit");
        switch ($action){
            case "Zarejestruj": {
                $registrationForm = new RegistrationForm();
                $registrationForm->regiter($db);
                break;
            }
        }
      }

      if(isset($_GET['form'])){
        if($_GET['form'] == "Zarejestruj"){
          $registrationForm = new RegistrationForm();
          $registrationForm->show();
        }
        else if($_GET['form'] == 'Wyloguj'){
          $loginForm = new LoginForm();
          $loginForm->logout();
          header("Refresh: 0; panel.php");
        }
        else if($_GET['form'] == 'Konto'){   //main customer account manager
          if($is_session){
            $panel = new Manager();
            $panel->authorization();
            $panel->show($db);
          }
          else{
            echo "<h1>Strona zastrzeżona. Za chwilę nastąpi przekierowanie.</h1>";
            header("Refresh: 2; panel.php");
          }
        }
      }
      else{
        $loginForm = new LoginForm();
        if(isset($_POST['submit']) && isset($_POST['login']) && isset($_POST['passwd'])){
          $loginForm->login($db);
        }
      }
      ?>
    </main>
    <?php
      include_once 'snippets/footer.php';
    ?>
  </body>
</html>
